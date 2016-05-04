<?php

namespace App\Http\Controllers;

use App\Ambiente;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Os;

class AmbientesController extends Controller
{
    function __construct() { $this->authorize('gerente'); }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $os_id
     * @return \Illuminate\Http\Response
     */
    public function edit($os_id)
    {
        $os = Os::find($os_id);
        $ambientes = $os->ambientes;
        return view('operacional.ambientes.form', compact('os', 'ambientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $os = Os::find($request->os_id);
        $processos = $os->processos;

        // Cria os ambientes
        $os->ambientes()->delete();
        $ambientes = [];
        for ($i = 0; $i < count($request->nome); $i++) {
            if ($request->nome[$i] != "") {
                $ambiente = new Ambiente();
                $ambiente->nome = $request->nome[$i];
                $ambiente->inicio = $request->inicio[$i];
                $ambiente->fim = $request->fim[$i];
                array_push($ambientes, $ambiente);
            }
        }

        // Verifica se existe conflito de range entre os ambientes
        foreach($ambientes as $ambiente) {
            $outros_ambientes = array_diff($ambientes,[$ambiente]);
            $range = range($ambiente->inicio, $ambiente->fim);
            $conflito = collect($outros_ambientes)->contains(function ($k, $v) use ($range) {
                $r = range($v->inicio,$v->fim);
                return array_intersect($range,$r) != null;
            });

            if ($conflito) break;
        }


        if (!$conflito) {
            $os->ambientes()->saveMany($ambientes);

            // Reatribui todos os processos para os ambientes certos
            foreach ($processos as $processo) {
                $ambiente = $os->getAmbiente($processo->setor);
                $processo->ambiente()->associate($ambiente)->save();
            }

            echo "Ambientes cadastrados com sucesso";
        }
        else {
            echo "<b style='color: red'>Setores em conflito! Arrume e envie novamente</b>";
        }


    }

}

