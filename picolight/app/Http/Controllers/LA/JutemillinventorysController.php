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

use App\Jutemillinventory;
use PDF;
use Dompdf\Dompdf;
use App\BankPledge;
use App\jutemillinventoryreport;

class JutemillinventorysController extends Controller
{
    public $show_action = true;
    public $view_col = 'code';
    public $listing_cols = ['id', 'code', 'date', 'item_id', 'item_categorie_id', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'stock_in_store', 'stock_from', 'isInStock', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Jutemillinventorys.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Jutemillinventorys');
        
        return View('la.jutemillinventorys.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);
    }

    public function getinventoryREPORT(){

        $dompdf = new DOMPDF();

        $jutemillinventorys= Jutemillinventory::groupBy('item_categorie_id')
        ->selectRaw('*, sum(total_quantity) as total , count(item_categorie_id) as number')
        ->get();

        // $jutemillinventorys= Jutemillinventory::groupBy('item_categorie_id')
        //         ->selectRaw('*,count(item_categorie_id) as number , ')
        //         ->get();


        $pdf = PDF::loadView('pdf.jutemillinventoryreport',['jutemillinventorys'=>
            $jutemillinventorys]);
        $pdf ->setPaper('A4', 'potrait');
        return $pdf ->stream('jutemillinventoryreport.pdf', array("Attachment" =>0));

    }

    /**
     * Show the form for creating a new jutemillinventory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutemillinventory in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("Jutemillinventorys", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("Jutemillinventorys", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillinventorys.index');

        
    }

    /**
     * Display the specified jutemillinventory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutemillinventory = Jutemillinventory::find($id);
        $module = Module::get('Jutemillinventorys');
        $module->row = $jutemillinventory;
        return view('la.jutemillinventorys.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutemillinventory', $jutemillinventory);
    }

    /**
     * Show the form for editing the specified jutemillinventory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutemillinventory = Jutemillinventory::find($id);
        
        $module = Module::get('Jutemillinventorys');
        
        $module->row = $jutemillinventory;
        
        return view('la.jutemillinventorys.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutemillinventory', $jutemillinventory);
    }

    /**
     * Update the specified jutemillinventory in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Jutemillinventorys", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Jutemillinventorys", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillinventorys.index');
    }

    /**
     * Remove the specified jutemillinventory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jutemillinventory::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillinventorys.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutemillinventorys')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillinventorys/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillinventorys/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutemillinventorys.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

    public function inventory_items($subitem_itemid)
    {

        $pledge_items = Jutemillinventory::where([
                    ['item_categorie_id', $subitem_itemid],
                    ['stock_in_store','!=' ,1]
                ])->get(); 
      // "stock_in_store = 1" /not in stock
        return response()->json($pledge_items);
    }
}

