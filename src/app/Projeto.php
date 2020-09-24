<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Atividade;

class Projeto extends Model
{
    protected $fillable = [
        'nome',
        'data_inicio',
        'data_fim'
    ];

    public function getDataInicioFormatada($format = 'd/m/Y')
    {
        return Carbon::parse($this->attributes['data_inicio'])->format($format);
    }

    public function getDataFimFormatada($format = 'd/m/Y')
    {
        return Carbon::parse($this->attributes['data_fim'])->format($format);
    }

    public function getPercentualAndamento()
    {
        $totalAtividades = Atividade::where('projeto_id', $this->attributes['id'])
            ->count();

        if (!$totalAtividades) {
            return '0.00 %';
        }

        $qtdAtividadesFinalizadas = Atividade::where('finalizada', '1')->where('projeto_id', $this->attributes['id'])->count();

        return number_format(($qtdAtividadesFinalizadas / $totalAtividades) * 100, 2) . ' %';
    }

    public function getEstaAtrasado()
    {
        $ultimaAtividade = Atividade::where('projeto_id', $this->attributes['id'])->orderBy('data_fim', 'desc')->limit(1)->get();

        if (!count($ultimaAtividade)) {
            return 'Não';
        }

        $ultimaAtividade = new Carbon($ultimaAtividade[0]->data_fim);

        return $ultimaAtividade->greaterThan($this->attributes['data_fim']) ? 'Sim' : 'Não';
    }
}
