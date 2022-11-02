<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Storages;
use DB;

class StoragesController extends Controller
{

    public function index()
    {
        $storages = Storages::all();

        return response()
            ->json([
                'storages' => $storages
            ]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);

        $storage = new storages($request->all());
        $storage->save();

        return response()
            ->json([
                'succeed' => true,
                'storage' => $storage

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
        Storages::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }
}
