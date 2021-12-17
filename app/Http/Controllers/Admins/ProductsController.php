<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use App\Models\Storages;
use App\Models\Peoples;
use App\Models\Categorys_products;
use App\Models\Export_product_items;
use App\Models\Import_product_items;

class ProductsController extends Controller
{
    public function getcategory()
    {
        $category = Categorys_products::all();

    	return response()
    		->json([
    			'category' => $category
    		]);
    }
    public function addcategory(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'description' => 'required|max:255',
        ]);
        $categorys = new Categorys_products($request->all());
        $categorys->save();

        return response()
            ->json([
                'succeed' => true,
                'categorys' => $categorys

            ]);
    }
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
