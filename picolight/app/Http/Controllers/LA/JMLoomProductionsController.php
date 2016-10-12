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

use App\JMLoomProduction;
use App\JMProductionItem;

class JMLoomProductionsController extends Controller
{
    public $show_action = true;
    public $view_col = 'category';
    public $listing_cols = ['id', 'serial', 'date', 'item', 'category', 'calc_max_production', 'terget_parcent', 'achivet_parcent_Piece', 'achivet_parcent', 'terget_q_piece', 'terget_q', 'unit_type', 'sun_unit_type', 'production_quantity_Piece', 'production_quantity', 'total_production_quantity_Piec', 'total_production_quantity', 'total_achivet_parcent_piece', 'total_achivet_parcent', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMLoomProductions.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMLoomProductions');
        $productionItem = JMProductionItem::where('production_item' ,'!=', 'Spining')->get();
        
        return View('la.jmloomproductions.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
            'productionItem' => $productionItem
        ]);
    }

    /**
     * Show the form for creating a new jmloomproduction.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmloomproduction in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMLoomProductions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMLoomProductions", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmloomproductions.index');
    }

    /**
     * Display the specified jmloomproduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmloomproduction = JMLoomProduction::find($id);
        $module = Module::get('JMLoomProductions');
        $module->row = $jmloomproduction;
        return view('la.jmloomproductions.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmloomproduction', $jmloomproduction);
    }

    /**
     * Show the form for editing the specified jmloomproduction.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmloomproduction = JMLoomProduction::find($id);
        
        $module = Module::get('JMLoomProductions');
        
        $module->row = $jmloomproduction;
        
        return view('la.jmloomproductions.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmloomproduction', $jmloomproduction);
    }

    /**
     * Update the specified jmloomproduction in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMLoomProductions", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMLoomProductions", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmloomproductions.index');
    }

    /**
     * Remove the specified jmloomproduction from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMLoomProduction::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmloomproductions.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmloomproductions')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmloomproductions/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmloomproductions/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmloomproductions.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
