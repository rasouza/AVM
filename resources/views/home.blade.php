@extends('layouts.master')

@section('title') {{ Auth::user()->cargo->nome }} {{ Auth::user()->funcionario->nome }} @endsection

@section('content') @endsection
