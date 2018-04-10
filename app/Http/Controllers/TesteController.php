<?php

namespace App\Http\Controllers;

use App\Processo;
use Debugbar;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TesteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $p1 = Processo::create([
//            'setor' => 50,
//            'codigo' => 'codigo1',
//            'quantidade' =>
//        ])
        $p = Processo::take(100)->get();
        $map = $p->reduce(function($carry, $item) {
            $carry[$item->setor][$item->codigo][] = $item->quantidade;
            return $carry;
        });

        $filter = collect($map)->map(function($setor) {
            $filterCodigo = array_filter($setor, function($codigo) {
                return count($codigo) > 1;
            });
            return empty($filterCodigo)?null:$filterCodigo;
        });

        $sanitizeFilter = $filter->filter(function($item) { return !empty($item); });
//        $filter = array_filter($filter->toArray());
        // 31110001058U
//        Debugbar::info($map[50]);
        Debugbar::info($sanitizeFilter);

        return view('teste');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
