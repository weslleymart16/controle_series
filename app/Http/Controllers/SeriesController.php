<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Serie;
use Illuminate\Http\Request;


class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::all();
        $messagem = $request->session()->get('mensagem');

        //return view('series.index', compact('series'));

        return view('series.index')->with('series', $series)->with('messagem', $messagem);
    }

    public function create()
    {

        return view('series.create');

    }

    public function store(SeriesFormRequest $request)
    {

        $serie = Serie::create($request->all());
        $request->session()->flash('mensagem', "Série '{$serie->nome}' adicionada com sucesso");

        return redirect()->route('series.index');
    }

    public function destroy(Request $request, Serie $series){

        $series->delete();
        // $request->session()->flash('mensagem', "Série '{$series->nome}'  removida com sucesso");

        return to_route('series.index')->with('mensagem', "Série '{$series->nome}'  removida com sucesso");

    }

    public function edit(Serie $series)
    {
        return view('series.edit')->with('serie', $series);
    }

    public function update(Serie $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return to_route('series.index')->with('mensagem', "Série '{$series->nome}'  atualizada com sucesso");
    }

}
