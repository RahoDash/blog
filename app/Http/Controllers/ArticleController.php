<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Photo;
use Intervention\Image\ImageManagerStatic as Image;

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
        $this->validate($request, [
            'title' => 'required|unique:articles',
            'imgContent.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:3072',
        ]);
        try {
            $id = Auth::user()->id;

            $article = Article::create([
                'title' => $request['title'],
                'description' => $request['description'],
                'user_id' => $id,
            ]);

            $this->addPicture($request->imgContent,$article->id);

            DB::commit();
            return back()->with('success', 'Les images ont bien été ajoutées.');
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }

    protected function addPicture($pictures ,$article_id){
        foreach ($pictures as $picture) {
            $path = Storage::putFile('image', $picture);

            $img = Image::make($picture->getRealPath());
            $img->widen(900);
            $img->save(storage_path('app\\public\\') . $path);

            Photo::create([
                'photo_path' => $path,
                'article_id' => $article_id,
            ]);
        }
    }

    public function destroy($id)
    {
        try{
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
        catch (\Exception $e){
            return back()->withErrors(['Error ! Something went wrong.']);
        }
    }

    public function updateDesc($article_id, Request $request){
        try{
            $article = Article::find($article_id);
            $article->description = $request->description;
            $article->save();

            return back()->with('success', 'Article removed successfully.');
        }catch (\Exception $e){
            return back()->withErrors(['Error ! Something went wrong.']);
        }
    }
}
