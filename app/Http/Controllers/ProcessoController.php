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
    public function __construct() {
        $this->authorize('coordenador');

        $os = Route::current()->os->load('ambientes.processos');

        if($os->ambientes->count() == 0)
            return redirect()
                ->action('AmbientesController@edit', [$os])
                ->with('error', 'sem ambiente')
                ->send();

        $total = $os->total();
        $inventariados = $os->inventariados();
        $auditados = $os->auditados();
        $progresso = $os->progresso();
        $pecas = $os->pecas();
        $duplicidades = $os->getDuplicidades();

        view()->share(compact('os', 'total', 'inventariados', 'auditados', 'progresso', 'pecas', 'duplicidades'));
    }

    public function destroy(Os $os, $setor) {
        $os->processos()->where('setor', $setor)->delete();
        return redirect()->action('ProcessoController@principal', [$os]);
    }

    public function parse(Os $os, Request $request, $divergencia = 0)
    {
        $file = $request->file('file');
        $name = $file->getClientOriginalName();

        // Se for divergencia não precisa validar
        if ($divergencia)
            $operador = 0;
        else {
            $operador = (int)substr(explode('_', $name)[1], 0, -4);
            $inventariantes = implode(',', $os->inventariantes);
            $this->validate($request, ['file' => "mimes:txt|non_exists|operador_exists:$operador,$inventariantes"]);
        }

        $file->move('processos/', $name);
        $fh = fopen("processos/$name", 'r');
        while (($row = fgetcsv($fh, null, ',')) !== FALSE) {

            $os->getAmbiente($row[0])->processos()->create([
                'setor' => $row[0],
                'codigo' => $row[1],
                'quantidade' => $row[2],
                'auditado' => $divergencia,
                'divergencia' => $divergencia,
                'funcionario_id' => $operador
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
            //TODO: incluir horas inventariadas para cada operador
        }
        $processos = $os->processos()
            ->groupBy('funcionario_id')
            ->selectRaw('sum(quantidade) as quantidade, funcionario_id')
            ->get();
        return view('operacional.processo.operadores', compact('processos'));
    }

    public function finalizar(Os $os, Request $request) {
        if ($os->progresso() < 100)
            return redirect()->back();

        if ($request->isMethod('post')) {
            $os->finalizar($request->only('rbCodigo', 'codigo', 'rbQuantidade', 'quantidade', 'separador'));

            return 'O.S. Finalizada';
        }

        return view('operacional.processo.finalizar', compact('os'));
    }

    public function divergencia(Os $os, Request $request) {
        if ($request->isMethod('post')) {
            $os->processos()->where('divergencia', true)->delete();
            $this->parse($os, $request, 1);
        }

        if ($request->has('processo')) {
            $processo = Processo::find($request->processo);

            $os->processos()
                ->where('codigo', $processo->codigo)
                ->where('setor', $processo->setor)
                ->where('divergencia', false)
                ->delete();

            $processo->divergencia = false;
            $processo->save();
        }

        $divergencias = $os->getDivergencia();
        return view('operacional.processo.divergencia', compact('divergencias'));
    }
}
