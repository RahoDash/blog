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

class ArticleController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    protected function create(Request $request)
    {
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


		Image::configure(array('driver' => 'imagick'));
		foreach ($request->imgContent as $image) {
            //Storage::disk('local')->put('img.jpg',file($request['imgContent']));

            $path = Storage::putFile('image', $image);

            // open an image file
            $img = Image::make($image->getRealPath());

            // now you are able to resize the instance
            $img->widen(900);

            // finally we save the image as a new file
            $img->save(storage_path('app\\public\\').$path);

			Photo::create([
				'photo_path' => $path,
				'article_id' => $article->id,
			]);
        }
        return back()->with('success','Les images ont bien été ajoutés');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        $photos = Photo::all()->where('article_id',$id);
        foreach ($photos as $photo){
            Storage::delete($photo->photo_path);
        }
        //Storage::delete($photo->photo_path);
        $article->delete();
        return back()
            ->with('success','Article removed successfully.');
    }
}
