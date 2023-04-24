<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $query = Series::query();
        if ($request->has('nome')){
            $query->where('nome', $request->nome);
        }

        return $query->paginate(5);
    }

    public function store(SeriesFormRequest $request)
    {
        return response()
        ->json(Series::create($request->all()), 201);
    }

    public function show(Request $request, $id)
    {
        $seriesModel = Series::with('seasons.episodes')->find($id);
        if ($seriesModel === null) {
            return response()->json(['message' => 'Serie não encontrada!'], 404);
        }

        return $seriesModel;
    }

    public function update(Series $series, SeriesFormRequest $request)
    {
        $series->fill($request->all());
        $series->save();

        return $series;
    }

    public function destroy(Request $request, $id)
    {
        Series::destroy($id);

        return response()->noContent();
    }
}
