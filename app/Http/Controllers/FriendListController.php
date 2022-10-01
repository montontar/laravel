<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Follow;
use Validator;

class FriendListController extends Controller
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
        $data=User::latest()->paginate(5);
        $follow=Follow::all();
        // $follow=Follow::where("is_status",1)->get();
        
        $val = [
            "data" => $data,
            "follow" => $follow,
        ];

        return view('friendlist.friendlist',compact(['data','follow']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('friendlist.friendlist');
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
            'follow'=>'required',
        ]);
        
        $follow = array();
        $follow["user_id"] =  Auth::user()->id;
        $follow["user_id_follow"] =  $request->follow;
        $follow["follower"] =  "1";
        $follow["is_status"] =  "1";

        //query builder
        DB::table('follows')->insert($follow);
                            
        return redirect()->back()->with('success',"ติดตามเรียบร้อย");
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
            'following'=>'required',
        ]);

        //query builder
        Follow::find($id)->update($request->all());
        return redirect('/friendlist');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Follow::find($id)->delete();
        return redirect('/friendlist');
    }
}
