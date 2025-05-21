<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Modules\Admin\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin::users.index',['users'=>User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!Gate::allows('is_admin')) {
            return "youre not admin" ;
         }
        return view('admin::users.create',[
            'roles'=>Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request) {
        $data= $request->validated();
       $user = User::create([
            'name'=>$data->name ,
            'email'=>$data->email ,
            'password'=>Hash::make($data->password)
        ]) ;

        $user->roles()->attach($data->role) ;
        return redirect()->back()->with('success','user created successfully !') ;
    }


    public function show($id)
    {
        return view('admin::users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if (Auth::User()->id != $id && !Gate::allows('is_admin')) {
            abort(403);
        } else {
            $user = User::with('roles')->findOrFail($id) ;
            $roles = Role::all() ;
            return view('admin::users.edit',compact('user','roles'));
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {

    $user = User::findOrFail($id) ;
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'roles' => 'array', // optional if user can have multiple roles
        'roles.*' => 'exists:roles,id',
    ]);
    $user->update([
        'name' => $request->name,
        'email' => $request->email,
    ]);

    // Sync roles
    $user->roles()->sync($request->roles ?? []);

    return redirect()->back()->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
