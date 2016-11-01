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
use App\CardGroup;
use App\GroupType;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Dwij\Laraadmin\Helpers\LAHelper;
use App\file;
use App\Upload;

class CardGroupsController extends Controller
{
    public $show_action = true;
    public $view_col = 'group_type_id';
    public $listing_cols = ['id', 'group_type_id', 'card_front_image_link', 'card_Back_image_link',  'description', 'layout', 'user_id' ];
    // hide column 'view_html', 'view_html_back'
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the CardGroups.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $grouptypes = GroupType::all();


        $module = Module::get('CardGroups');
        
        return View('la.cardgroups.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
            'grouptypes' => $grouptypes
        ]);
    }

    /**
     * Show the form for creating a new cardgroup.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created cardgroup in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("CardGroups", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        // $insert_id = Module::insert("CardGroups", $request);
             
             $cardGroupobj = new CardGroup();
             $cardGroupobj->group_type_id = $request->group_type_id;
             $cardGroupobj->view_html = $request->view_html;
             $cardGroupobj->view_html_back = $request->view_html_back;
             $cardGroupobj->description = $request->description;
             $cardGroupobj->layout = $request->layout;
             $cardGroupobj->user_id = Auth::user()->id;

       
          if ($request->hasFile('image')) {
                $folder = storage_path('uploads/cardbackground');
                $data = $request->input('image');
                $date_append = date("Y-m-d-His-");
                $photo_front= $request->file('image')->getClientOriginalName();
                $cardGroupobj->card_front_image_link  = $date_append.'_front_'.$photo_front;
                $request->file('image')->move($folder, $cardGroupobj->card_front_image_link);
            }if ($request->hasFile('image_back')) {
                $folder = storage_path('uploads/cardbackground');
                $data = $request->input('image_back');
                $date_append = date("Y-m-d-His-");
                $photo_back=$request->file('image_back')->getClientOriginalName();
                $cardGroupobj->card_Back_image_link  = $date_append.'_back_'.$photo_back;
                $request->file('image_back')->move($folder, $cardGroupobj->card_Back_image_link);
            }
            // else{
            //     return response()->json('error: upload file not found.', 400);
            // }
            
            $cardGroupobj->save();

            return redirect()->route(config('laraadmin.adminRoute') . '.cardgroups.index');
    }

    /**
     * Display the specified cardgroup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cardgroup = CardGroup::find($id);
        $module = Module::get('CardGroups');
        $module->row = $cardgroup;
        return view('la.cardgroups.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('cardgroup', $cardgroup);
    }

    /**
     * Show the form for editing the specified cardgroup.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cardgroup = CardGroup::find($id);
        
        $module = Module::get('CardGroups');
        
        $module->row = $cardgroup;
        
        return view('la.cardgroups.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('cardgroup', $cardgroup);
    }

    /**
     * Update the specified cardgroup in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("CardGroups", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("CardGroups", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cardgroups.index');
    }

    /**
     * Remove the specified cardgroup from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CardGroup::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.cardgroups.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('cardgroups')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/cardgroups/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/cardgroups/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.cardgroups.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
    
    public function cardviewbytype($typeid)
    {
        $cardviewbygrouptype = CardGroup::where('group_type_id' , $typeid)->get();
        return response()->json($cardviewbygrouptype);
    }
}
