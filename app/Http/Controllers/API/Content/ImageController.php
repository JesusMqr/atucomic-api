<?php

namespace App\Http\Controllers\Api\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class ImageController extends Controller
{
    use AuthorizesRequests;
    public function store(StoreImageRequest $request){
        $user = Auth::user();

        $image = $user->images()->create(array_merge(
            $request->validated(),
            ['owner_id'=>$user->id]
        ));
        return response()->json($image, Response::HTTP_OK);
    }
    public function update(UpdateImageRequest $request,Image $image){
        //$this->authorize('update',$image);
        $image->update($request->validated());
        return response()->json(
            $image,
            Response::HTTP_OK
        );
    }
    public function destroy(Image $image){
        //$this->authorize('delete',$image);
        $image->delete();
        return response()->json(null,Response::HTTP_NO_CONTENT);
    }
}
