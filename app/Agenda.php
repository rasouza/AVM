<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use Gate;
use Auth;

class Agenda extends Model
{
    use Traits\ActiveScope;

    protected $table = 'agenda';
    protected $guarded = [];
    protected $casts = ['data' => 'date'];

    public function setDataAttribute($v) { if(!empty($v)) $this->attributes['data'] = Carbon::createFromFormat('d/m/Y', $v)->format('Y-m-d'); }
    public function getDataAttribute($v) { if(!is_null($v)  && $v != '0000-00-00') return Carbon::createFromFormat('Y-m-d', $v)->format('d/m/Y'); }

    public function cliente() { return $this->belongsTo('App\Cliente'); }
    public function filial() { return $this->belongsTo('App\Filial'); }
    public function os() { return $this->hasOne('App\Os'); }

    public static function getActiveAgenda() {
        // Workaround para ordenar por nome do cliente (relation field)
        $agendas = self::join('clientes', 'clientes.id', '=', 'agenda.cliente_id')
            ->whereHas('os', function($q) {
                $q->where('status', '<>' ,'concluido');
            })
            ->orderBy('agenda.data', 'asc')
            ->orderBy('clientes.nome', 'asc');

        if (Gate::denies('administrador'))
            $agendas = $agendas->where('agenda.filial_id', Auth::user()->funcionario->filial->id);

        if (Gate::denies('gerente'))
            $agendas = $agendas->whereHas('os', function($q) {
                $q->where('coordenador_id', Auth::user()->funcionario_id);
            });

        return $agendas->get(['agenda.*']);
    }
}
