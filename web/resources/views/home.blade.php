<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    {{-- <title>@yield('page-title')</title> --}}
    {{-- <link rel="icon" href="{!! asset('images/gcm_ico.ico') !!}"/>  --}}
</head>
@extends('adminlte::page')
@section('title', 'INRI - Fotovoltaico')

@section('content_header')
<h1>Olá {{Auth::user()->name}}, bem-vindo ao Dashboard LabEnsaios</h1>



@stop
@section('content')
<section class="content">
    <div class="row">
        {{-- LAB --}}
        <div class="col-lg-3 col-xs-6">
            <div class="box box-default" style="text-align: center;">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$nomeAmbiente[2]}}</h3>
                </div>
            </div>
            @if($lab->temp > ($aLab->spTemp+2))
            @if($lab->temp > ($aLab->maxTemp-2))
            <div class="small-box bg-red">
                @else
                <div class="small-box bg-yellow-gradient">
                    @endif
                    @elseif($lab->temp < ($aLab->spTemp-2))
                    @if($lab->temp < ($aLab->minTemp+2))
                    <div class="small-box bg-red">
                        @else
                        <div class="small-box bg-yellow-gradient">
                            @endif
                    @else
                    <div class="small-box bg-green-gradient">
                    @endif
                            <div class="inner" style="text-align: center">
                                <h4>Temperatura</h4>
                                <h4>{{$aLab->maxTemp}}ºC</h4>
                                <h3>{{number_format($lab->temp, 1)}}ºC</h3>
                                <h4>{{$aLab->minTemp}}ºC</h4>
                                <h5 style="text-align: left">SP: {{$lab->spTemp}}ºC</h5>
                            </div>
                            @if($aLab->status == "automatico")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO</a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif

                        </div>
                       
                        @if($lab->umid > ($aLab->spUmid+5))
            @if($lab->umid > ($aLab->maxUmid-5))
            <div class="small-box bg-red">
                @else
                <div class="small-box bg-yellow-gradient">
                    @endif
                    @elseif($lab->umid < ($aLab->spUmid-5))
                    @if($lab->umid < ($aLab->minUmid+5))
                    <div class="small-box bg-red">
                        @else
                        <div class="small-box bg-yellow-gradient">
                            @endif
                    @else
                    <div class="small-box bg-green-gradient">
                    @endif
                            <div class="inner" style="text-align: center">
                                <h4>Umidade</h4>
                                <h4>{{$aLab->maxUmid}}%</h4>
                                <h3>{{number_format($lab->umid, 1)}}%</h3>
                                <h4>{{$aLab->minUmid}}%</h4>
                                <h5 style="text-align: left">SP: {{$lab->spUmid}}%</h5>
                            </div>
                            @if($aLab->statusUmid == "automatissadasco")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO </a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif

                        </div>
                    </div>

                    {{-- SALA1 --}}
                    <div class="col-lg-3 col-xs-6">
                        <div class="box box-default" style="text-align: center;">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$nomeAmbiente[0]}}</h3>
                            </div>
                        </div>
                        @if($sala1->temp > ($asala1->spTemp+2))
            @if($sala1->temp > ($asala1->maxTemp-2))
            <div class="small-box bg-red">
                @else
                <div class="small-box bg-yellow-gradient">
                    @endif
                    @elseif($sala1->temp < ($asala1->spTemp-2))
                    @if($sala1->temp < ($asala1->minTemp+2))
                    <div class="small-box bg-red">
                        @else
                        <div class="small-box bg-yellow-gradient">
                            @endif
                    @else
                    <div class="small-box bg-green-gradient">
                    @endif
                            <div class="inner" style="text-align: center">
                                <h4>Temperatura</h4>
                                <h4>{{$asala1->maxTemp}}ºC</h4>
                                <h3>{{number_format($sala1->temp, 1)}}ºC</h3>
                                <h4>{{$asala1->minTemp}}ºC</h4>
                                <h5 style="text-align: left">SP: {{$sala1->spTemp}}ºC</h5>
                            </div>
                            @if($asala1->status == "automatico")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO </a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif
                        </div>
                        @if($sala1->umid > ($asala1->spUmid+5))
                        @if($sala1->umid > ($asala1->maxUmid-5))
                        <div class="small-box bg-red">
                            @else
                            <div class="small-box bg-yellow-gradient">
                                @endif
                                @elseif($sala1->umid < ($asala1->spUmid-5))
                                @if($sala1->umid < ($asala1->minUmid+5))
                                <div class="small-box bg-red">
                                    @else
                                    <div class="small-box bg-yellow-gradient">
                                        @endif
                                @else
                                <div class="small-box bg-green-gradient">
                                @endif
                            <div class="inner" style="text-align: center">
                                <h4>Umidade</h4>
                                <h4>{{$asala1->maxUmid}}%</h4>
                                <h3>{{number_format($sala1->umid, 1)}}%</h3>
                                <h4>{{$asala1->minUmid}}%</h4>
                                <h5 style="text-align: left">SP: {{$sala1->spUmid}}%</h5>
                            </div>
                            @if($asala1->statusUmid == "automatico")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO </a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif
                        </div>
                    </div>
                    {{-- SALA 2  --}}
                    <div class="col-lg-3 col-xs-6">
                        <div class="box box-default" style="text-align: center;">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$nomeAmbiente[1]}}</h3>
                            </div>
                        </div>
                        @if($sala2->temp > ($asala2->spTemp+2))
            @if($sala2->temp > ($asala2->maxTemp-2))
            <div class="small-box bg-red">
                @else
                <div class="small-box bg-yellow-gradient">
                    @endif
                    @elseif($sala2->temp < ($asala2->spTemp-2))
                    @if($sala2->temp < ($asala2->minTemp+2))
                    <div class="small-box bg-red">
                        @else
                        <div class="small-box bg-yellow-gradient">
                            @endif
                    @else
                    <div class="small-box bg-green-gradient">
                    @endif
                            <div class="inner" style="text-align: center">
                                <h4>Temperatura</h4>
                                <h4>{{$asala2->maxTemp}}ºC</h4>
                                <h3>{{number_format($sala2->temp, 1)}}ºC</h3>
                                <h4>{{$asala2->minTemp}}ºC</h4>
                                <h5 style="text-align: left">SP: {{$sala2->spTemp}}ºC</h5>
                            </div>
                            @if($asala2->status == "automatico")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO </a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif
                        </div>
                        @if($sala2->umid > ($asala2->spUmid+5))
                        @if($sala2->umid > ($asala2->maxUmid-5))
                        <div class="small-box bg-red">
                            @else
                            <div class="small-box bg-yellow-gradient">
                                @endif
                                @elseif($sala2->umid < ($asala2->spUmid-5))
                                @if($sala2->umid < ($asala2->minUmid+5))
                                <div class="small-box bg-red">
                                    @else
                                    <div class="small-box bg-yellow-gradient">
                                        @endif
                                @else
                                <div class="small-box bg-green-gradient">
                                @endif
                            <div class="inner" style="text-align: center">
                                <h4>Umidade</h4>
                                <h4>{{$asala2->maxUmid}}%</h4>
                                <h3>{{number_format($sala2->umid, 1)}}%</h3>
                                <h4>{{$asala2->minUmid}}%</h4>
                                <h5 style="text-align: left">SP: {{$sala2->spUmid}}%</h5>
                            </div>
                            @if($asala2->statusUmid == "automatico")
                            <a class="small-box-footer label label-success"> AUTOMÁTICO </a>
                            @else
                            <a class="small-box-footer label label-warning"> OFF</a>
                            @endif
                        </div>
                        {{--EXTERIOR--}}
                    </div>
                    <div class="col-lg-3 col-xs-6">
                        <div class="box box-default" style="text-align: center;">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{$nomeAmbiente[3]}}</h3>
                            </div>
                        </div>
                        <div class="small-box bg-black-gradient">
                            <div class="inner" style="text-align: center">
                                <h4>Temperatura</h4>
                                <h4>&#160</h4>
                                <h3 style="font-size:65px">{{number_format($exterior->temp, 1)}}ºC</h3>
                                <h5 style="text-align: left">&#160</h5>
                            </div>
                            <a class="small-box-footer label label-default">&#160</a>
                        </div>
                        <div class="small-box bg-black-gradient">
                            <div class="inner" style="text-align: center">
                                <h4>Umidade</h4>
                                <h4>&#160</h4>
                                <h3 style="font-size:65px">{{number_format($exterior->umid, 1)}}%</h3>
                                <h5 style="text-align: left">&#160 </h5>
                            </div>
                            <a class="small-box-footer label label-default">&#160</a>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">{{$nomeAmbiente[2]}}</h3>
                                <div class="box-tools pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-box-tool dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu keep-open" role="menu">
                                            <li><a href="/alterar/controle">Alterar Controle</a></li>
                                            <li class="divider"></li>
                                            <li><a href="edit/ambiente/3">Alterar SetPoints</a></li>
                                            <li>
                                            <li class="divider"></li>
                                            <p style="text-align: center"> Pontos no Gráfico </p>
                                            <a href='/home/3/5' value="5" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">5
                                            </a>
                                            <a href='/home/3/60' value="60" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">60</a>
                                            <a href='/home/3/240' value="240" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">240</a>
                                            <a href='/home/3/480' value="480" id="pontos" name="ponts"
                                                class="btn btn-bitbucket" style="font-size: 10px">480</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Temperatura ºC</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Umidade %</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart2"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">{{$nomeAmbiente[0]}}</h3>
                                <div class="box-tools pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-box-tool dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu keep-open" role="menu">
                                            <li><a href="/alterar/controle">Alterar Controle</a></li>
                                            <li class="divider"></li>
                                            <li><a href="edit/ambiente/1">Alterar SetPoints</a></li>
                                            <li>
                                            <li class="divider"></li>
                                            <p style="text-align: center"> Pontos no Gráfico </p>
                                            <a href='/home/1/5' value="5" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">5
                                            </a>
                                            <a href='/home/1/60' value="60" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">60</a>
                                            <a href='/home/1/240' value="240" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">240</a>
                                            <a href='/home/1/480' value="480" id="pontos" name="ponts"
                                                class="btn btn-bitbucket" style="font-size: 10px">480</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Temperatura ºC</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart3"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Umidade %</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart4"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">

                            <div class="box-header with-border">
                                <i class="fa fa-bar-chart-o"></i>
                                <h3 class="box-title">{{$nomeAmbiente[1]}}</h3>
                                <div class="box-tools pull-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-box-tool dropdown-toggle"
                                            data-toggle="dropdown">
                                            <i class="fa fa-wrench"></i></button>
                                        <ul class="dropdown-menu keep-open" role="menu">
                                            <li><a href="/alterar/controle">Alterar Controle</a></li>
                                            <li class="divider"></li>
                                            <li><a href="/edit/ambiente/2">Alterar SetPoints</a></li>
                                            <li>
                                            <li class="divider"></li>
                                            <p style="text-align: center"> Pontos no Gráfico </p>
                                            <a href='/home/2/5' value="5" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">5
                                            </a>
                                            <a href='/home/2/60' value="60" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">60</a>
                                            <a href='/home/2/240' value="240" id="pontos" name="pontos"
                                                class="btn btn-bitbucket" style="font-size: 10px">240</a>
                                            <a href='/home/2/480' value="480" id="pontos" name="ponts"
                                                class="btn btn-bitbucket" style="font-size: 10px">480</a>


                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Temperatura ºC</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart5"></canvas>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <p class="text-center">
                                                    <strong>Umidade %</strong>
                                                </p>
                                                <div>
                                                    <canvas id="myChart6"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script type="text/javascript">
    setTimeout(function(){
      
            location.reload();
      
        },1200000);
      
