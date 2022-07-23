<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        //
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
