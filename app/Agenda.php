<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    protected $table = 'agenda';
    protected $guarded = [];
    protected $casts = ['data' => 'date'];

    public function setDataAttribute($v) { $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $v)->format('Y-m-d'); }
    public function getDataAttribute($v) { if(!is_null($v)) return Carbon::createFromFormat('Y-m-d', $v)->format('d/m/Y'); }

    public function cliente() { return $this->belongsTo('App\Cliente'); }
    public function filial() { return $this->belongsTo('App\Filial'); }
    public function os() { return $this->hasOne('App\Os'); }
}
