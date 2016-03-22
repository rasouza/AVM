<?php

namespace App\Http\Controllers;

use App\Ambiente;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Os;

class AmbientesController extends Controller
{
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
        $os->ambientes()->saveMany($ambientes);
        echo "Ambientes cadastrados com sucesso";
    }

}