</script>
<script type="text/javascript">
    var temp = [
           @foreach( $dadosTemp as $dado)
            ["{{$dado->temp}}"],
           @endforeach
           ];
    var spTemp = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->spTemp}}"],
          @endforeach
        ];
    var umid = [
           @foreach( $dadosTemp as $dado)
            ["{{$dado->umid}}"],
           @endforeach
           ];
    var spUmid = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->spUmid}}"],
          @endforeach
        ];
    var maxTemp = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->maxTemp}}"],
          @endforeach
        ];
    var minTemp = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->minTemp}}"],
          @endforeach
        ];
        var maxUmid = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->maxUmid}}"],
          @endforeach
        ];
    var minUmid = [
          @foreach($dadosTemp as $dado)
          ["{{$dado->minUmid}}"],
          @endforeach
        ]
    
    
    var datas = @json($valor);
    var maxYUmid =parseFloat(maxUmid[0])+20;
    var minYUmid =parseFloat(minUmid[0])-20;
    var maxYTemp =parseFloat(maxTemp[0])+5;
    var minYTemp =parseFloat(minTemp[0])-5;
        
      var ctx = document.getElementById('myChart').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'line',
      
          
          data: {
              labels: datas,
              datasets: [{
                  label: 'Temperatura',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: temp,
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spTemp,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minTemp,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'true',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxTemp,
                  pointRadius: 0,
              },
            
            ],
          
          },
      
          // Configuration options go here
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYTemp,
                              min : minYTemp
                          },
                      }]
                  },
                  responsive:true,
    chartArea: {
        backgroundColor: 'rgba(251, 85, 85, 0.4)'
    },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20
                  }
              }
              }
      });  
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'line',    
          data: {
              labels: datas,
              datasets: [{
                  label: 'Umidade',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: umid,
                  
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'rgba(255, 255, 0, 0.1)',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spUmid,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minUmid,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxUmid,
                  pointRadius: 0,
              },
            ], 
          },
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYUmid,
                              min : minYUmid
                          }
                      }]
                  },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20,
                  }
              },
              chartArea: {
                     backgroundColor: 'rgba(251, 85, 85, 1)'
              }
    }
      });
