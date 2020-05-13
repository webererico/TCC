@extends('adminlte::page')

@section('title', 'INRI')

@section('content_header')
<h1>Configurações de ambiente</h1>
@stop

@section('content')
<div class="box box-info">
    <div class="box-header with-border">
        <h3 class="box-title">{{$dados->nome}}</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form method="post" action="/salvar/config/{{$dados->id}}" class="form-horizontal">
        {{ csrf_field() }}
        <div class="box-body">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Nome do ambiente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="ambiente" id="ambiente" placeholder="{{$dados->nome}}"
                        value="{{$dados->nome}}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Descrição do ambiente</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="descricao" id="descricao"
                        placeholder="{{$dados->descricao}}" value="{{$dados->descricao}}">
                </div>
            </div>

            <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Salvar</button>

            <a href="/apagar/{{$dados->id}}" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Apagar Banco de dados</a>

            <a href="/resgatar/{{$dados->id}}" class="btn btn-facebook" style="margin-left: 1%"><i class="fa fa-download"></i> Exportar todos dados</a>
        </div>
    </form>
</div>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
@stop