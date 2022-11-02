<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DateTime;
use App\Models\Storages;
use App\Models\Relevants;
use App\Models\Item_products;
use App\Models\Categorys_products;
use App\Models\Export_product_items;
use App\Models\Import_product_items;
use DB;

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
    public function getrecord()
    {
        $recordproduct = DB::table('import_product_items')
            ->join('users', 'import_product_items.UID', '=', 'users.id')
            ->join('item_products', 'import_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'import_product_items.PID', '=', 'relevants.id')
            ->join('storages', 'import_product_items.storageID', '=', 'storages.id')
            ->select('import_product_items.*' , 'users.firstname as ufname', 'item_products.itemname', 'relevants.firstname as pfname', 'storages.name')
            ->orderBy('import_product_items.created_at', 'desc')
            ->paginate(10);

        $recordproduct1 = DB::table('export_product_items')
            ->join('users', 'export_product_items.UID', '=', 'users.id')
            ->join('item_products', 'export_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'export_product_items.PID', '=', 'relevants.id')
            ->select('export_product_items.*' , 'users.firstname as ufname', 'item_products.itemname', 'relevants.firstname as pfname')
            ->orderBy('export_product_items.created_at', 'desc')
            ->paginate(10);

        return response()
            ->json([
                'recordproduct' => $recordproduct,
                'recordproduct1' => $recordproduct1
            ]);
    }
    public function getproducts() {
        $list = DB::table('item_products')
            ->join('categorys_products', 'item_products.CID', '=', 'categorys_products.id')
            ->select('item_products.*', 'categorys_products.name')->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()
            ->json([
                'list' => $list
            ]);
    }
    public function getimport($id)
    {
        $Item = Item_products::findOrFail($id);

        return response()
            ->json([
                'itemimport' => $Item
            ]);
    }
    public function getexport()
    {
        $record = DB::table('import_product_items')
        ->join('users', 'import_product_items.UID', '=', 'users.id')
        ->join('item_products', 'import_product_items.idproduct', '=', 'item_products.id')
        ->join('relevants', 'import_product_items.PID', '=', 'relevants.id')
        ->join('storages', 'import_product_items.storageID', '=', 'storages.id')
        ->select('import_product_items.*', 'users.firstname as ufname', 'item_products.itemname', 'relevants.firstname as pfname', 'storages.name')
        ->orderBy('import_product_items.import_at', 'desc') ->get();

        return response()
            ->json([
                'recordproduct' => $record
            ]);
    }
    public function getsearch($id)
    {
        $Item = DB::table('import_product_items')
        ->join('item_products', 'import_product_items.idproduct', '=', 'item_products.id')
        ->select('import_product_items.*' , 'item_products.itemname', 'item_products.qty')
        ->where('import_product_items.id', $id)->first();

        return response()
            ->json([
                'itemexport' => $Item
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
                'succeed' => true
            ]);
    }

    public function import_product (Request $request) {
        $this->validate($request, [
            'Batch_no' => 'required',
            'UID' => 'required',
            'itemname' => 'required',
            'EXP' => 'required',
            'import_at' => 'required',
            'MFG' => 'required',
            'qty' => 'required',
            'qty_charge' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
            'storageID' => 'integer',
        ]);
        
        Item_products::where('id',$request->itemname)
                ->update(['qty' => $request->qty]);

        $Import = new Import_product_items();
        $Import->UID = $request->UID;
        $Import->Batch_no = $request->Batch_no;
        $Import->idproduct = $request->itemname;
        $Import->EXP = $request->EXP;
        $Import->import_at = $request->import_at;
        $Import->MFG = $request->MFG;
        $Import->qty_balance = $request->qty;
        $Import->qty_charge = $request->qty_charge;
        $Import->status = 'นำเข้า';
        $Import->description = $request->description;
        $Import->PID = $request->PID;
        $Import->storageID = $request->storageID;
       $Import->save();

        return response()
            ->json([
                // 'import' => $seve,
                'succeed' => true
            ]);
    }
    public function export_product (Request $request) {
        $this->validate($request, [
            'UID' => 'required',
            'itemname' => 'required',
            'export_at' => 'required',
            'qty' => 'required',
            'qty_charge' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
        ]);
        
        Item_products::where('id',$request->itemname)
                ->update(['qty' => $request->qty]);

        $export = new Export_product_items();
        $export->UID = $request->UID;
        $export->idproduct = $request->itemname;
        $export->export_at = $request->export_at;
        $export->order_no = $request->order_no;
        $export->qty_balance = $request->qty;
        $export->qty_charge = $request->qty_charge;
        $export->status = 'นำออก';
        $export->description = $request->description;
        $export->PID = $request->PID;
        $export->save();

        return response()
            ->json([
                // 'import' => $seve,
                'succeed' => true
            ]);
    }
    public function index()
    {
        $list = DB::table('item_products')
            ->join('categorys_products', 'item_products.CID', '=', 'categorys_products.id')
            ->select('item_products.*', 'categorys_products.name')->orderBy('created_at', 'desc')
            ->get();

        return response()
            ->json([
                'list' => $list
            ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'Batch_no' => 'required',
            'UID' => 'required',
            'itemname' => 'required',
            'EXP' => 'required',
            'import_at' => 'required',
            'MFG' => 'required',
            'qty' => 'required',
            'description' => 'required|max:255',
            'PID' => 'integer',
            'CID' => 'integer',
            'storageID' => 'integer',
        ]);
        $products = new Item_products();
        $products->itemname = $request->itemname;
        $products->CID = $request->CID;
        $products->qty = $request->qty;
        $products->description = $request->description;
        $products->save();

        $Import = new Import_product_items();
        $Import->UID = $request->UID;
        $Import->idproduct = $products->id;
        $Import->EXP = $request->EXP;
        $Import->import_at = $request->import_at;
        $Import->MFG = $request->MFG;
        $Import->qty_balance = $request->qty;
        $Import->qty_charge = $request->qty;
        $Import->Batch_no = $request->Batch_no;
        $Import->status = 'นำเข้า';
        $Import->description = $request->description;
        $Import->PID = $request->PID;
        $Import->storageID = $request->storageID;
        $Import->save();


        return response()
            ->json([

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
        Item_products::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }
    public function categorydestroy($id)
    {
        Categorys_products::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function importdestroy(Request $request)
    {
        $del = Item_products::where('id', $request->idproduct)->first();
        $change_qty = $del->qty - $request->deqty_charge;
        Item_products::where('id', $request->idproduct)
            ->update(['qty' => $change_qty]);
        Import_product_items::where('id', $request->idproduct)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function exportdestroy(Request $request)
    {
        $del = Item_products::where('id', $request->idproduct)->first();
        $change_qty = $del->qty + $request->deqty_charge;
        Item_products::where('id', $request->idproduct)
            ->update(['qty' => $change_qty]);
        Export_product_items::where('id', $request->idproduct)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function reportsproduct (Request $request) 
    {


        $record = DB::table('import_product_items')
            ->join('users', 'import_product_items.UID', '=', 'users.id')
            ->join('item_products', 'import_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'import_product_items.PID', '=', 'relevants.id')
            ->select(
                     'users.firstname as ufname', 
                     'relevants.firstname as pfname',
                     'item_products.itemname',
                     'import_product_items.qty_charge as im_qty_charge',
                     'import_product_items.qty_balance',
                     'import_product_items.Batch_no',
                     'import_product_items.import_at as imex_at',
                     'import_product_items.MFG',
                     'import_product_items.EXP',
                     'import_product_items.created_at'
            )
            ->where('item_products.itemname', $request->itemname)
            ->orderBy('import_product_items.import_at', 'desc')
            ->get();

        $record1 = DB::table('export_product_items')
            ->join('users', 'export_product_items.UID', '=', 'users.id')
            ->join('item_products', 'export_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'export_product_items.PID', '=', 'relevants.id')
            ->select(
                     'users.firstname as ufname', 
                     'relevants.firstname as pfname',
                     'item_products.itemname',
                     'export_product_items.qty_charge as ex_qty_charge',
                     'export_product_items.qty_balance',
                     'export_product_items.order_no',
                     'export_product_items.export_at as imex_at',
                     'export_product_items.created_at'
            )
            ->where('item_products.itemname', $request->itemname)
            ->orderBy('export_product_items.export_at', 'desc')
            ->get();
            $mergeTbl = $record->merge($record1)->sortByDesc('imex_at')->paginate(15);

        return response()
            ->json([
                'reportdata' => $mergeTbl,
                'succeed' => true
                // 'record1' => $record1
            ]);
        }
        public function getreportsproduct (Request $request) 
    {


        $record = DB::table('import_product_items')
            ->join('users', 'import_product_items.UID', '=', 'users.id')
            ->join('item_products', 'import_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'import_product_items.PID', '=', 'relevants.id')
            ->select(
                     'users.firstname as ufname', 
                     'relevants.firstname as pfname',
                     'item_products.itemname',
                     'import_product_items.qty_charge as im_qty_charge',
                     'import_product_items.qty_balance',
                     'import_product_items.Batch_no',
                     'import_product_items.import_at as imex_at',
                     'import_product_items.MFG',
                     'import_product_items.EXP',
                     'import_product_items.created_at'
            )
            ->orderBy('import_product_items.import_at', 'desc')
            ->get();

        $record1 = DB::table('export_product_items')
            ->join('users', 'export_product_items.UID', '=', 'users.id')
            ->join('item_products', 'export_product_items.idproduct', '=', 'item_products.id')
            ->join('relevants', 'export_product_items.PID', '=', 'relevants.id')
            ->select(
                     'users.firstname as ufname', 
                     'relevants.firstname as pfname',
                     'item_products.itemname',
                     'export_product_items.qty_charge as ex_qty_charge',
                     'export_product_items.qty_balance',
                     'export_product_items.order_no',
                     'export_product_items.export_at as imex_at',
                     'export_product_items.created_at'
            )
            ->orderBy('export_product_items.export_at', 'desc')
            ->get();
            $mergeTbl = $record->merge($record1)->sortByDesc('imex_at')->paginate(15);

        return response()
            ->json([
                'reportdata' => $mergeTbl,
                'succeed' => true
                // 'record1' => $record1
            ]);
        }
}
