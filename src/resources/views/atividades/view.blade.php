@extends('index')

@section('content')
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Atividades</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="table-responsive">
                    <table class="table table-striped jambo_table bulk_action">
                        <thead>
                            <tr class="headings">
                                <th width="5%" class="column-title">ID</th>
                                <th width="25%" class="column-title">Projeto</th>
                                <th width="25%" class="column-title">Nome</th>
                                <th width="13%" class="column-title">Data Início</th>
                                <th width="13%" class="column-title">Data Fim</th>
                                <th width="9%" class="column-title">Finalizada ?</th>
                                <th width="10%" class="column-title" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$atividades->isEmpty())
                                @foreach ($atividades as $atividade)
                                    <tr>
                                        <td>{{ $atividade->id }}</td>
                                        <td>{{ $atividade->projeto->nome }}</td>
                                        <td>{{ $atividade->nome }}</td>
                                        <td>{{ $atividade->getDataInicioFormatada() }}</td>
                                        <td>{{ $atividade->getDataFimFormatada() }}</td>
                                        <td>{{ $atividade->getFinalizadaDescricao() }}</td>
                                        <td>
                                            <form action="{{ route('atividades.destroy', $atividade->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-acao"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-acao" href="{{ route('atividades.edit', $atividade->id) }}"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">{{ 'Nenhuma atividade cadastrada' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(!$atividades->isEmpty())
                    {!! $atividades->links() !!}
                @endif
            </div>
        </div>
    </div>
@endsection
