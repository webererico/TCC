@extends('adminlte::page')

@section('title', 'INRI')

@section('content_header')
<h1>Definições de ambiente</h1>
@stop

@section('content')
<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">{{$dados->nome}}</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" action="/salvar/{{$dados->id}}" class="form-horizontal">
    {{ csrf_field() }}
    <div class="box-body">
      <?php if ($dados->id !=4) : ?>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">
          <p>Temp. Máxima:</p>
          <p>SetPoint Temperatura:</p>
          <p>Temp. Mínima:</p>

        </label>
        <div class="col-sm-3">
          <input type="number" class="form-control" name="maxTemp" id="maxTemp" placeholder="{{$dados->maxTemp}} *C"
            value="{{$dados->maxTemp}}">
          <input type="number" class="form-control" name="spTemp" id="spTemp" placeholder="{{$dados->spTemp}} *C"
            value="{{$dados->spTemp}}">
          <input type="number" class="form-control" name="minTemp" id="minTemp" placeholder="{{$dados->minTemp}} *C"
            value="{{$dados->minTemp}}">
        </div>
        <label for="inputEmail3" class="col-sm-2 control-label">
          <p>Umid. Máxima:</p>
          <p>SetPoint Umidade:</p>
          <p>Umid. Mínima:</p>

        </label>

        <div class="col-sm-3">
          <input type="number" class="form-control" name="maxUmid" id="maxUmid" placeholder="{{$dados->maxUmid}} %"
            value="{{$dados->maxUmid}}">
          <input type="number" class="form-control" name="spUmid" id="spUmid" placeholder="{{$dados->spUmid}}"
            value="{{$dados->spUmid}}">
          <input type="number" class="form-control" name="minUmid" id="minUmid" placeholder="{{$dados->minUmid}} %"
            value="{{$dados->minUmid}}">
        </div>
      </div>

      <div class="form-group">
        <label class="col-sm-2 control-label">Controle de Temperatura:</label>
        <div class="col-sm-3">
          <select class="form-control" name="option" id="option">
            <option selected value="{{$dados->status}}">{{$dados->status}}</option>
            <option value="manual">manual</option>
            <option value="automatico">automático</option>
          </select>
        </div>
        <label class="col-sm-2 control-label">Controle de Umidade:</label>
        <div class="col-sm-3">
          <select class="form-control" name="option1" id="option1">
            <option selected value="{{$dados->statusUmid}}">{{$dados->statusUmid}}</option>
            <option value="manual">manual</option>
            <option value="automatico">automático</option>
          </select>
        </div>

      </div>
      <div class="form-group">
        <label class="col-sm-1 control-label"></label>
        <div class="col-sm-5">
          <div class="row">
            <div class="col-lg-5">
              <label for="ligarSist">Hora Ativação:</label>
              <input type="time" class="form-control" name="dataITemp" id="dataITemp" value="{{$dataITemp}}">
              {{-- <p>Ultima atualização às {{$estadosUmid->updated_at->format('H:i:s')}}</p> --}}
            </div>

            <div class="col-lg-5">
              <label for="ligarSist">Hora Desativação :</label>
            <input type="time" class="form-control" name="dataFTemp" id="dataFTemp" value="{{$dataFTemp}}">
            </div>
          </div>
          <br>
          @if($alerta->avisoTemp == True)
          <input type="checkbox" id="checkTemp" name="checkTemp" checked value="1">
          @else
          <input type="checkbox" id="checkTemp" name="checkTemp" value="0">
          @endif
          <label for="checkTemp">Notificar por e-mail quando atingir limites de temperatura</label>
          <div></div>
          <!-- /.col-lg-6 -->

          {{-- <label for="ligarSist" class="col-sm-1 control-label">Hora Ativação:</label>
        <div class="col-sm-3">
          <input type="time" class="form-control" name="dataI" id="dataI" placeholder="">
        </div>
        <label for="ligarSist" class="col-sm-3 control-label">Hora Desativação :</label>
        <div class="col-sm-3">
          <input type="time" class="form-control" name="dataF" id="dataF" placeholder="">
        </div> --}}
        </div>

        <div class="form-group">
          <label class="col-sm-1 control-label"></label>
          <div class="col-sm-6">
            <div class="row">
              <div class="col-lg-5">
                <label for="ligarSist">Hora Ativação:</label>
                <input type="time" class="form-control" name="dataIUmid" id="dataIUmid" value="{{$dataIUmid}}">
              </div>

              <div class="col-lg-5">
                <label for="ligarSist">Hora Desativação :</label>
                <input type="time" class="form-control" name="dataFUmid" id="dataFUmid" value="{{$dataFUmid}}">
              </div>
            </div>
            <br>
            @if($alerta->avisoUmid == True)
            <input type="checkbox" id="checkUmid" name="checkUmid" checked value="1">
            @else
            <input type="checkbox" id="checkUmid" name="checkUmid" value="0">
            @endif
            <label for="checkUmid">Notificar por e-mail quando atingir limites de umidade</label>
          </div>

        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-info pull-right"><i class="fa fa-save"></i> Salvar</button>
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
@if($dados->status == "manual")
<div class="box box-warning direct-chat direct-chat-warning">
  <form method="post" action="/controle/{{$estados->id}}" class="form-horizontal">
    @csrf
    <div class="box-header with-border">
      <h3 class="box-title">Controle manual condicionador de ar
        @if($estados->status =='ligado')
        <a href="/desligar/{{$estados->id}}" class="btn btn-danger"><i class="fa fa-power-off"></i> Desligar</a>
        @endif
      </h3>
    </div>
    <div class="box-body">
      <div class="row" style="padding-left: 1%">
        <div class="col-md-3">
          <h4>Modo de operação</h4>
        </div>
        <div class="col-md-3">
          <h4>Temperatura</h4>
        </div>

      </div>
      <div class="row" style="padding-left: 1%; padding-bottom: 2%">
        <div class="col-md-3">
          <select class="form-control" name="operacao" id="operacao">
            <option selected value="{{$estados->modo}}">Selecione o modo de operação</option>
            <option value="resfriamento">resfriamento</option>
            <option value="aquecimento">aquecimento</option>
            <option value="desumidificar">desumidificar</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" name="temperatura" id="temperatura">
            <option selected value="{{$estados->temp}}">Selecione a temperatua</option>
            @for($i = 17;$i<=30;$i++) <option value="{{$i}}">{{$i}}</option>
              @endfor
          </select>
        </div>
        <div class="col-md-1">
          <button type="submit" class="btn btn-success"><i class="fa fa-power-on"></i> Ativar</button>
        </div>
        <div class="col-md-3">
          @if(isset($estados->updated_at))
          <p>Ultima atualização às {{$estados->updated_at->format('H:i:s d-m-Y')}}</p>

          @endif
        </div>
      </div>
    </div>
  </form>
