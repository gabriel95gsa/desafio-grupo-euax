@extends('index')

@section('content')
    <div class="container" role="main">
        <div class="page-title">
            <div class="">
                <div class="title_left">
                    <h3>Cadastrar Atividade</h3>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                {{ $message }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible " role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                </button>
                <strong>Whoops!</strong> Houve algum problema ao cadastrar a atividade.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Atividade</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <br />
                        <form id="form_cadastro" method="POST" action="{{ route('atividades.store') }}" data-parsley-validate class="form-horizontal form-label-left">
                            @csrf
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="nome">
                                    Nome <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="nome" name="nome" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="projeto_id">
                                    Projeto <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <select id="projeto_id" name="projeto_id" class="form-control" required="required">
                                        @if(!$projetos->isEmpty())
                                            @foreach ($projetos as $projeto)
                                                <option value="{{ $projeto->id }}">{{ $projeto->nome }}</option>
                                            @endforeach
                                        @else
                                            <option value="">Nenhum projeto disponível</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_inicio">
                                    Data início <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="date" id="data_inicio" name="data_inicio" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="data_fim">
                                    Data fim <span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                    <input type="date" id="data_fim" name="data_fim" required="required" class="form-control">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                    <button class="btn btn-primary" type="reset">Limpar</button>
                                    <button type="submit" class="btn btn-success">Cadastrar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
