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

use App\JuteReceife;
use App\Jutemillsupplier;

use PDF;
use Dompdf\Dompdf;

class JuteReceivesController extends Controller
{
    public $show_action = true;
    public $view_col = 'jute_receive_no';
    public $listing_cols = ['id', 'jute_receive_no', 'date_receive_jute', 'supplier_id', 'item_id', 'itemcategorie_id', 'item_categorie', 'unit_type', 'sub_unit_type', 'quantity', 'sub_unit_quantity', 'total_quantity', 'is_bank_paedge', 'is_bill_paid', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the JuteReceives.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('JuteReceives');
        $jmSuppliers = Jutemillsupplier::all();

        
        return View('la.jutereceives.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'jmSuppliers' => $jmSuppliers,
            'module' => $module
        ]);
    }

    /**
     * Show the form for creating a new jutereceife.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutereceife in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("JuteReceives", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        // $insert_id = Module::insert("JuteReceives", $request);
            $receive_no_obj = new JuteReceife();
            $receive_no_last = JuteReceife::all() -> last();
        ///  code
                if ($receive_no_last != null) {
                        $receiveNoUnique =$receive_no_last->jute_receive_no+1;
                        // $receiveNoUnique =$receive_no_last->id+1;
                        if (strlen($receiveNoUnique) == 3) {
                        $receiveNoUnique = "0" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 2) {
                            $receiveNoUnique = "00" . $receiveNoUnique;
                        } elseif (strlen($receiveNoUnique) == 1) {
                            $receiveNoUnique = "000" . $receiveNoUnique;
                        }
                    $receive_no_obj->jute_receive_no = $receiveNoUnique;
                    
                    }
                    else{
                    $receive_no_obj->jute_receive_no= "000". 1;
                    
                    }

        for($detial_index = 1; $detial_index <= $request->detail_max_number;$detial_index++)
        {
                 
                $updateJ_receive = new JuteReceife();
                $updateJ_receive->jute_receive_no = $receive_no_obj->jute_receive_no;
                // $updateJ_receive->date_receive_jute = $request=;
                $updateJ_receive->supplier_id = $request->supplier_id;
                $updateJ_receive->item_id = $request->item_id[$detial_index];
                $updateJ_receive->itemcategorie_id = $request->item_categorie_id[$detial_index];
                $updateJ_receive->unit_type = $request->unit_type[$detial_index];
                $updateJ_receive->sub_unit_type = $request->sub_unit_type[$detial_index];
                $updateJ_receive->quantity = $request->quantity[$detial_index];
                $updateJ_receive->sub_unit_quantity = $request->sub_unit_quantity[$detial_index];
                $updateJ_receive->total_quantity = $request->total_sub_qnt;
                $updateJ_receive->is_bill_paid = 'Due';
                $updateJ_receive->is_bank_paedge = 'Not pledged';
                $updateJ_receive->user_id = Auth::user()->id;
                $updateJ_receive->save();

        }
         
    // $picks = DB::table('picks')->distinct()->select('user_id')->where('weeknum', '=', 1)->groupBy('user_id')->get();
        $dompdf = new DOMPDF();
        $jutereceives= JuteReceife::where('jute_receive_no' , $updateJ_receive->jute_receive_no)->get();

        $pdf = PDF::loadView('pdf.jutereceivereportClientcopy',['jutereceives'=>$jutereceives]);
        return $pdf ->download('jutereceivereportClientcopy.pdf', array('Attachment' =>1));

        // return redirect()->route(config('laraadmin.adminRoute') . '.jutereceives.index');

    }

    /**
     * Display the specified jutereceife.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutereceife = JuteReceife::find($id);
        $module = Module::get('JuteReceives');
        $module->row = $jutereceife;
        return view('la.jutereceives.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutereceife', $jutereceife);
    }

    /**
     * Show the form for editing the specified jutereceife.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutereceife = JuteReceife::find($id);
        
        $module = Module::get('JuteReceives');
        
        $module->row = $jutereceife;
        
        return view('la.jutereceives.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutereceife', $jutereceife);
    }

    /**
     * Update the specified jutereceife in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("JuteReceives", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("JuteReceives", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutereceives.index');
    }

    /**
     * Remove the specified jutereceife from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        JuteReceife::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutereceives.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutereceives')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutereceives/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutereceives/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutereceives.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

     
}
