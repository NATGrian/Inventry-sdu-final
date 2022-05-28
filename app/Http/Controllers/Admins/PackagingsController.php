<?php

namespace App\Http\Controllers\Admins;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DateTime;
use App\User;

use App\Models\Storages;
use App\Models\Relevants;

use App\Models\Item_packaging;
use App\Models\Import_packagings_items;
use App\Models\Export_packagings_items;
use App\Models\Categorys_packagings;
use DB;

class PackagingsController extends Controller
{
    public function getcategory()
    {
        $category = Categorys_packagings::all();

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
        $categorys = new Categorys_packagings($request->all());
        $categorys->save();

        return response()
            ->json([
                'succeed' => true,
                

            ]);
    }
    public function getimport($id)
    {
        $Item = Item_packaging::findOrFail($id);

        return response()
            ->json([
                'itemimport' => $Item
            ]);
    }
    public function getsearch($id)
    {
        $Item = DB::table('import_packagings_items')
            ->join('item_packagings', 'import_packagings_items.idpack', '=', 'item_packagings.id')
            ->select('import_packagings_items.*', 'item_packagings.itemname', 'item_packagings.qty')
            ->where('import_packagings_items.id', $id)->first();

        return response()
            ->json([
                'itemexport' => $Item
            ]);
    }
    public function getsearchLabelling($id)
    {
        $Item = DB::table('export_packagings_items')
            ->join('item_packagings', 'export_packagings_items.idpack', '=', 'item_packagings.id')
            ->select('export_packagings_items.*', 'item_packagings.itemname', 'item_packagings.qty')
            ->where('export_packagings_items.id', $id)->first();

        return response()
            ->json([
                'labelling' => $Item
            ]);
    }
    public function getLabelling()
    {
        $Item = DB::table('export_packagings_items')
        ->join('users', 'export_packagings_items.UID', '=', 'users.id')
        ->join('item_packagings', 'export_packagings_items.idpack', '=', 'item_packagings.id')
        ->join('relevants', 'export_packagings_items.PID', '=', 'relevants.id')
        ->select('export_packagings_items.*', 'users.firstname as ufname', 'item_packagings.itemname', 'Relevants.firstname as pfname')
        ->orderBy('export_packagings_items.export_at', 'desc') ->get();

        return response()
            ->json([
                'labelling' => $Item
            ]);
    }
    public function getpackagings() {
        $list = DB::table('item_packagings')
            ->join('categorys_packagings', 'item_packagings.CID', '=', 'categorys_packagings.id')
            ->select('item_packagings.*', 'categorys_packagings.name')->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()
            ->json([
                'list' => $list
            ]);
    }
    public function getexport()
    {
        $record = DB::table('import_packagings_items')
        ->join('users', 'import_packagings_items.UID', '=', 'users.id')
        ->join('item_packagings', 'import_packagings_items.idpack', '=', 'item_packagings.id')
        ->join('relevants', 'import_packagings_items.PID', '=', 'relevants.id')
        ->join('storages', 'import_packagings_items.storageID', '=', 'storages.id')
        ->select('import_packagings_items.*', 'users.firstname as ufname', 'item_packagings.itemname', 'relevants.firstname as pfname', 'storages.name')
        ->orderBy('import_packagings_items.import_at', 'desc') ->get();

        return response()
            ->json([
                'record' => $record
            ]);
    }
    public function getrecord(Request $request)
    {
        $record = DB::table('import_packagings_items')
            ->join('users', 'import_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'import_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'import_packagings_items.PID', '=', 'relevants.id')
            ->join('storages', 'import_packagings_items.storageID', '=', 'storages.id')
            ->select('import_packagings_items.*', 'users.firstname as ufname', 'item_packagings.itemname', 'relevants.firstname as pfname', 'storages.name')
            ->orderBy('import_packagings_items.import_at', 'desc') ->paginate(10);

        $record1 = DB::table('export_packagings_items')
            ->join('users', 'export_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'export_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'export_packagings_items.PID', '=', 'relevants.id')
            ->select('export_packagings_items.*', 'users.firstname as ufname', 'item_packagings.itemname', 'relevants.firstname as pfname')
            ->orderBy('export_packagings_items.export_at', 'desc') ->paginate(10);

        return response()
            ->json([
                'record' => $record,
                'record1' => $record1
            ]);
    }

