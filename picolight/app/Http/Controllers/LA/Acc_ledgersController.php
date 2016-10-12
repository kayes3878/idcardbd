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

use App\Acc_ledger;
use App\Acc_ledger_type;
use App\AccTransactionMaster;
use App\AccTransactionMethod;
use App\AccTransactionDetail;
use App\Acc_account;

class Acc_ledgersController extends Controller
{
    public $show_action = true;
    public $view_col = 'ledger_id';
    public $listing_cols = ['id', 'ledger_id', 'ledger_name', 'ledger_type', 'ledger_type_id', 'address', 'country_id', 'currency_id', 'contact_person', 'bank_acc_type', 'business_type', 'phone', 'fax', 'email', 'remarks', 'team_id', 'account_id', 'modified_date', 'company_id', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Acc_ledgers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $module = Module::get('Acc_ledgers');
        // $voucher = new AccTransactionMaster();
        // $items = AccTransactionMethod::all();
        // // $acc_items = Acc_account::all();
        $ledger_types = Acc_ledger_type::all();
        $acc_items1 = Acc_account::where('acc_depth','=',0)->get();
        $acc_items2 = Acc_account::where('acc_depth','=',1)->get();
        $acc_items3 = Acc_account::where('acc_depth','=',2)->get();
        $parent = Acc_account::all();
        

        // $updatevoucher = new Acc_account();
        // $acc_transaction_detail_info = AccTransactionDetail::where('account_id', 1)->get();
        // return View('la.acc_ledgers.index', [
        //     'show_actions' => $this->show_action,
        //     'listing_cols' => $this->listing_cols,
        //     'voucher' => $voucher,
        //     'items' => $items,
        //     // 'acc_items' => $acc_items,
        //     'module' => $module,
        //     'acc_items1' => $acc_items1,
        //     'acc_items2' => $acc_items2,
        //     'acc_items3' => $acc_items3,
        //     'ledger_types' => $ledger_types,

        //     'acc_transaction_detail_info' => $acc_transaction_detail_info,
        // ]);
         $Categorys = Acc_account::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Categorys as $Category) {
             $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->account_title.'</a>';
             if(count($Category->childs)) {
                $tree .=$this->childView($Category);
            }
        }
        $tree .='<ul>';
        // return $tree;
        return View('la.acc_ledgers.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            // 'voucher' => $voucher,
            // 'items' => $items,
            // 'acc_items' => $acc_items,
            // 'module' => $module,
            'acc_items1' => $acc_items1,
            'acc_items2' => $acc_items2,
            'acc_items3' => $acc_items3,
            'parent' => $parent,
            'ledger_types' => $ledger_types,
            'tree' => $tree,
            compact('tree'),
            // 'acc_transaction_detail_info' => $acc_transaction_detail_info,
        ]);
    }

    /**
     * Show the form for creating a new acc_ledger.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    // public function treeView(){       
    //     $Categorys = Acc_account::where('parent_id', '=', 0)->get();
    //     $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
    //     foreach ($Categorys as $Category) {
    //          $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->account_title.'</a>';
    //          if(count($Category->childs)) {
    //             $tree .=$this->childView($Category);
    //         }
    //     }
    //     $tree .='<ul>';
    //     // return $tree;
    //     return view('treeview',compact('tree'));
    // }

    public function childView($Category){                 
            $html ='<ul>';
            foreach ($Category->childs as $arr) {
                if(count($arr->account_title)){
                $html .='<li class="tree-view closed"><a class="tree-name">'.$arr->account_title.'</a>';                  
                        $html.= $this->childView($arr);
                    }else{
                        $html .='<li class="tree-view"><a class="tree-name">'.$arr->account_title.'</a>';                                 
                        $html .="</li>";
                    }
                                   
            }
            
            $html .="</ul>";
            return $html;
    }   

    /**
     * Store a newly created acc_ledger in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = Module::validateRules("Acc_ledgers", $request);
        
        // $validator = Validator::make($request->all(), $rules);
        
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
            
        // $insert_id = Module::insert("Acc_ledgers", $request);
        $updatevoucher = new Acc_account();
        $acc_transaction_detail_info = AccTransactionDetail::where('account_id', $request->account_title)->get();
        // $acc_transaction_detail_info = AccTransactionDetail::where('account_id', $request->account_title)->first();
        // var_dump($acc_transaction_detail_info->trans_m_id);
        // $acc_transaction_ma_info = AccTransactionMaster::where('trans_ma_id', $acc_transaction_detail_info->trans_m_id)->first();
        // $a = $acc_transaction_detail_info->trans->voucher_no;
        // var_dump($a);
        // for ($i=0; $i < 10; $i++) { 
        //     # code...
        //     var_dump($acc_transaction_ma_info);
        // }
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledgers.index');
    }

    /**
     * Display the specified acc_ledger.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acc_ledger = Acc_ledger::find($id);
        $module = Module::get('Acc_ledgers');
        $module->row = $acc_ledger;
        return view('la.acc_ledgers.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acc_ledger', $acc_ledger);
    }

    /**
     * Show the form for editing the specified acc_ledger.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_ledger = Acc_ledger::find($id);
        
        $module = Module::get('Acc_ledgers');
        
        $module->row = $acc_ledger;
        
        return view('la.acc_ledgers.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acc_ledger', $acc_ledger);
    }

    /**
     * Update the specified acc_ledger in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Acc_ledgers", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Acc_ledgers", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledgers.index');
    }

    /**
     * Remove the specified acc_ledger from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acc_ledger::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_ledgers.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acc_ledgers')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_ledgers/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_ledgers/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acc_ledgers.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