</script>

{{-- AMBIENTE  1 --}}
<script type="text/javascript">
    var temp = [
           @foreach( $dadosSala1 as $dado)
            ["{{$dado->temp}}"],
           @endforeach
           ];
    var spTemp = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->spTemp}}"],
          @endforeach
        ];
    var umid = [
           @foreach( $dadosSala1 as $dado)
            ["{{$dado->umid}}"],
           @endforeach
           ];
    var spUmid = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->spUmid}}"],
          @endforeach
        ];
    var maxTemp = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->maxTemp}}"],
          @endforeach
        ];
    var minTemp = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->minTemp}}"],
          @endforeach
        ];
        var maxUmid = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->maxUmid}}"],
          @endforeach
        ];
    var minUmid = [
          @foreach($dadosSala1 as $dado)
          ["{{$dado->minUmid}}"],
          @endforeach
        ]
    var datas = @json($valor);
    var maxYUmid =parseFloat(maxUmid[0])+20;
    var minYUmid =parseFloat(minUmid[0])-20;
    var maxYTemp =parseFloat(maxTemp[0])+5;
    var minYTemp =parseFloat(minTemp[0])-5;
      var ctx = document.getElementById('myChart3').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'line',
      
          
          data: {
              labels: datas,
              datasets: [{
                  label: 'Temperatura',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: temp,
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spTemp,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minTemp,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'true',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxTemp,
                  pointRadius: 0,
              },
            
            ],
          
          },
      
          // Configuration options go here
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYTemp,
                              min : minYTemp
                          },
                      }]
                  },
                  responsive:true,
    chartArea: {
        backgroundColor: 'rgba(251, 85, 85, 0.4)'
    },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20
                  }
              }
              }
      });

        var ctx = document.getElementById('myChart4').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'line',  
          data: {
              labels: datas,
              datasets: [{
                  label: 'Umidade',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: umid,
                  
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'rgba(255, 255, 0, 0.1)',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spUmid,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minUmid,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxUmid,
                  pointRadius: 0,
              },
            ],
          },
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYUmid,
                              min : minYUmid
                          }
                      }]
                  },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20,   
                  }
              },
              chartArea: {
                     backgroundColor: 'rgba(251, 85, 85, 1)'
              }
    }
      });
