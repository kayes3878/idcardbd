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

use App\JMBankAccountInfo;

class JMBankAccountInfosController extends Controller
{
    public $show_action = true;
    public $view_col = 'bank_name';
    public $listing_cols = ['id', 'bank_name', 'branch', 'account_name', 'account_no', 'opening_date', 'opening_balance', 'current_balance', 'loan', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JMBankAccountInfos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JMBankAccountInfos');
        
        return View('la.jmbankaccountinfos.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jmbankaccountinfo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jmbankaccountinfo in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JMBankAccountInfos", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("JMBankAccountInfos", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmbankaccountinfos.index');
    }

    /**
     * Display the specified jmbankaccountinfo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jmbankaccountinfo = JMBankAccountInfo::find($id);
        $module = Module::get('JMBankAccountInfos');
        $module->row = $jmbankaccountinfo;
        return view('la.jmbankaccountinfos.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jmbankaccountinfo', $jmbankaccountinfo);
    }

    /**
     * Show the form for editing the specified jmbankaccountinfo.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jmbankaccountinfo = JMBankAccountInfo::find($id);
        
        $module = Module::get('JMBankAccountInfos');
        
        $module->row = $jmbankaccountinfo;
        
        return view('la.jmbankaccountinfos.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jmbankaccountinfo', $jmbankaccountinfo);
    }

    /**
     * Update the specified jmbankaccountinfo in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JMBankAccountInfos", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JMBankAccountInfos", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jmbankaccountinfos.index');
    }

    /**
     * Remove the specified jmbankaccountinfo from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JMBankAccountInfo::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jmbankaccountinfos.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jmbankaccountinfos')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jmbankaccountinfos/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jmbankaccountinfos/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jmbankaccountinfos.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
