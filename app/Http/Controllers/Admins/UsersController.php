<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Usertype;
use DB;
use File;

class UsersController extends Controller
{

    public function index()
    {
        $users = DB::table('users')
        ->join('usertypes', 'users.role_id', '=', 'usertypes.id')
        ->select('users.*', 'usertypes.role')->orderBy('created_at', 'desc')
        ->get();

    	return response()
    		->json([
    			'users' => $users
    		]);
    }

    public function getrole()
    {
        $role = Usertype::all();

    	return response()
    		->json([
    			'roles' => $role
    		]);
    }
    public function addrole(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $roledata = new Usertype($request->all());
        $roledata->save();

        return response()
            ->json([
                'succeed' => true,
                'roledata' => $roledata

            ]);
    }

    public function create()
    {
        //
    }
    private function getFileName($file)
    {
    	return time().'-'.str_random(8).'.'.$file->extension();
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'phone' => 'required|max:10',
            
            'email' => 'required|email|unique:users',
            'role_id' => 'required',
            'password' => 'required|between:6,25'
        ]);
    

        $user = new User($request->all());
        $user->password = bcrypt($request->password);
        $user->save();

        return response()
            ->json([
                'registered' => true,
                'user' => $user

            ]);
    }

    public function show($id)
    {
        $user = User::with('usertypes')
        ->findOrFail($id);

    	return response()
    		->json([
    			'user' => $user
    		]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
