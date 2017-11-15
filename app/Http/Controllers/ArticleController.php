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
use Whoops\Exception\ErrorException;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected function create(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->validate($request, [
                'title' => 'required|unique:articles',
                'imgContent.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:3072',
            ]);

            $id = Auth::user()->id;

            $article = Article::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'user_id' => $id,
            ]);

            foreach ($request->imgContent as $image) {
                $path = Storage::putFile('image', $image);

                $img = Image::make($image->getRealPath());
                $img->widen(900);
                $img->save(storage_path('app\\public\\') . $path);

                Photo::create([
                    'photo_path' => $path,
                    'article_id' => $article->id,
                ]);
            }

            DB::commit();
            return back()->with('success', 'Les images ont bien été ajoutées.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['Error ! Something went wrong.']);
        }
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $photos = Photo::all()->where('article_id', $id);
        foreach ($photos as $photo) {
            Storage::delete($photo->photo_path);
            $exist = Storage::disk('public')->exists($photo->photo_path);
            if (!$exist){
                $photo->delete();
            }
        }
        //Storage::delete($photo->photo_path);
        $photos = Photo::where('article_id', $id)->first();

        if ($photos == null){
            $article->delete();
        }

        return back()->with('success', 'Article removed successfully.');
    }
}
