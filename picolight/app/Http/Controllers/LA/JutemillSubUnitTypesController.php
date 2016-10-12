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

use App\JutemillSubUnitType;

class JutemillSubUnitTypesController extends Controller
{
    public $show_action = true;
    public $view_col = 'sub_unit_type_title';
    public $listing_cols = ['id', 'unit_type_id', 'sub_unit_type_title', 'unit', 'sub_unit', 'item_discription', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JutemillSubUnitTypes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JutemillSubUnitTypes');
        
        return View('la.jutemillsubunittypes.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jutemillsubunittype.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutemillsubunittype in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JutemillSubUnitTypes", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JutemillSubUnitTypes", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillsubunittypes.index');
    }

    /**
     * Display the specified jutemillsubunittype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutemillsubunittype = JutemillSubUnitType::find($id);
        $module = Module::get('JutemillSubUnitTypes');
        $module->row = $jutemillsubunittype;
        return view('la.jutemillsubunittypes.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutemillsubunittype', $jutemillsubunittype);
    }

    /**
     * Show the form for editing the specified jutemillsubunittype.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutemillsubunittype = JutemillSubUnitType::find($id);
        
        $module = Module::get('JutemillSubUnitTypes');
        
        $module->row = $jutemillsubunittype;
        
        return view('la.jutemillsubunittypes.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutemillsubunittype', $jutemillsubunittype);
    }

    /**
     * Update the specified jutemillsubunittype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JutemillSubUnitTypes", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JutemillSubUnitTypes", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillsubunittypes.index');
    }

    /**
     * Remove the specified jutemillsubunittype from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JutemillSubUnitType::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillsubunittypes.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutemillsubunittypes')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillsubunittypes/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillsubunittypes/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutemillsubunittypes.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
