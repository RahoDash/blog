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
use Mockery\Exception;
use Illuminate\Support\Facades\DB;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy($id)
    {
        try {
            $photo = Photo::find($id);
            Storage::delete($photo->photo_path);
            $exist = Storage::disk('public')->exists($photo->photo_path);
            if (!$exist){
                $photo->delete();
            }
            return back()->with('success','Image removed successfully.');
        }
        catch (\Exception $e){
            return back()->withErrors(["Something went wrong !"]);
        }
    }

    public function addPicture($article_id, Request $request)
    {
        $this->validate($request, [
            'imgContent.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->imgContent as $picture) {
                $path = Storage::putFile('image', $picture);

                $img = Image::make($picture->getRealPath());
                $img->widen(900);
                $img->save(storage_path('app\\public\\') . $path);

                Photo::create([
                    'photo_path' => $path,
                    'article_id' => $article_id,
                ]);
            }
            DB::commit();
            return back()->with('success','Image removed successfully.');
        }
        catch (\Exception $e){
            DB::rollBack();
            return back()->withErrors(["Something went wrong !"]);
        }
    }
}
