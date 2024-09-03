<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImageController extends Controller
{
    use AuthorizesRequests;
    public function store(StoreImageRequest $request){
        $image = $request->user()->images()->create($request->all());
        $image->save();
        return response()->json($image, Response::HTTP_OK);
    }
    public function update(UpdateImageRequest $request,Image $image){
        $this->authorize('update',$image);
        $image->update($request->all());
        return response()->json(
            $image,
            Response::HTTP_OK
        );
    }
    public function destroy(Image $image){
        $this->authorize('delete',$image);
        $image->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
