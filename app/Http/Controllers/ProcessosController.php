<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Os;


class ProcessosController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $oses = Os::where('status', 'confirmado')->get();
        return view('operacional.processos.index', compact('oses'));
    }

}
