<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use Illuminate\Http\Request;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\SeriesRepository;
use App\Http\Middleware\Autenticador;
use Illuminate\Support\Facades\Mail;
use App\Mail\SeriesCreated;
use DB;


class SeriesController extends Controller
{
    public function __construct(SeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }

    public function index(Request $request)
    {
        $series = Series::with(['seasons'])->get();
        $mensagemSucesso = session('mensagem.sucesso');

        return view('series.index')->with('series', $series)->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create()
    {
        return view('series.create'); 
    }

    public function store(SeriesFormRequest $request, SeriesRepository $repository)
    {
        $coverPath = $request->hasFile('cover')
            ? $request->file('cover')->store('series_cover', 'public')
            : null;
        $request->coverPath = $coverPath; 
        $serie = $repository->add($request);
        
        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso! ");
    }
    
    public function destroy(Series $series)
    {
        $series->delete();
        
        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }
    
    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->nome = $request->nome;
        $series->save();

        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' editada com sucesso!");
    }
}
