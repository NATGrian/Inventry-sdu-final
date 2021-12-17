<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\peoples;
use App\Models\people_groups;

class PeopleController extends Controller
{

    public function index()
    {
        $peoples = DB::table('peoples')
        ->join('people_groups', 'peoples.GID', '=', 'people_groups.id')
        ->select('peoples.*', 'people_groups.role')
        ->get();

    	return response()
    		->json([
    			'peoples' => $peoples
    		]);
    }
    public function getgroups()
    {
        $groups = people_groups::all();

    	return response()
    		->json([
    			'groups' => $groups
    		]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'description' => 'required|max:255',
            'GID' => 'required',
        ]);
    
        $people = new peoples($request->all());
        $people->save();

        return response()
            ->json([
                'succeed' => true,
                'people' => $people

            ]);
    }
    public function addgroups(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
    
        $groups = new people_groups($request->all());
        $groups->save();

        return response()
            ->json([
                'succeed' => true,
                'group' => $groups
            ]);
    }
    public function show($id)
    {
        //
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
