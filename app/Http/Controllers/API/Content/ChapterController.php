<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChapterRequest;
use App\Http\Requests\UpdateChapterRequest;
use App\Http\Resources\ChapterResource;
use App\Models\Chapter;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ChapterController extends Controller
{
    use AuthorizesRequests;
    public function show(Chapter $chapter){
        $chapter = $chapter->load('images');
        return new ChapterResource($chapter);
    }

    public function store(StoreChapterRequest $request){
        $user=Auth::user();

        $chapter=$user->chapters()->create(array_merge(
            $request->validated(),
            ['owner_id' => $user->id]
        ));

        return response()->json(
            new ChapterResource($chapter),
            Response::HTTP_CREATED
        );
    }
    public function update(UpdateChapterRequest $request,Chapter $chapter){
        $this->authorize('update', $chapter);

        $chapter->update($request->validated());
        return response()->json(
            new ChapterResource($chapter)
            ,Response::HTTP_OK
        );
    }
    public function destroy(Chapter $chapter){
        $this->authorize('delete',$chapter);
        $chapter->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
