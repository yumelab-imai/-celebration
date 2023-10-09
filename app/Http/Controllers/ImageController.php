<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Image;

class ImageController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function uploadForm()
    {
        return view('image_upload');
    }

    public function saveImage(Request $request)
    {
        // ファイルを保存し、パスを取得
        $path1 = $request->file('image1')->store('images');
        $path2 = $request->file('image2')->store('images');

        // データベースに保存
        $image = new Image;
        $image->path1 = $path1;
        $image->path2 = $path2;
        $image->save();

        return redirect()->route('image.edit', $image->id);
    }

    public function editImage($id)
    {
        $image = Image::find($id);
        return view('image_edit', ['image' => $image]);
    }

}
