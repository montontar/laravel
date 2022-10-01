<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Providers\RouteServiceProvider;
use App\Post;
use App\PostDetail;
use Storage;


class PostController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $posts =  new Post;

        if($request->hasFile('images')){

            $name = $request->file('images')->getClientOriginalName();
            $path = $request->file('images')->store('public');
            $img_ext =  strtolower($request->file('images')->getClientOriginalExtension());

            $posts->images = $request->images;
            $posts->path = $path;

            Storage::disk('local')->put($img_ext, $path);
            $posts->update(['images' => $posts->images]);

        }
            $posts->title = $request->get('title');
            $posts->body = $request->get('body');
            $posts->user_id = Auth :: user()->id;
    
            $posts->save();
           

            

            // dd($posts);
        
        
            return redirect()->to('posts');

    }

   
    public function index()
    {
        $posts = Post::select('id', 'title')->get();
        $posts = Post::latest()->paginate(5);
        return view('post.index',compact(['posts']));
    }

    public function show($id)
    {
        $posts = Post::find($id);
        return view('post.show', compact(['posts']));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'is_status'=>'required',
        ]);
        $posts = Post::find($id);

        $posts = array();
        $posts["user_id"] =  Auth::user()->id;
        $posts["posts_id"] =  $request->get("is_status");
        $posts["is_status"] =  "1";

        //query builder
        DB::table('post_details')->insert($posts);
    
        return redirect()->to('/newfeed');
    }
    public function destroy($id)
    {

    }

}
