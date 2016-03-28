<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use Traits\ActiveScope;

    protected $guarded = [];
    protected $casts = [
        'propostaBegin' => 'date',
        'propostaEnd' => 'date',
        'faturamento' => 'boolean',
        'especial'  => 'array'
    ];


    public function getPropostaEndAttribute($v) { if(!is_null($v)) return Carbon::createFromFormat('Y-m-d', $v)->format('d/m/Y'); }
    public function setPropostaEndAttribute($v) { if(!empty($v)) $this->attributes['propostaEnd'] = Carbon::createFromFormat('d/m/Y', $v)->format('Y-m-d'); }
    public function getPropostaBeginAttribute($v) { if(!is_null($v)) return Carbon::createFromFormat('Y-m-d', $v)->format('d/m/Y'); }
    public function setPropostaBeginAttribute($v) {
        if(!empty($v))
            $this->attributes['propostaBegin'] = Carbon::createFromFormat('d/m/Y', $v)->format('Y-m-d');
    }

    public function getPercentualAttribute($v) { return str_replace('.', ',', sprintf("%05.2f", $v)); }
    public function setPercentualAttribute($v) { $this->attributes['percentual'] = str_replace(',', '.', $v); }

    public function getPecaAttribute($v) { return str_replace('.', ',', $v); }
    public function setPecaAttribute($v) { $this->attributes['peca'] = str_replace(',', '.', $v); }

    public function getPeriodicidadeAttribute($v) {
        switch ($v) {
            case 0:
                return 'Esporádico';
            case 1:
                return 'Mensal';
            case 2:
                return 'Bimestral';
            case 3:
                return 'Trimestral';
            case 4:
                return 'Quadrimetral';
            case 6:
                return 'Semestral';
        }
    }

    public function filial() { return $this->belongsTo('App\Filial'); }
    public function ficha() { return $this->hasOne('App\Ficha'); }
    public function agendas() { return $this->hasMany('App\Agenda'); }
    public function vendedor() { return $this->belongsTo('App\Funcionario', 'vendedor_id'); }
    public function gerente() { return $this->belongsTo('App\Funcionario', 'gerente_id'); }

    public static function dropdown() {
        return self::active()->orderBy('nome', 'asc')->lists('nome', 'id');
    }
}
