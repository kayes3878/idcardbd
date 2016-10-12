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

use App\Acc_ledger_type;

class Acc_ledger_typesController extends Controller
{
    public $show_action = true;
    public $view_col = 'ledger_type_id';
    public $listing_cols = ['id', 'ledger_type_id', 'ledger_type'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Acc_ledger_types.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Acc_ledger_types');
        
        return View('la.acc_ledger_types.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new acc_ledger_type.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acc_ledger_type in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("Acc_ledger_types", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("Acc_ledger_types", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledger_types.index');
    }

    /**
     * Display the specified acc_ledger_type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acc_ledger_type = Acc_ledger_type::find($id);
        $module = Module::get('Acc_ledger_types');
        $module->row = $acc_ledger_type;
        return view('la.acc_ledger_types.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acc_ledger_type', $acc_ledger_type);
    }

    /**
     * Show the form for editing the specified acc_ledger_type.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_ledger_type = Acc_ledger_type::find($id);
        
        $module = Module::get('Acc_ledger_types');
        
        $module->row = $acc_ledger_type;
        
        return view('la.acc_ledger_types.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acc_ledger_type', $acc_ledger_type);
    }

    /**
     * Update the specified acc_ledger_type in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Acc_ledger_types", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Acc_ledger_types", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledger_types.index');
    }

    /**
     * Remove the specified acc_ledger_type from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acc_ledger_type::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledger_types.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acc_ledger_types')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_ledger_types/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_ledger_types/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acc_ledger_types.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
