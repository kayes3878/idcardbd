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

use App\JuteCutting;

class JuteCuttingsController extends Controller
{
    public $show_action = true;
    public $view_col = 'cutting_serial';
    public $listing_cols = ['id', 'cutting_serial', 'item_id', 'item_categorie_id', 'proguction_line_id', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'total_sub_unit_quantity', 'total_cut_sub_unit', 'total_pacca_sub_unit', 'total_westage_sub_unit', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JuteCuttings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JuteCuttings');
        
        return View('la.jutecuttings.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jutecutting.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutecutting in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JuteCuttings", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JuteCuttings", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutecuttings.index');
    }

    /**
     * Display the specified jutecutting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutecutting = JuteCutting::find($id);
        $module = Module::get('JuteCuttings');
        $module->row = $jutecutting;
        return view('la.jutecuttings.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutecutting', $jutecutting);
    }

    /**
     * Show the form for editing the specified jutecutting.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutecutting = JuteCutting::find($id);
        
        $module = Module::get('JuteCuttings');
        
        $module->row = $jutecutting;
        
        return view('la.jutecuttings.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutecutting', $jutecutting);
    }

    /**
     * Update the specified jutecutting in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JuteCuttings", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JuteCuttings", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutecuttings.index');
    }

    /**
     * Remove the specified jutecutting from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JuteCutting::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutecuttings.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutecuttings')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutecuttings/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutecuttings/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutecuttings.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
