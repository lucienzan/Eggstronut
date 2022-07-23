<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserManageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::when(request('keyword'),function($q){
            $keyword = request("keyword");
            $q->orWhere("name","like","%$keyword%")
            ->orWhere("email","like","%$keyword%");
        })->latest('id')
        ->paginate(10);

        return view('user-manage.index',compact('users'));
    }

    public function changeRole(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        switch ($user->role) {
            case '1':
                $user->role = "0";
                break;
            default:
                $user->role = "1";
                break;
        }
        $user->update();
        return  redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function banRole(Request $request)
    {
        $user = User::where('id',$request->id)->first();
        switch($user->isBanned){
            case '1':
            $user->isBanned = "0";
            break;
            default:
            $user->isBanned = "1";
            break;
        }
        $user->update();
        return  redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {
        $validate = Validator::make($request->all(),[
          "newPassword" => "required|min:8",  
        ]); //use this when you passed the data with ajax
        if($validate->fails()){
            return response()->json(["status"=>422,"message"=>$validate->errors()]);
        }
        $current_user = User::find($request->id);
        if($current_user->role == "1"){
            $current_user->password = Hash::make($request->newPassword);
            $current_user->update();
        }
        return response()->json(["status"=>200,"message"=>"Password is successfully changed."]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
