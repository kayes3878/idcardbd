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
use App\JuteReceife;
use PDF;
use Dompdf\Dompdf;
use App\BankPledge;
use App\bankpledgereport;

class BankPledgesController extends Controller
{
    public $show_action = true;
    public $view_col = 'bankpledge_no';
    public $listing_cols = ['id', 'bankpledge_no', 'date_pledge', 'item_id', 'item_categorie_id', 'jute_receive_id', 'jute_receive', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'pledge_status', 'returned_date', 'user_id', 'stock_in_hand'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the BankPledges.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('BankPledges');
        // $jutereceives = JuteReceife::all();
        $jutereceives= JuteReceife::where('is_bank_paedge' , 'Not pledged')->get();
        
        return View('la.bankpledges.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
            'jutereceives' => $jutereceives,
        ]);

         
    }

    /**
     * Show the form for creating a new bankpledge.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created bankpledge in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("BankPledges", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        // $insert_id = Module::insert("BankPledges", $request);

        $obj = new BankPledge();
            $receive_no_last = BankPledge::all() -> last();
        ///  code
                if ($receive_no_last != null) {
                        $receiveNoUnique =$receive_no_last->bankpledge_no+1;
                        // $receiveNoUnique =$receive_no_last->id+1;
                        if (strlen($receiveNoUnique) == 3) {
                        $receiveNoUnique = "0" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 2) {
                            $receiveNoUnique = "00" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 1) {
                            $receiveNoUnique = "000" . $receiveNoUnique;
                        }
                    $obj->bankpledge_no = $receiveNoUnique;
                    
                    }
                    else{
                    $obj->bankpledge_no= "000". 1;
                    
                    }

        for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {
                 if (isset($request->item_id[$detial_index])) {
                     $bankPledge_obj = new BankPledge();
                     if (isset($request->checkbox[$detial_index]) == 'yes') {
                        $bankPledge_obj->bankpledge_no= $obj->bankpledge_no;
                        $bankPledge_obj->date_pledge= $request->date_pledge;
                        $bankPledge_obj->item_id= $request->item_id[$detial_index];
                        $bankPledge_obj->item_categorie_id= $request->item_categorie_id[$detial_index];
                        $bankPledge_obj->jute_receive_id= $request->jute_receive_id[$detial_index];
                        $bankPledge_obj->unit_type= $request->unit_type[$detial_index];
                        $bankPledge_obj->sub_unit_type= $request->sub_unit_type[$detial_index];
                        $bankPledge_obj->quantity= $request->quantity[$detial_index];
                        $bankPledge_obj->sub_unit_quantity= $request->sub_unit_quantity[$detial_index];
                        $bankPledge_obj->total_quantity= $request->totalsub_unit_quantity;
                        // $bankPledge_obj->pledge_status= 'Pledged';
                        $bankPledge_obj->user_id= Auth::user()->id;
                        $bankPledge_obj->stock_in_hand= $request->stock_in_hand[$detial_index];  
         
                        $bankPledge_obj->save();


                        $jutereceiveUpdate = JuteReceife::find($bankPledge_obj->jute_receive_id);
                        $jutereceiveUpdate->is_bank_paedge = 'pledged';
                        $jutereceiveUpdate->save();
                     }
               
                 }
                

        $dompdf = new DOMPDF();
        $bankpledges= BankPledge::where('bankpledge_no' , $bankPledge_obj->bankpledge_no)->get();

        $pdf = PDF::loadView('pdf.bankpledgereport',['bankpledges'=>$bankpledges]);
        return $pdf ->stream('bankpledgereport.pdf', array("Attachment" =>0));


        }
        
        }

    /**
     * Display the specified bankpledge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bankpledge = BankPledge::find($id);
        $module = Module::get('BankPledges');
        $module->row = $bankpledge;
        return view('la.bankpledges.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('bankpledge', $bankpledge);
    }

    /**
     * Show the form for editing the specified bankpledge.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bankpledge = BankPledge::find($id);
        
        $module = Module::get('BankPledges');
        
        $module->row = $bankpledge;
        
        return view('la.bankpledges.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('bankpledge', $bankpledge);
    }

    /**
     * Update the specified bankpledge in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("BankPledges", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("BankPledges", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.bankpledges.index');
    }

    /**
     * Remove the specified bankpledge from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        BankPledge::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.bankpledges.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('bankpledges')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/bankpledges/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/bankpledges/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.bankpledges.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

    public function bankpedge_items($subitem_itemid)
    {

        $pledge_items = BankPledge::where([
                    ['item_categorie_id', $subitem_itemid],
                    ['pledge_status', 'Instore']
                ])->get(); 
      
        return response()->json($pledge_items);
    }
}
