@extends('adminlte::page')

@section('title', 'INRI')

@section('content_header')
<h1>Novo relatório</h1>
@stop

@section('content')
<div class="box box-warning">
  <div class="box-header with-border">
    <h3 class="box-title">Criar novo relatório</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" action="/criaensaio" class="form-horizontal">
    {{ csrf_field() }}
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Nome do relatório</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite aqui o nome do ensaio">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Descrição do relatório</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="descricao" id="descricao"
            placeholder="Digite aqui a descrição do ensaio">
        </div>
      </div>
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">Data de realização do relatório</label>
        <div class="col-sm-10">
          <input type="date" class="form-control" name="data" id="data"
            placeholder="Digite aqui a data e hora de realização do ensaio">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Data Inicial:</label>
        <div class="col-sm-4">
          <input type="datetime-local" class="form-control" name="dataI" id="dataI" placeholder="">
        </div>
        <label for="inputEmail3" class="col-sm-2 control-label">Data Final:</label>

        <div class="col-sm-3">
          <input type="datetime-local" class="form-control" name="dataF" id="dataF" placeholder="">
        </div>
      </div>
      <div class="form-group">
        <label class="col-sm-2 control-label">Ambiente a ser resgatado os dados</label>
        <div class="col-sm-4">
          <select class="form-control" name="ambiente" id="ambiente">
            <option selected disabled value=""> </option>
            @<?php foreach ($ambientes as $ambiente): ?>
            <option value="{{$ambiente->id}}">{{$ambiente->nome}}</option>
            <?php endforeach; ?>

          </select>
        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-save"></i> Salvar relatório</button>
      </div>

  </form>
</div>
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