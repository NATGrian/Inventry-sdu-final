<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Relevants;
use App\Models\Relevant_groups;

class RelevantController extends Controller
{

    public function index()
    {
        $relevants = DB::table('relevants')
        ->join('relevant_groups', 'relevants.GID', '=', 'relevant_groups.id')
        ->select('relevants.*', 'relevant_groups.role')
        ->get();

    	return response()
    		->json([
    			'relevants' => $relevants
    		]);
    }
    public function getrelevants()
    {
        $relevants = DB::table('relevants')
        ->join('relevant_groups', 'relevants.GID', '=', 'relevant_groups.id')
        ->select('relevants.*', 'relevant_groups.role')
            ->paginate(10);

            return response()
    		->json([
    			'relevants' => $relevants
    		]);
    }
    public function getgroups()
    {
        $groups = Relevant_groups::all();

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
    
        $relevant = new Relevants($request->all());
        $relevant->save();

        return response()
            ->json([
                'succeed' => true,
            ]);
    }
    public function addgroups(Request $request)
    {
        $this->validate($request, [
            'role' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
    
        $groups = new Relevant_groups($request->all());
        $groups->save();

        return response()
            ->json([
                'succeed' => true,

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
        Relevants::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function groupsdestroy($id)
    {
        Relevant_groups::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }
}
