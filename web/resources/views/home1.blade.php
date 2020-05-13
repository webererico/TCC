<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
  {{-- <title>@yield('page-title')</title> --}}
  {{-- <link rel="icon" href="{!! asset('images/gcm_ico.ico') !!}"/>  --}}
</head>
@extends('adminlte::page')
@section('title', 'LabEnsaios')

@section('content_header')
<h1>Olá {{Auth::user()->name}}, bem-vindo ao Dashboard LabEnsaios</h1>



@stop
@section('content')
<section class="content">
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      @if($lab->temp >=1.05*$aLab->spTemp) {{--30 -> 27--}}
      @if($lab->temp >= 0.9*$aLab->maxTemp)
      <div class="small-box bg-red">
        @else
        <div class="small-box bg-orange">
          @endif
          @elseif ($lab->temp < 0.95*$aLab->spTemp)
            @if($lab->temp > 1.05*$aLab->minTemp)
            <div class="small-box bg-orange">
              @else
              <div class="small-box bg-red">
                @endif
                @else
                <div class="small-box bg-green">
                  @endif


                  <div class="inner">
                    <h3>{{number_format($lab->temp, 1)}}ºC</h3>
                    <h3>{{$lab->umid}}%</h3>
                  </div>
                  <div class="icon">
                  </div>
                  <a class="small-box-footer">{{$nomeAmbiente[2]}}</a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>{{number_format($sala1->temp, 1)}}ºC</h3>
                    <h3>{{$sala1->umid}}%</h3>
                  </div>
                  <div class="icon">
                  </div>
                  <a href="#" class="small-box-footer">{{$nomeAmbiente[0]}}</a>
                </div>
              </div>
              <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3>{{number_format($sala2->temp, 1)}}ºC</h3>
                    <h3>{{$sala2->umid}}%</h3>
                  </div>
                  <div class="icon">
                  </div>
                  <a class="small-box-footer">{{$nomeAmbiente[1]}}</a>
                </div>
              </div>
              <div class="col-lg-2 col-xs-6">
                <div class="small-box bg-black">
                  <div class="inner">
                    <h3>{{number_format($exterior->temp,1)  }}ºC</h3>
                    <h3>{{$exterior->umid}}%</h3>
                  </div>
                  <div class="icon">
                  </div>
                  <a class="small-box-footer">{{$nomeAmbiente[3]}}</a>
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
                    <h3 class="box-title">Laboratório de Ensaios</h3>
                    <div class="box-tools pull-right">
                      <div class="btn-group">
                        <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-wrench"></i></button>
                        <ul class="dropdown-menu keep-open" role="menu">
                          <li><a href="/alterar/controle">Alterar Controle</a></li>
                          <li class="divider"></li>
                          <li><a href="/ambiente3">Alterar SetPoints</a></li>
                          <li>
                          <li class="divider"></li>
                          <p style="text-align: center"> Pontos no Gráfico </p>


                          <a href='/home/5' value="5" id="pontos" name="pontos" class="btn btn-bitbucket"
                            style="font-size: 10px">5
                          </a>
                          <a href='/home/60' value="60" id="pontos" name="pontos" class="btn btn-bitbucket"
                            style="font-size: 10px">60</a>
                          <a href='/home/240' value="240" id="pontos" name="pontos" class="btn btn-bitbucket"
                            style="font-size: 10px">240</a>
                          <a href='/home/480' value="480" id="pontos" name="ponts" class="btn btn-bitbucket"
                            style="font-size: 10px">480</a>


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
                              {{-- {!! $chart->container() !!}
                                {!! $chart->script() !!} --}}
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
                  <div class="box-footer">
                    <div class="row">
                      <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                          <p>Temperatura<p>
                              <?php if ($eTemp>0): ?>
                              <span class="description-percentage text-green">
                                <i class="fa fa-caret-up"></i> {{$eTemp}} %</span>
                              <?php elseif ($eTemp<0):?>
                              <span class="description-percentage text-red">
                                <i class="fa fa-caret-down"></i> {{$eTemp}} %</span>
                              <?php else: ?>
                              <span class="description-percentage text-yellow">
                                <span class="description-percentage text-yellow">0%</span>
                                <?php endif; ?>
                                <h5 class="description-header">{{$lab->temp}} ºC</h5>
                                <span class="description-text">SETPOINT: {{$lab->spTemp}} ºC</span>
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                          <p>Umidade<p>
                              <?php if ($eUmid>0): ?>
                              <span class="description-percentage text-green">
                                <i class="fa fa-caret-up"></i> {{$eUmid}} %</span>
                              <?php elseif ($eUmid<0):?>
                              <span class="description-percentage text-red">
                                <i class="fa fa-caret-down"></i> {{$eUmid}} %</span>
                              <?php else: ?>
                              <span class="description-percentage text-yellow">
                                <span class="description-percentage text-yellow">0%</span>
                                <?php endif; ?>
                                <h5 class="description-header">{{$lab->umid}} %</h5>
                                <span class="description-text">SETPOINT: {{$lab->spUmid}} %</span>
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-6">
                        <div class="description-block border-right">
                          <p>Controle Temperatura<p>
                              <?php if ($aLab->status == "manual"): ?>
                              <span class="description-percentage text-red">MANUAL</span>
                              <?php elseif ($aLab->status == "automatico"): ?>
                              <span class="description-percentage text-green">AUTOMÁTICO</span>
                              <?php endif; ?>
                        </div>
                        <div class="description-block border-right">
                          <p>Controle Umidade<p>
                              <?php if ($aLab->statusUmid == "manual"): ?>
                              <span class="description-percentage text-red">MANUAL</span>
                              <?php elseif ($aLab->statusUmid == "automatico"): ?>
                              <span class="description-percentage text-green">AUTOMÁTICO</span>
                              <?php endif; ?>
                        </div>
                      </div>
                      <div class="col-sm-3 col-xs-5" style="text-align:center">
                        <div class="description-block">
                          <h5 class="description-header"></h5>
                          <span class="description-text">Ensaio</span>
                        </div>

                        <form action="/autoensaio/" method="post">
                          @csrf
                          <select name="time">
                            <option value="5" id="time" name="time" selected>5 hrs</option>
                            <option value="6" id="time" name="time">6 hrs</option>
                            <option value="7" id="time" name="time">8 hrs</option>
                            <option value="12" id="time" name="time">12 hrs</option>
                          </select>
                          <div style="padding-top: 5%">
                            <button href="/autoensaio" class="btn btn-bitbucket">Gerar ensaio automático</a>
                          </div>
                        </form>
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
 
  var minTemp =JSON.parse("{{ json_encode($minTemp) }}");
  var maxTemp =JSON.parse("{{ json_encode($maxTemp) }}");
  
  var datas = @json($valor);
  
  var maxY = maxTemp[0];

  var minY = minTemp[0];
  
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
        },{
          label: 'Min',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor:'rgb(255, 99, 132)',
            data: minTemp,
        },{
          label: 'Max',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 255, 100)',
            pointBackgroundColor:'rgb(255, 255, 100)',
            data: maxTemp,
        },
      
      ],
    
    },

    // Configuration options go here
    options:{
            scales: {
                yAxes : [{
                    ticks : {
                        max : maxY+5,
                        min : minY-5
                    }
                }]
            },
            legend: {
            display: true,
            labels: {
              boxWidth: 20
            }
        }
        }
});
</script>
<script type="text/javascript">
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
 
  var minUmid =JSON.parse("{{ json_encode($minUmid) }}");
  var maxUmid =JSON.parse("{{ json_encode($maxUmid) }}");
  
  var datas = @json($valor);
  
  var maxY = maxUmid[0]+10;
  
  var minY = minUmid[0]-10;
  
  
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
            backgroundColor: 'false',
            borderColor: 'rgb(36, 99, 36)',
            pointBackgroundColor:'rgb(36, 99, 36)',
            data: spUmid,
        },{
          label: 'Min',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor:'rgb(255, 99, 132)',
            data: minUmid,
        },{
          label: 'Max',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 255, 100)',
            pointBackgroundColor:'rgb(255, 255, 100)',
            data: maxUmid,
        },
      
      ],
    
    },

    // Configuration options go here
    options:{
            scales: {
                yAxes : [{
                    ticks : {
                        max : maxY,
                        min : minY
                    }
                }]
            },
            legend: {
            display: true,
            labels: {
              boxWidth: 20,
              
            }
        }
        }
});
</script>

