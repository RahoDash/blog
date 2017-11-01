<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\File;
use App\Photo;
use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic as Image;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy($id)
    {
        //dd($id);
        $photo = Photo::find($id);
        //dd($photo);
        Storage::delete($photo->photo_path);
        $photo->delete();
        return back()
            ->with('success','Image removed successfully.');
    }
}
