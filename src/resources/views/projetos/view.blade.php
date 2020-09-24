@extends('index')

@section('content')
    <div class="col-md-12 col-sm-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Projetos</h2>
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
                                <th width="30%" class="column-title">Nome</th>
                                <th width="15%" class="column-title">Data Início</th>
                                <th width="15%" class="column-title">Data Fim</th>
                                <th width="15%" class="column-title">% Completo</th>
                                <th width="15%" class="column-title">Atrasado</th>
                                <th width="15%" class="column-title" colspan="2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(!$projetos->isEmpty())
                                @foreach ($projetos as $projeto)
                                    <tr>
                                        <td>{{ $projeto->id }}</td>
                                        <td>{{ $projeto->nome }}</td>
                                        <td>{{ $projeto->getDataInicioFormatada() }}</td>
                                        <td>{{ $projeto->getDataFimFormatada() }}</td>
                                        <td>{{ $projeto->getPercentualAndamento() }}</td>
                                        <td>{{ $projeto->getEstaAtrasado() }}</td>
                                        <td>
                                            <form action="{{ route('projetos.destroy', $projeto->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-acao"><i class="fa fa-trash"></i></button>
                                            </form>
                                        </td>
                                        <td>
                                            <a class="btn btn-success btn-acao" href="{{ route('projetos.edit', $projeto->id) }}"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">{{ 'Nenhum projeto cadastrado' }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                @if(!$projetos->isEmpty())
                    {!! $projetos->links() !!}
                @endif
            </div>
        </div>
    </div>
@endsection