{{-- SALA 1  --}}
</script>
<script type="text/javascript">
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
 
  var minUmid =JSON.parse("{{ json_encode($minUmid) }}");
  var maxUmid =JSON.parse("{{ json_encode($maxUmid) }}");
  
  var datas = @json($valor);
  
  var maxY = maxUmid[0]+10;
  
  var minY = minUmid[0]-10;
  
  
  var ctx = document.getElementById('myChart3').getContext('2d');
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
            backgroundColor: 'false',
            borderColor: 'rgb(36, 99, 36)',
            pointBackgroundColor:'rgb(36, 99, 36)',
            data: spUmid,
        },{
          label: 'Min',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 99, 132)',
            pointBackgroundColor:'rgb(255, 99, 132)',
            data: minUmid,
        },{
          label: 'Max',
            fill: false,
            backgroundColor: 'false',
            borderColor: 'rgb(255, 255, 100)',
            pointBackgroundColor:'rgb(255, 255, 100)',
            data: maxUmid,
        },
      
      ],
    
    },

    // Configuration options go here
    options:{
            scales: {
                yAxes : [{
                    ticks : {
                        max : maxY,
                        min : minY
                    }
                }]
            },
            legend: {
            display: true,
            labels: {
              boxWidth: 20,
              
            }
        }
        }
});
</script>

@stop