@extends('adminlte::page')

@section('title', 'INRI')

@section('content_header')
    <h1>Relatórios salvos</h1>
@stop

@section('content')
<div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Ensaios já realizados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Data do Relatório</th>
                  <th>Reponsável Registro</th>
                  <th>Ambiente</th>
                  <th>Período</th>
                  <th>Ações</th>
                  <th> </th>
                </tr>
              <?php foreach ($ensaios as $ensaio): ?>
              <?php foreach ($users as $user): ?>
              <?php foreach ($ambientes as $ambiente): ?>

                <?php if ($ensaio->id_user == $user->id): ?>
                  <?php if ($ambiente->id == $ensaio->id_ambiente): ?>


                  <tr>
                    <td>{{$ensaio->id}}</td>
                    <td>{{$ensaio->nome}}</td>
                    <td>{{$ensaio->data}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$ambiente->nome}}</td>
                    <td>{{$ensaio->dataI}} até {{$ensaio->dataF}}</td>
                    <td><a href='/ensaio/download/{{$ensaio->id}}' class="label label-success">Download XLS</span></td>
                    <td><a href='/ensaioPDF/download/{{$ensaio->id}}' class="label label-success"><i class="fa fa-download"></i> Download PDF</span></td>
                    <td><a href='/ensaio/apagar/{{$ensaio->id}}' class="label label-danger"><i class="fa fa-trash"></i> Apagar</span></td> 
                  </tr>
                <?php endif; ?>
                <?php endif; ?>
                <?php endforeach; ?>
              <?php endforeach; ?>
              
              <?php endforeach; ?>
              </table>
              <div style="margin-right: 2%" class="pull-right">
              <p > {{ $ensaios->links() }}</p>
              </div>
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
</div>
@stop
