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

use App\JMSpiningProduction;
use App\JMProduceItemCategory;
use App\JMProductionItem;
use App\JMProductionShift;

class JMSpiningProductionsController extends Controller
{
    public $show_action = true;
    public $view_col = 'category';
    public $listing_cols = ['id', 'serial', 'date', 'item', 'category', 'shift', 'rpm', 'tpi', 'frame', 'calc_max_production', 'terget_parcent', 'achivet_parcent', 'unit_type', 'production_quantity', 'total_production_quantity', 'total_achivet_parcent', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMSpiningProductions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMSpiningProductions');
        // $JMProduceItemCategory = JMProduceItemCategory::get('JMSpiningProductions');
        $id = JMProductionItem::where('production_item', 'Spining')->first();
        $productionChatagorys = JMProduceItemCategory::where('produ_Item', $id->id)->get();
        $shift = JMProductionShift::All();
        
        return View('la.jmspiningproductions.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
            'productionChatagorys' => $productionChatagorys,
            'shift' => $shift
        ]);
    }

    /**
     * Show the form for creating a new jmspiningproduction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmspiningproduction in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMSpiningProductions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMSpiningProductions", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmspiningproductions.index');
    }

    /**
     * Display the specified jmspiningproduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmspiningproduction = JMSpiningProduction::find($id);
        $module = Module::get('JMSpiningProductions');
        $module->row = $jmspiningproduction;
        return view('la.jmspiningproductions.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmspiningproduction', $jmspiningproduction);
    }

    /**
     * Show the form for editing the specified jmspiningproduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmspiningproduction = JMSpiningProduction::find($id);
        
        $module = Module::get('JMSpiningProductions');
        
        $module->row = $jmspiningproduction;
        
        return view('la.jmspiningproductions.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmspiningproduction', $jmspiningproduction);
    }

    /**
     * Update the specified jmspiningproduction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMSpiningProductions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMSpiningProductions", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmspiningproductions.index');
    }

    /**
     * Remove the specified jmspiningproduction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMSpiningProduction::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmspiningproductions.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmspiningproductions')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmspiningproductions/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmspiningproductions/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmspiningproductions.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
