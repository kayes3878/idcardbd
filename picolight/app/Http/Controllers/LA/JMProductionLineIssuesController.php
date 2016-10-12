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

use App\JMProductionLineIssue;

class JMProductionLineIssuesController extends Controller
{
    public $show_action = true;
    public $view_col = 'serial';
    public $listing_cols = ['id', 'serial', 'jute_process_type', 'proguction_line_id', 'unit_type', 'sub_unit_type', 'in_hand_q', 'total_quantity', 'total_sub_unit_quantity', 'pacca_q', 'total_pacca_q', 'kacha_q', 'total_Kacha_q', 'Cut_q', 'total_cut_q', 'Stock', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMProductionLineIssues.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMProductionLineIssues');
        
        return View('la.jmproductionlineissues.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmproductionlineissue.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmproductionlineissue in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMProductionLineIssues", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMProductionLineIssues", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlineissues.index');
    }

    /**
     * Display the specified jmproductionlineissue.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmproductionlineissue = JMProductionLineIssue::find($id);
        $module = Module::get('JMProductionLineIssues');
        $module->row = $jmproductionlineissue;
        return view('la.jmproductionlineissues.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmproductionlineissue', $jmproductionlineissue);
    }

    /**
     * Show the form for editing the specified jmproductionlineissue.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmproductionlineissue = JMProductionLineIssue::find($id);
        
        $module = Module::get('JMProductionLineIssues');
        
        $module->row = $jmproductionlineissue;
        
        return view('la.jmproductionlineissues.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmproductionlineissue', $jmproductionlineissue);
    }

    /**
     * Update the specified jmproductionlineissue in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMProductionLineIssues", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMProductionLineIssues", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlineissues.index');
    }

    /**
     * Remove the specified jmproductionlineissue from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMProductionLineIssue::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmproductionlineissues.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmproductionlineissues')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproductionlineissues/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmproductionlineissues/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmproductionlineissues.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
