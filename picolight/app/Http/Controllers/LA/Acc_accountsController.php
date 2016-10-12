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

use App\Acc_account;

class Acc_accountsController extends Controller
{
    public $show_action = true;
    public $view_col = 'account_id';
    public $listing_cols = ['id', 'account_id', 'account_no', 'account_title', 'acc_or_group', 'acc_depth', 'nature', 'account_status', 'parent_id', 'opening_balance', 'current_balance', 'is_inventory_related', 'ledger_type_id', 'ledger_id', 'company_id', 'user_id', 'modified_date', 'final_parent_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }

    // public function treeView(){       
    //     $Categorys = Acc_account::where('parent_id', '=', 0)->get();
    //     $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
    //     foreach ($Categorys as $Category) {
    //          $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->name.'</a>';
    //          if(count($Category->childs)) {
    //             $tree .=$this->childView($Category);
    //         }
    //     }
    //     $tree .='<ul>';
    //     // return $tree;
    //     return view('files.treeview',compact('tree'));
    // }
   

    
    /**
     * Display a listing of the Acc_accounts.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Acc_accounts');
         // $acc_items = Acc_account::all();
        // $acc_items =new Acc_account;
        // $p = DB::table('acc_accounts')
        //              ->select('account_title')
        //              ->where('parent_id', 0)
        //              ->get();
        // $acc_items = $p;
       
        // $acc_items = DB::table('acc_accounts')
        //              ->select('account_title')
        //              ->where('parent_id', 0)
        //              ->get();
          
        $acc_items = Acc_account::where('parent_id', 0)->get();
        $head2 = Acc_account::where('parent_id',1)->get();
        // var_dump($head2);
        $Categorys = Acc_account::where('parent_id', '=', 0)->get();
        $tree='<ul id="browser" class="filetree"><li class="tree-view"></li>';
        foreach ($Categorys as $Category) {
             $tree .='<li class="tree-view closed"<a class="tree-name">'.$Category->account_title.'</a>';
             if(count($Category->childs)) {
                $tree .=$this->childView($Category);
            }
        }
        $tree .='<ul>';
        return View('la.acc_accounts.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'acc_items' => $acc_items,
            'head2' => $head2,
            'module' => $module
        ]
        ,compact('tree'));
        // $this->childView($Category);
       
        // return $tree;
        // return view('files.treeview',compact('tree'));
    }
     public function childView($Category){                 
            $html ='<ul>';
            foreach ($Category->childs as $arr) {
                if(count($arr->childs)){
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
     * Show the form for creating a new acc_account.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created acc_account in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $rules = Module::validateRules("Acc_accounts", $request);
        
        // $validator = Validator::make($request->all(), $rules);
        
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }
            
        // $insert_id = Module::insert("Acc_accounts", $request);
        // $acc_items = Acc_account::all();
        // foreach ($acc_items as $item) {
        //     # code...
        //     var_dump($item->account_title);
        // }
        // $acc_items = DB::table('acc_accounts')
        //              ->select('account_title')
        //              ->where('parent_id', 0)
        //              ->get();
        //              var_dump($acc_items);
        // return redirect()->route(config('laraadmin.adminRoute') . '.acc_accounts.index');
        $head2 = Acc_account::where('parent_id','!=',0)->first();
        // var_dump($head2);

        $p_id = $head2->id;
        // var_dump($p_id);
        $n_id = $head2->nature;
        // var_dump($n_id);
        $voucher = new Acc_account();

        if($voucher->id == 0)
        {
            $updatevoucher = new Acc_account();
        }
        else
        {
            $updatevoucher = Acc_account::find($voucher->id);
        }
 

        $updatevoucher->account_title = $request->account_title;
        $updatevoucher->account_no = $request->account_no;
        // $updatevoucher->voucher_type = 2;//Debit = 2
        $updatevoucher->acc_or_group = $request->acc_or_group;
        $updatevoucher->account_status = $request->account_status;
        $updatevoucher->opening_balance = $request->opening_balance;
        $updatevoucher->current_balance = $request->current_balance;
        $updatevoucher->is_inventory_related = $request->is_inventory_related;
        $updatevoucher->acc_depth = "2";
        // if ( $request ->$head2) {
        $updatevoucher->parent_id = $request ->head2;
            
        // }
        // $updatevoucher->parent_id = $p_id;
        $updatevoucher->nature = $n_id;
        $updatevoucher->user_id = Auth::user()->id;

        $updatevoucher->save();

        return redirect()->route(config('laraadmin.adminRoute') . '.acc_accounts.index');



    }

    /**
     * Display the specified acc_account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $acc_account = Acc_account::find($id);
        $module = Module::get('Acc_accounts');
        $module->row = $acc_account;
        return view('la.acc_accounts.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('acc_account', $acc_account);
    }

    /**
     * Show the form for editing the specified acc_account.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $acc_account = Acc_account::find($id);
        
        $module = Module::get('Acc_accounts');
        
        $module->row = $acc_account;
        
        return view('la.acc_accounts.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('acc_account', $acc_account);
    }

    /**
     * Update the specified acc_account in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Acc_accounts", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Acc_accounts", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_accounts.index');
    }

    /**
     * Remove the specified acc_account from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Acc_account::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.acc_accounts.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('acc_accounts')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_accounts/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/acc_accounts/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.acc_accounts.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

    public function acc_sub_item($itemid)
    {
        $itemchatacory = Acc_account::where('parent_id' , $itemid)->get();
        return response()->json($itemchatacory);
    }

    public function sub_acc_code($itemid)
    {
        $itemchatacory = Acc_account::where('id' , $itemid)->get();
        return response()->json($itemchatacory);
    }
    public function count_acc_code($itemid)
    {
        $itemchatacory = Acc_account::where('parent_id' , $itemid)->count();
        return response()->json($itemchatacory);
        
    }
}
