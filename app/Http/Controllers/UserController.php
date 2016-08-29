<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Validator;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class UserController extends Controller {
    
    use EntrustUserTrait;
    
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    
    
    public function index() {
        $user = User::paginate(15);

        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create() {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return void
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', 'User add not completed!Validation problems found.');
            return view('user.create')
                            ->withErrors($validator)
                            ->withInput($request->all());
        }
        $data = $request->except('role');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $user->detachRoles(\App\Role::all());
        $user->attachRole(\App\Role::find($request->input('role')));
        Session::flash('flash_message', 'User added!');

        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id) {
        $user = User::findOrFail($id);

        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id) {
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function update($id, Request $request) {

        $user = User::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users,'.$user->id,
                    'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            Session::flash('flash_message', 'User update not completed!Validation problems found.');
            return view('user.edit')
                            ->withErrors($validator)
                            ->with('user', $user);
        }
        $data = $request->except('role');
        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);
        $user->detachRoles(\App\Role::all());
        $user->attachRole(\App\Role::find($request->input('role')));
        
        Session::flash('flash_message', 'User updated!');

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id) {
        User::destroy($id);

        Session::flash('flash_message', 'User deleted!');

        return redirect('user');
    }

}