    public function import_Packagings(Request $request)
    {
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

        Item_packaging::where('id', $request->itemname)
            ->update(['qty' => $request->qty]);

        $Import = new Import_packagings_items();
        $Import->UID = $request->UID;
        $Import->rc_no = $request->rc_no;
        $Import->idpack = $request->itemname;
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
        $Import->save();

        return response()
            ->json([
                // 'import' => $seve,
                'succeed' => true
            ]);
    }
    public function export_Packagings(Request $request)
    {
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

        Item_packaging::where('id', $request->itemname)
            ->update(['qty' => $request->qty]);

        $export = new Export_packagings_items();
        $export->UID = $request->UID;
        $export->rc_no = $request->rc_no;
        $export->idpack = $request->itemname;
        $export->export_at = $request->export_at;
        $export->invoice_no = $request->invoice_no;
        $export->qty_balance = $request->qty;
        $export->qty_charge = $request->qty_charge;
        $export->LOT_no = $request->LOT_no;
        $export->code_product = $request->code_product;
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
        $list = DB::table('item_packagings')
            ->join('categorys_packagings', 'item_packagings.CID', '=', 'categorys_packagings.id')
            ->select('item_packagings.*', 'categorys_packagings.name')->orderBy('created_at', 'desc')
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
        $packagings = new Item_packaging();
        $packagings->itemname = $request->itemname;
        $packagings->CID = $request->CID;
        $packagings->qty = $request->qty;
        $packagings->description = $request->description;
        $packagings->save();

        $Import = new Import_packagings_items();
        $Import->UID = $request->UID;
        $Import->rc_no = $request->rc_no;
        $Import->idpack = $packagings->id;
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
        $Import->save();


        return response()
            ->json([
                // 'import' => $seve,
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
        Item_packaging::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function categorydestroy($id)
    {
        Categorys_packagings::where('id', $id)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function importdestroy(Request $request)
    {
        $del = Item_packaging::where('id', $request->idpack)->first();
        $change_qty = $del->qty - $request->deqty_charge;
        Item_packaging::where('id', $request->idpack)
            ->update(['qty' => $change_qty]);

        Import_packagings_items::where('id', $request->deletingID)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function exportdestroy(Request $request)
    {
        $del = Item_packaging::where('id', $request->idpack)->first();
        $change_qty = $del->qty + $request->deqty_charge;
        Item_packaging::where('id', $request->idpack)
            ->update(['qty' => $change_qty]);
        Export_packagings_items::where('id', $request->deletingID)->delete();
        return response()
            ->json([
                'DELETE' => true
            ]);
    }

    public function reportsPackagings(Request $request)
    {

        $record = DB::table('import_packagings_items')
            ->join('users', 'import_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'import_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'import_packagings_items.PID', '=', 'relevants.id')
            ->select(
                'users.firstname as ufname',
                'relevants.firstname as pfname',
                'item_packagings.itemname',
                'import_packagings_items.qty_charge as im_qty_charge',
                'import_packagings_items.qty_balance',
                'import_packagings_items.rc_no',
                'import_packagings_items.LOT_no',
                'import_packagings_items.import_at as imex_at',
                'import_packagings_items.MFG',
                'import_packagings_items.EXP',
                'import_packagings_items.invoice_no',
                'import_packagings_items.created_at'
            )
            ->where('item_packagings.itemname', $request->name_pack)
            ->orderBy('import_packagings_items.import_at', 'desc')
            ->get();

        $record1 = DB::table('export_packagings_items')
            ->join('users', 'export_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'export_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'export_packagings_items.PID', '=', 'relevants.id')
            ->select(
                'users.firstname as ufname',
                'relevants.firstname as pfname',
                'item_packagings.itemname',
                'export_packagings_items.qty_charge as ex_qty_charge',
                'export_packagings_items.qty_balance',
                'export_packagings_items.rc_no',
                'export_packagings_items.LOT_no',
                'export_packagings_items.export_at as imex_at',
                'export_packagings_items.invoice_no',
                'export_packagings_items.code_product',
                'export_packagings_items.created_at'
            )
            ->where('item_packagings.itemname', $request->name_pack)
            ->orderBy('export_packagings_items.export_at', 'desc')
            ->get();
        $mergeTbl = $record->merge($record1)->sortByDesc('imex_at')->paginate(15);


        return response()
            ->json([
                'reportdata' => $mergeTbl,
                'succeed' => true
            ]);
    }
    public function getreportsPackagings()
    {

        $record = DB::table('import_packagings_items')
            ->join('users', 'import_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'import_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'import_packagings_items.PID', '=', 'relevants.id')
            ->select(
                'users.firstname as ufname',
                'relevants.firstname as pfname',
                'item_packagings.itemname',
                'import_packagings_items.qty_charge as im_qty_charge',
                'import_packagings_items.qty_balance',
                'import_packagings_items.rc_no',
                'import_packagings_items.LOT_no',
                'import_packagings_items.import_at as imex_at',
                'import_packagings_items.MFG',
                'import_packagings_items.EXP',
                'import_packagings_items.invoice_no',
                'import_packagings_items.created_at'
            )
            ->orderBy('import_packagings_items.import_at', 'desc')
            ->get();

        $record1 = DB::table('export_packagings_items')
            ->join('users', 'export_packagings_items.UID', '=', 'users.id')
            ->join('item_packagings', 'export_packagings_items.idpack', '=', 'item_packagings.id')
            ->join('relevants', 'export_packagings_items.PID', '=', 'relevants.id')
            ->select(
                'users.firstname as ufname',
                'relevants.firstname as pfname',
                'item_packagings.itemname',
                'export_packagings_items.qty_charge as ex_qty_charge',
                'export_packagings_items.qty_balance',
                'export_packagings_items.rc_no',
                'export_packagings_items.LOT_no',
                'export_packagings_items.export_at as imex_at',
                'export_packagings_items.invoice_no',
                'export_packagings_items.code_product',
                'export_packagings_items.created_at'
            )
            ->orderBy('export_packagings_items.export_at', 'desc')
            ->get();
        $mergeTbl = $record->merge($record1)->sortByDesc('imex_at')->paginate(15);


        return response()
            ->json([
                'reportdata' => $mergeTbl,
                'succeed' => true
            ]);
    }
}
