<?php

namespace App\Http\Controllers;

use App\Exports\ensaioExports;
use App\Exports\ensaioFromView;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\ambiente;
use App\ensaio;
use App\exterior;
use App\sala1;
use App\sala2;
use App\User;
use App\alerta;
use App\estados;
use DB;

use Carbon\Carbon;

class ControllerAmbientes extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editAmbiente($id)
    {
        
        $dados = ambiente::where('id', $id)->first();
        $estados = estados::where('id_ambiente', $id)->first();
        $estadosUmid = estados::where('id_ambiente', $id)->get()->last();
        $time = $timestamp = strtotime($dados->startTemp);
        $dataITemp = date('G:i', $time);
        $time1 = $timestamp = strtotime($dados->stopTemp);
        $dataFTemp = date('G:i', $time1);
        $time2 = $timestamp = strtotime($dados->startUmid);
        $dataIUmid = date('G:i', $time2);
        $time3 = $timestamp = strtotime($dados->stopUmid);
        $dataFUmid = date('G:i', $time3);
        $id_user = Auth::user()->id;
        $alerta = alerta::where('id_ambiente', $id)->where('id_user', $id_user)->first();
        if (!isset($alerta)) {
            $alerta = new alerta;
            $alerta->id_ambiente = $id;
            $alerta->id_user = $id_user;
            $alerta->save();
        }
        return view('edit', compact('dataITemp', 'dataFTemp', 'dataIUmid', 'dataFUmid','dados', 'alerta', 'estados', 'estadosUmid'));
    }
 
    public function configAmbiente($id)
    {
        $dados = ambiente::where('id', $id)->first();
        return view('config', compact('dados'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect('/home');
    }

    public function salvaConfig(Request $request, $id)
    {
        $dados = ambiente::where('id', $id)->first();
        $dados->nome = $request->input('ambiente');
        $dados->descricao = $request->input('descricao');
        $dados->save();
        if ($dados == true) {
            return redirect()->back()->with('success', 'Configurações alteradas com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Erro ao salvar configurações. Por favor, atualize a página e tente novamente');
        }
    }
    public function save(Request $request, $id)
    {
        $dados = ambiente::where('id', $id)->first();
        $data = "0000-00-00";
        if ($dados->id != 4) {
            $spTemp = (float)$request->input('spTemp');
            $spUmid = (float)$request->input('spUmid');
            $dados->status = $request->input('option');
            $dados->statusUmid = $request -> input('option1');
            $minTemp = $request->input('minTemp');
            $maxTemp = $request->input('maxTemp');
            $minUmid = $request->input('minUmid');
            $maxUmid = $request->input('maxUmid');
            $data = date('Y-m-d H:i:s', strtotime($request->input('dataITemp')));
            $dados->startTemp = $data ;
            $data = date('Y-m-d H:i:s', strtotime($request->input('dataFTemp')));
            $dados->stopTemp = $data ;
            $data = date('Y-m-d H:i:s', strtotime($request->input('dataIUmid')));
            $dados->startUmid = $data ;
            $data = date('Y-m-d H:i:s', strtotime($request->input('dataFUmid')));
            $dados->stopTemp = $data ;
            
            // dd(date('d-m-Y H:i:s', strtotime($request->input('dataITemp'))));
           
            // $dados->$stopTemp = date($request->input('dataFTemp'));
            // $dados->$startUmid = date($request->input('dataITemp'));
            // $dados->$stopUmid = date($request->input('dataFTemp'));
            // if($request->has('dataITemp')){
            //     dd("teste");
            // }

            if ($minTemp<$maxTemp) {
                if ($minTemp>$spTemp || $spTemp>$maxTemp) {
                    return redirect()->back()->with('error', 'Set Point temperatura fora do intervalo!');
                } else {
                    $dados->spTemp = $spTemp;
                    $dados->minTemp= $minTemp;
                    $dados->maxTemp = $maxTemp;
                }
            } else {
                return redirect()->back()->with('error', 'Intervalo de máximo e mínimo de temperatura incoerentes!');
            }
            if ($minUmid<$maxUmid) {
                if ($minUmid>$spUmid || $maxUmid<$spUmid) {
                    return redirect()->back()->with('error', 'Set Point Umidade fora do intervalo!');
                } else {
                    $dados->maxUmid = $maxUmid;
                    $dados->spUmid =$spUmid;
                    $dados->minUmid = $minUmid;
                }
            } else {
                return redirect()
                ->back()
                ->with('error', 'Intervalo de máximo e mínimo de umidade incoerentes!');
            }
        }
        $alerta = alerta::where('id_user', Auth::user()->id)->where('id_ambiente', $dados->id)->first();
        if (!isset($alerta)) {
            $alerta = new alerta;
            $alerta->id_ambiente = $dados->id;
            $alerta->id_user = Auth::user()->id;
            $alerta->avisoTemp = 0;
            $alerta->avisoUmid = 0;
        }
        $alerta->avisoTemp = $request->has('checkTemp');
        $alerta->avisoUmid = $request->has('checkUmid');
        
        $alerta->save();
        // $dados->start = $start;
        // $datos->stop = $stop;
        $dados->save();
        if ($dados == true && $alerta == true) {
            return redirect()->back()->with('success', 'Definições atualizadas!');
        } else {
            return redirect()->back()->with('error', 'Falha ao alterar as definições! Por favor, atualize a página.');
        }
    }

    public function novoEnsaio()
    {
        $ambientes = ambiente::all();
        return view('novoensaio', compact('ambientes'));
    }
    public function createEnsaio(Request $request)
    {
        $ensaio = new Ensaio;
        $ambiente = $request->input('ambiente');
        $from = $request->input('dataI');
        $to = $request->input('dataF');
        $ensaio->nome = $request->input('nome');
        $ensaio->dataI = $from;
        $ensaio->dataF = $to;
        $ensaio->id_ambiente = $ambiente;
        $ensaio->id_user = Auth::user()->id;
        $ensaio->data = $request->input('data');
        $ensaio->save();
        if ($ensaio = true) {
            return redirect()
                ->back()
                ->with('success', 'Ensaio criado!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao criar ensaio!');
        }
    }

    public function listaensaios()
    {
        $ensaios = DB::table('ensaios')->orderBy('created_at', 'DESC')->paginate(10);
        // $ensaios = ensaio::orderBy('created_at', 'DESC')->get();
        $users = User::all();
        $ambientes = ambiente::all();
        return view('ensaios', compact('ensaios', 'users', 'ambientes'));
    }

    public function downloadEnsaio($id)
    {
        // Excel::import(new modelo, 'file.xlsx');

        $ensaio = ensaio::find($id)->first();
        // $directors = [$ensaio->dataI, $ensaio->dataF, $ensaio->id_ambiente];
        return Excel::download(new ensaioExports($id), 'ensaio.xlsx');
        // Excel::load('file.xlsx', function($file) {

        //     // modify stuff
        
        // })->download('xlsx');
    }
    public function downloadEnsaioPDF($id)
    {
        $ensaio = ensaio::find($id)->first();
        $directors = [$ensaio->dataI, $ensaio->dataF, $ensaio->id_ambiente];
        return Excel::download(new ensaioExports($id), 'ensaio.pdf');
    }
    public function apagarEnsaio($id)
    {
        $ensaio = ensaio::find($id);
        if (isset($ensaio)) {
            $ensaio->delete();
            if (isset($ensaio)) {
                return redirect()
                ->back()
                ->with('success', 'Ensaio apagado!');
            } else {
                return redirect()
             ->back()
             ->with('error', 'Erro ao apagar!')
             ->withInput();
            }
        }
    }

    public function limpaBanco($id)
    {
        if ($id ==1) {
            $dado= DB::table('sala1s')->delete();
            $ensaio = DB::table('ensaios')->where('id_ambiente', 1)->delete();
        } elseif ($id ==2) {
            $dado= DB::table('sala2s')->delete();
            $ensaio = DB::table('ensaios')->where('id_ambiente', 2)->delete();
        } elseif ($id==3) {
            $dado= DB::table('laboratorios')->delete();
            $ensaio = DB::table('ensaios')->where('id_ambiente', 3)->delete();
        } elseif ($id==4) {
            $dado= DB::table('exteriors')->delete();
            $ensaio = DB::table('ensaios')->where('id_ambiente', 4)->delete();
        }

        if (isset($dado) && isset($ensaio)) {
            return redirect()
              ->back()
              ->with('success', 'Todos os dados do banco foram apagados!');
        } else {
            return redirect()
           ->back()
           ->with('error', 'Erro ao apagar!')
           ->withInput();
        }
    }

    public function download($id)
    {
        // Excel::download(new ensaioFromView($id), 'dados.xlsx');
        return Excel::download(new ensaioFromView($id), 'dados.xlsx');
        $lab =  laboratorio::query()->select('id', 'temp', 'umid', 'spUmid', 'spTemp', 'created_at')->whereRaw("created_at >= ? AND created_at <= ?", array($dataI, $dataF));
        // Excel::load('file.xlsx', function($file) {

        //     $sheet->row(1, array(
        //         'test1', 'test2'
        //    ));
        
        // })->download('xlsx');
    }
    public function alteraLab()
    {
        $dados = ambiente::where('id', 3)->first();
        
        if ($dados->status== "automatico") {
            $dados->statusUmid = "manual";
            $dados->status = "manual";
        } else {
            $dados->statusUmid = "automatico";
            $dados->status = "automatico";
        }
  
        $dados->save();
        if ($dados = true) {
            return redirect()
        ->back()
        ->with('success', 'Controle Alterado!');
        } else {
            return redirect()
        ->back()
        ->with('error', 'Falha ao alterar controle!');
        }
    }
    public function createEnsaioAuto(Request $request)
    {
        $ensaio = new Ensaio;
        $ambiente = 3;
        $time = (int)$request->input('time');
        $from = $date = Carbon::now()->subHours($time);
        $to = $mytime = Carbon::now();
        $ensaio->nome = 'Ensaio Gerado Automatico';
        $ensaio->dataI = $from;
        $ensaio->dataF = $to;
        $ensaio->id_ambiente = $ambiente;
        $ensaio->id_user = Auth::user()->id;
        $ensaio->data = $mytime = Carbon::now();
        $ensaio->save();
        if ($ensaio = true) {
            return redirect()
                ->back()
                ->with('success', 'Ensaio criado!');
        } else {
            return redirect()
                ->back()
                ->with('error', 'Falha ao criar ensaio!');
        }
    }

    public function controleManual($id, Request $request)
    {
        // $dados = ambiente::where('id', $id)->first();
        $estado = estados::find($id)->first();
        $estado->statusWeb = 'ligado';
        $estado->modo = $request->input('operacao');
        $estado->temp = $request->input('temperatura');
        $estado->save();
        if (isset($estado)) {
            return redirect()
        ->back()
        ->with('success', 'Controle Manual Realizado');
        } else {
            return redirect()
        ->back()
        ->with('error', 'Falha ao realizar controle manual');
        }
    }

    public function desligaArManual($id)
    {
        $ar = ar::where('id_ambiente')->first();
        $ar->statusWeb = false;
        $ar->save();
        if (isset($ar)) {
            return view('/edit/ambiente/'.$id)->back()
        ->with('success', 'Ar desligado manualmente');
        } else {
            return redirect('/edit/ambiente/'.$id)->
          back()
        ->with('error', 'Falha ao desligar ar remotamente');
        }
    }
}
