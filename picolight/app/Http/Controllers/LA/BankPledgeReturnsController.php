<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use DB;
use Validator;
use Datatables;
use Collective\Html\FormFacade as Form;
use Dwij\Laraadmin\Models\Module;

use App\BankPledgeReturn;
use App\Jutemillinventory;
use App\BankPledge;

class BankPledgeReturnsController extends Controller
{
    public $show_action = true;
    public $view_col = 'bankpledge_return_no';
    public $listing_cols = ['id', 'bankpledge_return_no', 'item_id', 'item_categorie_id', 'date_pledge_return', 'jute_receive_id', 'jute_receive', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'stock_in_bankPledge', 'pledge_status', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the BankPledgeReturns.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('BankPledgeReturns');
        
        return View('la.bankpledgereturns.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
        ]);
    }

    /**
     * Show the form for creating a new bankpledgereturn.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created bankpledgereturn in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("BankPledgeReturns", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        // $insert_id = Module::insert("BankPledgeReturns", $request);
        $obj = new BankPledgeReturn();
            $receive_no_last = BankPledgeReturn::all() -> last();
        ///  code
                if ($receive_no_last != null) {
                        $receiveNoUnique =$receive_no_last->bankpledge_return_no+1;
                        // $receiveNoUnique =$receive_no_last->id+1;
                        if (strlen($receiveNoUnique) == 3) {
                        $receiveNoUnique = "0" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 2) {
                            $receiveNoUnique = "00" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 1) {
                            $receiveNoUnique = "000" . $receiveNoUnique;
                        }
                    $obj->bankpledge_return_no = $receiveNoUnique;
                    
                    }
                    else{
                    $obj->bankpledge_return_no= "000". 1;
                    
                    }
    //Code 
        $objCode = new Jutemillinventory();
            $code = Jutemillinventory::all() -> last();
        ///  code
                if ($code != null) {
                        $receiveNoUniquecode =$code->code+1;
                        // $receiveNoUniquecode =$receive_no_last->id+1;
                        if (strlen($receiveNoUniquecode) == 3) {
                        $receiveNoUniquecode = "0" . $receiveNoUniquecode;
                        } elseif (strlen($receiveNoUniquecode) == 2) {
                            $receiveNoUniquecode = "00" . $receiveNoUniquecode;
                        } elseif (strlen($receiveNoUniquecode) == 1) {
                            $receiveNoUniquecode = "000" . $receiveNoUniquecode;
                        }
                    $objCode->code = $receiveNoUniquecode;
                    
                    }
                    else{
                    $objCode->code= "000". 1;
                    
                    }

        for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {
                if (isset($request->item_id[$detial_index])) {
                     $bankPledge_obj = new BankPledgeReturn();

                $bankPledge_obj->bankpledge_return_no= $obj->bankpledge_return_no;
                $bankPledge_obj->item_id= $request->item_id[$detial_index];
                $bankPledge_obj->item_categorie_id= $request->item_categorie_id[$detial_index];
                $bankPledge_obj->date_pledge_return= $request->item_categorie_id[$detial_index];
                $bankPledge_obj->jute_receive_id= $request->jute_receive_id[$detial_index];
                $bankPledge_obj->unit_type= $request->unit_type[$detial_index];
                $bankPledge_obj->sub_unit_type= $request->sub_unit_type[$detial_index];
                $bankPledge_obj->quantity= $request->quantity[$detial_index];
                $bankPledge_obj->sub_unit_quantity= $request->sub_unit_quantity[$detial_index];
                $bankPledge_obj->total_quantity= $request->totalsub_unit_quantity;
                $bankPledge_obj->pledge_status = 'Returned';
                $bankPledge_obj->user_id= Auth::user()->id;
                // $bankPledge_obj->stock_in_hand= $request->stock_in_hand[$detial_index];  
 
                $bankPledge_obj->save();


                $jutemillInventory_obj = new Jutemillinventory();

                $jutemillInventory_obj->code= $objCode->code;
                $jutemillInventory_obj->item_id= $request->item_id[$detial_index];
                $jutemillInventory_obj->item_categorie_id= $request->item_categorie_id[$detial_index];

                $jutemillInventory_obj->unit_type= $request->unit_type[$detial_index];
                $jutemillInventory_obj->sub_unit_type= $request->sub_unit_type[$detial_index];
                $jutemillInventory_obj->quantity= $request->quantity[$detial_index];
                $jutemillInventory_obj->sub_unit_quantity= $request->sub_unit_quantity[$detial_index];
                $jutemillInventory_obj->total_quantity= $request->totalsub_unit_quantity;
                $jutemillInventory_obj->stock_in_store= $request->totalsub_unit_quantity;
                $jutemillInventory_obj->stock_from = 'Bank Pledge Returned';
                $jutemillInventory_obj->isInStock = 1;
                $jutemillInventory_obj->user_id= Auth::user()->id;
 
                $jutemillInventory_obj->save();
                 
                // $id = $bankPledge_obj->id[$detial_index];
                $jutereceiveUpdate = BankPledge::find($request->id[$detial_index]);
                $jutereceiveUpdate->pledge_status = 'Returned';
                $jutereceiveUpdate->returned_date = $request->date_pledge_return;
                $jutereceiveUpdate->save();

                }

            // id ,code ,date ,item_id ,item_categorie_id ,unit_type ,sub_unit_type ,quantity ,sub_unit_quantity ,total_quantity ,stock_in_store ,stock_from ,isInStock ,user_id
        }
        
        return redirect()->route(config('laraadmin.adminRoute') . '.bankpledgereturns.index');
    }

    /**
     * Display the specified bankpledgereturn.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bankpledgereturn = BankPledgeReturn::find($id);
        $module = Module::get('BankPledgeReturns');
        $module->row = $bankpledgereturn;
        return view('la.bankpledgereturns.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('bankpledgereturn', $bankpledgereturn);
    }

    /**
     * Show the form for editing the specified bankpledgereturn.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankpledgereturn = BankPledgeReturn::find($id);
        
        $module = Module::get('BankPledgeReturns');
        
        $module->row = $bankpledgereturn;
        
        return view('la.bankpledgereturns.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('bankpledgereturn', $bankpledgereturn);
    }

    /**
     * Update the specified bankpledgereturn in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("BankPledgeReturns", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("BankPledgeReturns", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.bankpledgereturns.index');
    }

    /**
     * Remove the specified bankpledgereturn from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankPledgeReturn::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.bankpledgereturns.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('bankpledgereturns')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/bankpledgereturns/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/bankpledgereturns/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.bankpledgereturns.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
