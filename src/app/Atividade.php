<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Projeto;

class Atividade extends Model
{
    protected $fillable = [
        'projeto_id',
        'nome',
        'data_inicio',
        'data_fim',
        'finalizada'
    ];

    public function getFinalizadaDescricao()
    {
        return $this->attributes['finalizada'] == 1 ? 'Sim' : 'Não';
    }

    public function projeto()
    {
        return $this->belongsTo('App\Projeto');
    }

    public function getDataInicioFormatada($format = 'd/m/Y')
    {
        return Carbon::parse($this->attributes['data_inicio'])->format($format);
    }

    public function getDataFimFormatada($format = 'd/m/Y')
    {
        return Carbon::parse($this->attributes['data_fim'])->format($format);
    }
}
