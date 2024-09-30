<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSerieRequest;
use App\Http\Requests\UpdateSerieRequest;
use App\Http\Resources\SerieCollection;
use App\Http\Resources\SerieResource;
use App\Models\Serie;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SerieController extends Controller
{
    use AuthorizesRequests;
    public function index(Request $request){

        if($request->has('query')){
            return $this->search($request);
        }

        $series = Serie::orderBy('updated_at','desc')->paginate(10  );
        return new SerieCollection($series);
    }
    public function store(StoreSerieRequest $request){
        $serie = $request->user()->series()->create($request->all());
        $serie->save();

        return response()->json(
            new SerieResource($serie),
            Response::HTTP_CREATED
        );
    }
    public function show(Serie $series){
        $series = $series->load('chapters','user');
        return new SerieResource($series);
    }
    public function update(UpdateSerieRequest $request,Serie $series){
        $this->authorize('update',$series);

        $series->update($request->all());
        return response ()->json(
            new SerieResource($series),Response::HTTP_OK
        );
    }
    public function destroy(Serie $series){
        $this->authorize('delete', $series);
        $series->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }

    public function search(Request $request){
        $request->validate([
            'query'=>'required|string',
        ]);
        $searchTerm = $request->query('query');

        $series = Serie::where('title','LIKE','%'.$searchTerm.'%')->get();;
        return new SerieCollection($series);
    }
}
