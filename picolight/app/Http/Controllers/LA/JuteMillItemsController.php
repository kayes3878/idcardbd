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
use App\Jutemillitem;
use PDF; 

class JutemillitemsController extends Controller
{
    public $show_action = true;
    public $view_col = 'item_name';
    public $listing_cols = ['id', 'item_name', 'item_code', 'item_discription', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Jutemillitems.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Jutemillitems');
        
        return View('la.jutemillitems.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module
        ]);

     
    }

    /**
     * Show the form for creating a new jutemillitem.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created jutemillitem in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("Jutemillitems", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
         $insert_id = Module::insert("Jutemillitems", $request);
         
        //  $dompdf = new Dompdf();
        // $dompdf -> set_paper($paper,$orientation);
        // $dompdf -> load_html($html);
        // $dompdf -> render();
        // $dompdf -> stream($filename.".pdf");

        // $filename = 'file_name';
        // // $dompdf = new Dompdf();
        // $html = file_get_contents('la.jutemillitems.index');
        // pdf_create ($html , $filename, 'A4', 'portrait');

        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitems.index');

       
    }

    // *************** PDF Convert ******************

    // public function htmltopdfview(Request $request)
    // {
    //     $jutemillitem = Jutemillitem::all();
    //     $module = Module::get('Jutemillitems', $request);
    //     $module->row = $jutemillitem;
    //     $rules = Module::validateRules("Jutemillitems", $request);
        
    //     $validator = Validator::make($request->all(), $rules);



    //     // $module = Module::get('Jutemillitems');

    //     // $jutemillitem = jutemillitem::all();
    //     view()->share('jutemillitem',$jutemillitem);
    //     // if($request->has('download')){
    //         $pdf = PDF::loadView('la.jutemillitems.show', [
    //         'module' => $module,
    //         'view_col' => $this->view_col,
    //         'no_header' => true,
    //         'no_padding' => "no-padding",

    //     ]);

    //         return $pdf->download('la.jutemillitems.show', [
    //         'module' => $module,
    //         'view_col' => $this->view_col,
    //         'no_header' => true,
    //         'no_padding' => "no-padding"
    //     ]);
    //     // }
        
    //     return View('la.jutemillitems.show', [
    //         'module' => $module,
    //         'view_col' => $this->view_col,
    //         'no_header' => true,
    //         'no_padding' => "no-padding"
    //     ]);
 
    // }

    // End pdf 

    /**
     * Display the specified jutemillitem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jutemillitem = Jutemillitem::find($id);
        $module = Module::get('Jutemillitems');
        $module->row = $jutemillitem;
        return view('la.jutemillitems.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('jutemillitem', $jutemillitem);
    }

    /**
     * Show the form for editing the specified jutemillitem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jutemillitem = Jutemillitem::find($id);
        
        $module = Module::get('Jutemillitems');
        
        $module->row = $jutemillitem;
        
        return view('la.jutemillitems.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('jutemillitem', $jutemillitem);
    }

    /**
     * Update the specified jutemillitem in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Jutemillitems", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Jutemillitems", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitems.index');
    }

    /**
     * Remove the specified jutemillitem from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Jutemillitem::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.jutemillitems.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('jutemillitems')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillitems/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/jutemillitems/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.jutemillitems.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }

  
}
