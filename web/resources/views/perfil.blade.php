@extends('adminlte::page')
@section('title', 'INRI')
@section('content_header')
@stop
@section('content')
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title"><i class="fa fa-user"></i> Editar Perfil</h3>
        </div>
        <form class="form-horizontal" action="/perfil" method="POST">
            @csrf
            <div class="box-body">
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Nome Completo</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="{{$user->name}}"
                            value="{{$user->name}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" id="email" name="email" placeholder="{{$user->email}}"
                            value="{{$user->email}}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-2 control-label">Senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                    </div>
                </div>
                <div class="form-group">
                    <label for="repassword" class="col-sm-2 control-label">Confirmar senha</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" id="repassword" name="repassword"
                            placeholder="senha">
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <a href="user/apagar/{{$user->id}}" class="btn btn-danger pull-left"><i class="fa fa-trash"></i> Remover
                    usuário do sistema</a>
                <button type="submit" class="btn btn-warning pull-right"><i class="fa fa-save"></i> Alterar</button>
            </div>
            <!-- /.box-footer -->
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