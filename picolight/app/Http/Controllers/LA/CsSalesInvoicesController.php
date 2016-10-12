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

use App\CsSalesInvoice;

class CsSalesInvoicesController extends Controller
{
    public $show_action = true;
    public $view_col = 'sales_invoice_no';
    public $listing_cols = ['id', 'sales_invoice_no', 'date', 'party', 'store', 'sr_no', 'item', 'category', 'unit', 'quantity', 'sub_quantity', 'total_quantity', 'Actual_price', 'selling_price', 'total_selling_price', 'grans_total_price', 'payment_status', 'due_amount', 'detail', 'user_id', 'do_no'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the CsSalesInvoices.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('CsSalesInvoices');
        
        return View('la.cssalesinvoices.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new cssalesinvoice.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created cssalesinvoice in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("CsSalesInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("CsSalesInvoices", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cssalesinvoices.index');
    }

    /**
     * Display the specified cssalesinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cssalesinvoice = CsSalesInvoice::find($id);
        $module = Module::get('CsSalesInvoices');
        $module->row = $cssalesinvoice;
        return view('la.cssalesinvoices.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('cssalesinvoice', $cssalesinvoice);
    }

    /**
     * Show the form for editing the specified cssalesinvoice.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cssalesinvoice = CsSalesInvoice::find($id);
        
        $module = Module::get('CsSalesInvoices');
        
        $module->row = $cssalesinvoice;
        
        return view('la.cssalesinvoices.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('cssalesinvoice', $cssalesinvoice);
    }

    /**
     * Update the specified cssalesinvoice in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("CsSalesInvoices", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("CsSalesInvoices", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cssalesinvoices.index');
    }

    /**
     * Remove the specified cssalesinvoice from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CsSalesInvoice::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.cssalesinvoices.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('cssalesinvoices')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/cssalesinvoices/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/cssalesinvoices/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.cssalesinvoices.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
