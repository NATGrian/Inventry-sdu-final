<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

use App\Models\Storages;
use App\Models\Peoples;

use App\Models\Item_ingredients;
use App\Models\Import_ingredients_items;
use App\Models\Export_ingredients_items;

use App\Models\Categorys_ingredients;

use DB;

class IngredientsController extends Controller
{
    public function getcategory()
    {
        $category = Categorys_ingredients::all();

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
        $categorys = new Categorys_ingredients($request->all());
        $categorys->save();

        return response()
            ->json([
                'succeed' => true,
                'categorys' => $categorys

            ]);
    }
    public function index()
    {
        $list = DB::table('item_ingredients')
            ->join('categorys_ingredients', 'item_ingredients.CID', '=', 'categorys_ingredients.id')
            ->select('item_ingredients.*', 'categorys_ingredients.name')->orderBy('created_at', 'desc')
            ->get();

        return response()
            ->json([
                'list' => $list
            ]);
    }
    public function getimport($id)
    {
        $Item = Item_ingredients::findOrFail($id);

        return response()
            ->json([
                'itemimport' => $Item
            ]);
    }

    public function getsearch($id)
    {
        $Item = DB::table('import_ingredients_items')
        ->join('item_ingredients', 'import_ingredients_items.idrm', '=', 'item_ingredients.id')
        ->select('import_ingredients_items.*' , 'item_ingredients.itemname', 'item_ingredients.qty')
        ->where('import_ingredients_items.id', $id)->first();

        return response()
            ->json([
                'itemexport' => $Item
            ]);
    }

    public function getrecord()
    {
        $record = DB::table('import_ingredients_items')
            ->join('users', 'import_ingredients_items.UID', '=', 'users.id')
            ->join('item_ingredients', 'import_ingredients_items.idrm', '=', 'item_ingredients.id')
            ->join('peoples', 'import_ingredients_items.PID', '=', 'peoples.id')
            ->join('storages', 'import_ingredients_items.storageID', '=', 'storages.id')
            ->select('import_ingredients_items.*' , 'users.firstname', 'item_ingredients.itemname', 'peoples.firstname', 'storages.name')
            ->orderBy('import_ingredients_items.created_at', 'desc')
            ->get();

        $record1 = DB::table('export_ingredients_items')
            ->join('users', 'export_ingredients_items.UID', '=', 'users.id')
            ->join('item_ingredients', 'export_ingredients_items.idrm', '=', 'item_ingredients.id')
            ->join('peoples', 'export_ingredients_items.PID', '=', 'peoples.id')
            ->select('export_ingredients_items.*' , 'users.firstname', 'item_ingredients.itemname', 'peoples.firstname')
            ->orderBy('export_ingredients_items.created_at', 'desc')
            ->get();

        return response()
            ->json([
                'record' => $record,
                'record1' => $record1
            ]);
    }

    public function import_Ingredients (Request $request) {
        $this->validate($request, [
            'rc_no' => 'required',
            'UID' => 'required',
            'itemname' => 'required',
            'EXP' => 'required',
            'import_at' => 'required',
            'MFG' => 'required',
            'qty' => 'required',
            'qty_charge' => 'required',
            'LOT_no' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
            'storageID' => 'integer',
        ]);
        
        Item_ingredients::where('id',$request->itemname)
                ->update(['qty' => $request->qty]);

        $Import = new Import_ingredients_items();
        $Import->UID = $request->UID;
        $Import->rc_no = $request->rc_no;
        $Import->idrm = $request->itemname;
        $Import->EXP = $request->EXP;
        $Import->import_at = $request->import_at;
        $Import->MFG = $request->MFG;
        $Import->invoice_no = $request->invoice_no;
        $Import->qty_balance = $request->qty;
        $Import->qty_charge = $request->qty_charge;
        $Import->LOT_no = $request->LOT_no;
        $Import->status = 'นำเข้า';
        $Import->description = $request->description;
        $Import->PID = $request->PID;
        $Import->storageID = $request->storageID;
        $seve = $Import->save();

        return response()
            ->json([
                'import' => $seve,
                'succeed' => true
            ]);
    }
    public function export_Ingredients (Request $request) {
        $this->validate($request, [
            'rc_no' => 'required',
            'UID' => 'required',
            'itemname' => 'required',
            'export_at' => 'required',
            'qty' => 'required',
            'qty_charge' => 'required',
            'LOT_no' => 'required',
            'code_product' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
        ]);
        
        Item_ingredients::where('id',$request->itemname)
                ->update(['qty' => $request->qty]);

        $export = new Export_ingredients_items();
        $export->UID = $request->UID;
        $export->rc_no = $request->rc_no;
        $export->idrm = $request->itemname;
        $export->export_at = $request->export_at;
        $export->invoice_no = $request->invoice_no;
        $export->qty_balance = $request->qty;
        $export->qty_charge = $request->qty_charge;
        $export->LOT_no = $request->LOT_no;
        $export->code_product = $request->code_product;
        $export->status = 'นำออก';
        $export->description = $request->description;
        $export->PID = $request->PID;
        $seve = $export->save();

        return response()
            ->json([
                'import' => $seve,
                'succeed' => true
            ]);
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'rc_no' => 'required',
            'UID' => 'required',
            'itemname' => 'required',
            'EXP' => 'required',
            'import_at' => 'required',
            'MFG' => 'required',
            'qty' => 'required',
            'LOT_no' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
            'CID' => 'integer',
            'storageID' => 'integer',
        ]);
        $ingredients = new Item_ingredients();
        $ingredients->itemname = $request->itemname;
        $ingredients->CID = $request->CID;
        $ingredients->qty = $request->qty;
        $ingredients->description = $request->description;
        $ingredients->save();

        $Import = new Import_ingredients_items();
        $Import->UID = $request->UID;
        $Import->rc_no = $request->rc_no;
        $Import->idrm = $ingredients->id;
        $Import->EXP = $request->EXP;
        $Import->import_at = $request->import_at;
        $Import->MFG = $request->MFG;
        $Import->invoice_no = $request->invoice_no;
        $Import->qty_balance = $request->qty;
        $Import->qty_charge = $request->qty;
        $Import->LOT_no = $request->LOT_no;
        $Import->status = 'นำเข้า';
        $Import->description = $request->description;
        $Import->PID = $request->PID;
        $Import->storageID = $request->storageID;
        $seve = $Import->save();


        return response()
            ->json([
                'import' => $seve,
                'succeed' => true
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