</div>

@endif
@if($dados->statusUmid == "manual")
<div class="box box-warning direct-chat direct-chat-warning">
  <form method="post" action="/controle/{{$estadosUmid->id}}" class="form-horizontal">
    @csrf
    <div class="box-header with-border">
      <h3 class="box-title">Controle manual umidificador/desumidificador
        @if($estadosUmid->status=='ligado')
        <a href="/desligar/{{$estadosUmid->id}}" class="btn btn-danger"><i class="fa fa-power-off"></i> Desligar</a>
        @endif
      </h3>
    </div>
    <div class="box-body">
      <div class="row" style="padding-left: 1%">
        <div class="col-md-3">
          <h4>Modo de operação</h4>
        </div>
        <div class="col-md-3">
          <h4>Temperatura</h4>
        </div>

      </div>
      <div class="row" style="padding-left: 1%; padding-bottom: 2%">
        <div class="col-md-3">
          <select class="form-control" name="operacao" id="operacao">
            <option selected value="{{$estadosUmid->modo}}">Selecione o modo de operação</option>
            <option value="aquecimento">umidificar</option>
            <option value="desumidificar">desumidificar</option>
          </select>
        </div>
        <div class="col-md-3">
          <select class="form-control" name="temperatura" id="temperatura">
            <option value="{{$estadosUmid->temp}}">Selecione a temperatua</option>
            @for($i = 17;$i<=30;$i++) <option value="{{$i}}">{{$i}}</option>
              @endfor
          </select>
        </div>

        <div class="col-md-1">
          <button type="submit" class="btn btn-success"><i class="fa fa-power-on"></i> Ativar</button>
        </div>
        <div class="col-md-3">
          @if(isset($estadosUmid->updated_at))
          <p>Ultima atualização às {{$estadosUmid->updated_at->format('H:i:s')}}</p>
          <p>Data: {{$estadosUmid->updated_at->format('d-m-Y')}}</p>
          @endif
        </div>
      </div>
    </div>
  </form>
</div>
@endif
<?php endif; ?>
@stop