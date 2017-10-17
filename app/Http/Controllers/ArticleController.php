<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    protected function create(Request $request)
    {
    	/*$this->validate($request, [

			'title' => 'required|unique:articles',

	    ]);

    	$id = Auth::user()->id;
        Article::create([
            'title' => $request['title'],
            'description' => $request['description'],
            'user_id' => $id,
        ]);*/
		$count = $request['imgContents'];
        echo $count ;
		//return back()->with('success','L\'image a bien été ajouté');
    }

    public function fileUpload(Request $request)
	{
	    $this->validate($request, [

	        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3072',

	    ]);

	    $path = Storage::putFile('images', $request->file(''));

		return User::create([
            'image_path' => $path,
        ]);


	    return back()->with('success','Image Upload successful');
	}
}
