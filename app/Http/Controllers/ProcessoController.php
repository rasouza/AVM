<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Route;
use File;
use DB;

use App\Os;
use App\Processo;

class ProcessoController extends Controller
{
    public function __construct()
    {
        $os = Route::current()->os;
        $total = $os->total();
        $inventariados = $os->inventariados();
        $auditados = $os->auditados();
        $progresso = $os->progresso();
        $pecas = $os->pecas();
        $duplicidades = $os->getDuplicidades();
        $os = $os->with('ambientes.processos')->first();

        view()->share(compact('os', 'total', 'inventariados', 'auditados', 'progresso', 'pecas', 'duplicidades'));
    }

    public function destroy(Os $os, $setor) {
        $os->processos()->where('setor', $setor)->delete();
        return redirect()->action('ProcessoController@principal', [$os]);
    }

    public function parse(Os $os, Request $request)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();

        $this->validate($request, ['file' => 'mimes:txt|non_exists']);

        $file->move('processos/', $name);

        $fh = fopen("processos/$name", 'r');
        while (($row = fgetcsv($fh, null, ',')) !== FALSE) {
            $os->getAmbiente($row[0])->processos()->create([
                'setor' => $row[0],
                'codigo' => $row[1],
                'quantidade' => $row[2],
                'auditado' => false,
                'operador' => substr(explode('_', $name)[1], 0, -4) // TODO: Mudar para (int) quando receber codigo
            ]);
        }

        return redirect()->action('ProcessoController@principal', [$os]);
    }

    public function principal() { return view('operacional.processo.principal'); }
    public function detalhe(Os $os, Request $request) {
        if ($request->isMethod('post')) {
            $processos = $os->processos()
                ->where('setor', $request->setor)
                ->OrWhere('codigo', $request->codigo)
                ->get();
        }
        return view('operacional.processo.detalhe', compact('processos'));
    }
    public function duplicidades(Os $os, Request $request) {
        if ($request->has('processo'))
            Processo::find($request->processo)->delete();

        $duplicidades = $os->getDuplicidades();
        return view('operacional.processo.duplicidades', compact('duplicidades'));
    }
    public function auditoria(Os $os, Request $request) {
        if ($request->isMethod('post')) {
            if ($request->has('auditar')) {
                $processos = $os->processos()->whereIn('setor', $request->processos)->get();
                foreach ($processos as $processo) {
                    $processo->auditado = true;
                    $processo->save();
                }
            } elseif ($request->has('excluir')) {
                foreach ($request->processos as $setor)
                    $this->destroy($os, $setor);
            }
        }
        $processos = $os->processos()->where('auditado', false)->groupBy('setor')->get();
        return view('operacional.processo.auditoria', compact('processos'));
    }
    public function restantes() { return view('operacional.processo.restantes'); }
    public function operadores(Os $os, Request $request) {
        if ($request->isMethod('post')) {
            
        }
        $processos = $os->processos()
            ->groupBy('operador')
            ->selectRaw('sum(quantidade) as quantidade, operador')
            ->get();
        return view('operacional.processo.operadores', compact('processos'));
    }
}
