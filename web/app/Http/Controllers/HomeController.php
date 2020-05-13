<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\exterior;
use App\sala1;
use App\sala2;
use App\laboratorio;
use App\ambiente;
use App\User;
use App\Charts\Temp;
use App\Charts\Umid;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($ambiente = null, $size = null)
    {
        if (!isset($size)) {
            $size = 60;
            $dadosSala1 = sala1::latest()->take($size)->get()->reverse();
            $dadosTemp = laboratorio::latest()->take($size)->get()->reverse();
            $dadosSala2 = sala2::latest()->take($size)->get()->reverse();
        }
        $sizePadrao = 60;
        if ($ambiente == 1) {
            $dadosSala1 = sala1::latest()->take($size)->get()->reverse();
            $dadosTemp = laboratorio::latest()->take($sizePadrao)->get()->reverse();
            $dadosSala2 = sala2::latest()->take($sizePadrao)->get()->reverse();
        } elseif ($ambiente == 2) {
            $dadosSala1 = sala1::latest()->take($sizePadrao)->get()->reverse();
            $dadosSala2 = sala2::latest()->take($size)->get()->reverse();
            $dadosTemp = laboratorio::latest()->take($sizePadrao)->get()->reverse();
        } elseif ($ambiente ==3) {
            $dadosSala1 = sala1::latest()->take($sizePadrao)->get()->reverse();
            $dadosSala2 = sala2::latest()->take($sizePadrao)->get()->reverse();
            $dadosTemp = laboratorio::latest()->take($size)->get()->reverse();
        } else {
        }
        $ambiente = ambiente::all()->last();
        $aLab = ambiente::where('id', 3)->first();
        $asala1 = ambiente::where('id', 1)->first();
        $asala2 = ambiente::where('id', 2)->first();
        $sala1 =  sala1::all()->last();
        $sala2 = sala2::all()->last();
        $exterior = exterior::all()->last();
        $lab = laboratorio::all()->last();
       
        $eTemp = (float)($lab->temp - $lab->spTemp)*100/$lab->spTemp;
        $eTemp = number_format($eTemp, 2);
        $eUmid = (float)($lab->umid - $lab->spUmid)*100/$lab->spUmid;
        $eUmid = number_format($eUmid, 2);
        
        if ($aLab->temp > $aLab->spTemp) {
            $variacaoLabMax = $aLab->maxTemp - $aLab->spTemp;
            $estadoLab = ($aLab->temp-$aLab->spTemp)*100/$variacaoLabMax;
        } else {
            $variacaoLabMin = $aLab->spTemp - $aLab->SminTemp;
            $estadoLab = ($aLab->spTemp-$aLab->temp)*100/$variacaoLabMin;
        }
        
        $chart = new Temp;
        $chart2 = new Umid;
        // $api = url('/atualizagraf');
        $valorLab  = array($size);
        // $minTemp [] = array($size);
        // $maxTemp [] = array($size);
        // $minUmid [] = array($size);
        // $maxUmid [] = array($size);
        $i = 0;
        $nomeAmbiente = $ambiente->pluck('nome');
        foreach ($dadosTemp as $dado) {
            $valor[$i]= ($dado->created_at)->format('H:i');
            // $minTemp[$i] = $aLab->minTemp;
            // $maxTemp[$i] = $aLab->maxTemp;
            // $minUmid [$i] = $aLab->minUmid;
            // $maxUmid [$i] = $aLab->maxUmid;
            $i++;
        }
    
        return view('home', compact('dadosSala1', 'dadosSala2', 'asala1', 'asala2', 'estadoLab', 'aLab', 'eTemp', 'eUmid', 'sala1', 'sala2', 'exterior', 'lab', 'dadosTemp', 'nomeAmbiente', 'valor'));
    }

    public function exibePerfil()
    {
        $user = User::find(Auth::user()->id);
        return view('perfil', compact('user'));
    }
    public function atualizaPerfil(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $repassword = $request->input('repassword');
        if (isset($name)) {
            $user->name = $name;
        }
        if (isset($email)) {
            $user->email = $email;
        }
        if (isset($password) && isset($repassword)) {
            if ($password == $repassword) {
                $user->password = Hash::make($password);
                $user->save();
            } else {
                return redirect()
            ->back()
            ->with('error', 'As senhas informadas nao são iguais');
            }
        } else {
            return redirect()
            ->back()
            ->with('error', 'Senha nao preenchida');
        }
        if ($user = true) {
            return redirect()
            ->back()
            ->with('success', 'Dados atualizados com sucesso!');
        } else {
            return redirect()
            ->back()
            ->with('error', 'Erro ao atualizar dados!');
        }
    }
}
