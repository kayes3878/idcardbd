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

use App\JMPurchaseInvoice;

class JMPurchaseInvoicesController extends Controller
{
    public $show_action = true;
    public $view_col = 'invoice_type';
    public $listing_cols = ['id', 'invoice_type', 'date', 'invoice_no', 'supplier_id', 'supplier_bill_id', 'jute_receive_bill', 'item_id', 'item_categorie_id', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'grand_total', 'bill_status', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMPurchaseInvoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMPurchaseInvoices');
        
        return View('la.jmpurchaseinvoices.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmpurchaseinvoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmpurchaseinvoice in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMPurchaseInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMPurchaseInvoices", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmpurchaseinvoices.index');
    }

    /**
     * Display the specified jmpurchaseinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmpurchaseinvoice = JMPurchaseInvoice::find($id);
        $module = Module::get('JMPurchaseInvoices');
        $module->row = $jmpurchaseinvoice;
        return view('la.jmpurchaseinvoices.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmpurchaseinvoice', $jmpurchaseinvoice);
    }

    /**
     * Show the form for editing the specified jmpurchaseinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmpurchaseinvoice = JMPurchaseInvoice::find($id);
        
        $module = Module::get('JMPurchaseInvoices');
        
        $module->row = $jmpurchaseinvoice;
        
        return view('la.jmpurchaseinvoices.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmpurchaseinvoice', $jmpurchaseinvoice);
    }

    /**
     * Update the specified jmpurchaseinvoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMPurchaseInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMPurchaseInvoices", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmpurchaseinvoices.index');
    }

    /**
     * Remove the specified jmpurchaseinvoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMPurchaseInvoice::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmpurchaseinvoices.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmpurchaseinvoices')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmpurchaseinvoices/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmpurchaseinvoices/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmpurchaseinvoices.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
