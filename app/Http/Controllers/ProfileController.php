<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Storage;
class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data=User::all();
        return view('profile.profile',compact(['data']));
        
    }

    public function save(Request $request)
    {
        $validatedData = $request->validate([
         'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
 
        ]);
        $user = new User;
        $name = $request->file('images')->getClientOriginalName();
        $path = 'app/uploads/images';
        // $path = $request->file('images')->store('app/uploads/images');
        $img_ext =  strtolower($name->getClientOriginalExtension());
 
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->images = $request->images;
        $user->path = $path;
       
        Storage::disk('local')->put($name.'.'.$img_ext, $path);


        $user->save();
 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('profile.profile');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
        ]);

        User::create($request->all());
        return redirect('/profile');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=User::find($id);
        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=User::find($id);
        return view('profile.profile',compact(['data']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'images' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $name = $request->file('images')->getClientOriginalName();
        $path = $request->file('images')->store('public');
        $img_ext =  strtolower($request->file('images')->getClientOriginalExtension());
        
        $user =  User::find($id);
 
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->images = $request->images;
        $user->path = $path;

        $user->update();
        
        Storage::disk('local')->put($img_ext, $path);
        return redirect('/profile');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return redirect('/profile');
    }
}
