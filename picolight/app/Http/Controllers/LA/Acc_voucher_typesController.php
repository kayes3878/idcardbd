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

use App\Acc_voucher_type;

class Acc_voucher_typesController extends Controller
{
    public $show_action = true;
    public $view_col = 'voucher_type_id';
    public $listing_cols = ['id', 'voucher_type_id', 'voucher_type'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Acc_voucher_types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Acc_voucher_types');
        
        return View('la.acc_voucher_types.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new acc_voucher_type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acc_voucher_type in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("Acc_voucher_types", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("Acc_voucher_types", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_voucher_types.index');
    }

    /**
     * Display the specified acc_voucher_type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acc_voucher_type = Acc_voucher_type::find($id);
        $module = Module::get('Acc_voucher_types');
        $module->row = $acc_voucher_type;
        return view('la.acc_voucher_types.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acc_voucher_type', $acc_voucher_type);
    }

    /**
     * Show the form for editing the specified acc_voucher_type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_voucher_type = Acc_voucher_type::find($id);
        
        $module = Module::get('Acc_voucher_types');
        
        $module->row = $acc_voucher_type;
        
        return view('la.acc_voucher_types.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acc_voucher_type', $acc_voucher_type);
    }

    /**
     * Update the specified acc_voucher_type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Acc_voucher_types", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Acc_voucher_types", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_voucher_types.index');
    }

    /**
     * Remove the specified acc_voucher_type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acc_voucher_type::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_voucher_types.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acc_voucher_types')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_voucher_types/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_voucher_types/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acc_voucher_types.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
