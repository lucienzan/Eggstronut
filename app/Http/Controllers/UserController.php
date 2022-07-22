<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateNameRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateEmailRequest;
use App\Http\Requests\UpdatePasswordRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user-profile.profile',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        Gate::authorize('update',$user);
        Storage::delete('public/profile/'.$user->profile);

        if(!$request->hasFile('profile')){
            $user->profile="";
            $user->update();
            return redirect()->back()->with('photoNull','default-user-image.png');
        }

        $file =$request->file("profile");
        $newName = uniqid().".".$file->getClientOriginalExtension();
        $file->storeAs('public/profile',$newName);
        $user->profile = $newName;
        $user->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function changePassword(){
        return view('user-profile.edit-password');
    }

    public function updatePassword(UpdatePasswordRequest $request){
        $user = new User();
        $get_user = $user->find(Auth::id());
        $get_user->password = Hash::make($request->new_password);
        $get_user->update();
        
        Auth::logout();
        return redirect()->route('login');        
    }

    public function updateName(UpdateNameRequest $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();
        return redirect()->back();
    }

    public function updateEmail(UpdateEmailRequest $request,$id)
    {
        $user = User::find($id);
        $user->email = $request->email;
        $user->update();
        return redirect()->back();
    }

    public function updateInfo(Request $request)
    {
       $current_user = User::find(Auth::id());
       $current_user->phone = $request->phone;
       $current_user->address = $request->address;
       $current_user->save();
    return redirect()->back();
    }
}