</script>
<script type="text/javascript">
    var temp = [
           @foreach( $dadosSala2 as $dado)
            ["{{$dado->temp}}"],
           @endforeach
           ];
    var spTemp = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->spTemp}}"],
          @endforeach
        ];
    var umid = [
           @foreach( $dadosSala2 as $dado)
            ["{{$dado->umid}}"],
           @endforeach
           ];
    var spUmid = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->spUmid}}"],
          @endforeach
        ];
    var maxTemp = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->maxTemp}}"],
          @endforeach
        ];
    var minTemp = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->minTemp}}"],
          @endforeach
        ];
        var maxUmid = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->maxUmid}}"],
          @endforeach
        ];
    var minUmid = [
          @foreach($dadosSala2 as $dado)
          ["{{$dado->minUmid}}"],
          @endforeach
        ]
    var datas = @json($valor);
    var maxYUmid =parseFloat(maxUmid[0])+20;
    var minYUmid =parseFloat(minUmid[0])-20;
    var maxYTemp =parseFloat(maxTemp[0])+5;
    var minYTemp =parseFloat(minTemp[0])-5;
      var ctx = document.getElementById('myChart5').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'line',     
          data: {
              labels: datas,
              datasets: [{
                  label: 'Temperatura',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: temp,
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spTemp,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minTemp,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'true',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxTemp,
                  pointRadius: 0,
              },
            
            ],
          
          },
      
          // Configuration options go here
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYTemp,
                              min : minYTemp
                          },
                      }]
                  },
                  responsive:true,
    chartArea: {
        backgroundColor: 'rgba(251, 85, 85, 0.4)'
    },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20
                  }
              }
              }
      });
        var ctx = document.getElementById('myChart6').getContext('2d');
        var chart = new Chart(ctx, {
          type: 'line',
          data: {
              labels: datas,
              datasets: [{
                  label: 'Umidade',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(66, 99, 132)',
                  pointBackgroundColor:'rgb(66, 99, 132)',
                  data: umid,          
              },{
                label: 'SP',
                  fill: false,
                  backgroundColor: 'rgba(255, 255, 0, 0.1)',
                  borderColor: 'rgb(36, 99, 36)',
                  pointBackgroundColor:'rgb(36, 99, 36)',
                  data: spUmid,
                  pointRadius: 0,
              },{
                label: 'Min',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: minUmid,
                  pointRadius: 0,
              },{
                label: 'Max',
                  fill: false,
                  backgroundColor: 'false',
                  borderColor: 'rgb(255, 0, 0)',
                  pointBackgroundColor:'rgb(255, 0, 0)',
                  data: maxUmid,
                  pointRadius: 0,
              },    
            ],  
          },
          options:{
                  scales: {
                      yAxes : [{
                          ticks : {
                              max : maxYUmid,
                              min : minYUmid
                          }
                      }]
                  },
                  legend: {
                  display: false,
                  labels: {
                    boxWidth: 20,
                  }
              },
              chartArea: {
                     backgroundColor: 'rgba(251, 85, 85, 1)'
              }
    }
      });
</script>

@stop