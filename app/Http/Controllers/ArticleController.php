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
			'imgContent.0' => 'required|mimes:jpeg,png,jpg,gif,svg|max:3072',
	    ]);

    	$id = Auth::user()->id;
        $article = Article::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => $id,
        ]);
		//Storage::disk('local')->put('img.jpg',file($request['imgContent']));
        //return count($request['imgContent']);
		//return back()->with('success','L\'image a bien été ajouté');
		$count = count($request->imgContent);
		//$request->imgContent;
		Image::configure(array('driver' => 'imagick'));
		foreach ($request->imgContent as $image) {
			$path = Storage::putFile('image', Image::make($image)->resize(900,null));
			Photo::create([
				'photo_path' => $path,
				'article_id' => $article->id,
			]);
        }
        return back()->with('success','L\'image a bien été ajouté');
    }
}
