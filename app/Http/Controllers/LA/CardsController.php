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

use App\Card;
use App\GroupType;
use App\CardGroup;


class CardsController extends Controller
{
    public $show_action = true;
    public $view_col = 'name';
    public $listing_cols = ['id', 'name', 'fathername', 'mathername', 'Photo', 'phone', 'organization', 'designation_class', 'Group', 'user_id'];
    
    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the Cards.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $module = Module::get('Cards');
        // $grouptypes = GroupType::all();
        $grouptypes = CardGroup::where('user_id', Auth::user()->id)->get();
        // Auth::user()->id;
        $view='';

        return View('la.cards.index', [
            'show_actions' => $this->show_action,
            'listing_cols' => $this->listing_cols,
            'module' => $module,
            'view' => $view,
            'grouptypes' => $grouptypes
        ]);
    }

    /**
     * Show the form for creating a new card.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created card in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = Module::validateRules("Cards", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
            
        $insert_id = Module::insert("Cards", $request);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cards.index');
    }

    /**
     * Display the specified card.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $card = Card::find($id);
        $module = Module::get('Cards');
        $module->row = $card;
        return view('la.cards.show', [
            'module' => $module,
            'view_col' => $this->view_col,
            'no_header' => true,
            'no_padding' => "no-padding"
        ])->with('card', $card);
    }

    /**
     * Show the form for editing the specified card.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $card = Card::find($id);
        
        $module = Module::get('Cards');
        
        $module->row = $card;
        
        return view('la.cards.edit', [
            'module' => $module,
            'view_col' => $this->view_col,
        ])->with('card', $card);
    }

    /**
     * Update the specified card in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = Module::validateRules("Cards", $request);
        
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();;
        }
        
        $insert_id = Module::updateRow("Cards", $request, $id);
        
        return redirect()->route(config('laraadmin.adminRoute') . '.cards.index');
    }

    /**
     * Remove the specified card from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Card::find($id)->delete();
        // Redirecting to index() method
        return redirect()->route(config('laraadmin.adminRoute') . '.cards.index');
    }
    
    /**
     * Datatable Ajax fetch
     *
     * @return
     */
    public function dtajax()
    {
        $users = DB::table('cards')->select($this->listing_cols);
        $out = Datatables::of($users)->make();
        $data = $out->getData();
        
        for($i=0; $i<count($data->data); $i++) {
            for ($j=0; $j < count($this->listing_cols); $j++) { 
                $col = $this->listing_cols[$j];
                if($col == $this->view_col) {
                    $data->data[$i][$j] = '<a href="'.url(config('laraadmin.adminRoute') . '/cards/'.$data->data[$i][0]).'">'.$data->data[$i][$j].'</a>';
                }
                // else if($col == "author") {
                //    $data->data[$i][$j];
                // }
            }
            if($this->show_action) {
                $output = '<a href="'.url(config('laraadmin.adminRoute') . '/cards/'.$data->data[$i][0].'/edit').'" class="btn btn-warning btn-xs" style="display:inline;padding:2px 5px 3px 5px;"><i class="fa fa-edit"></i></a>';
                $output .= Form::open(['route' => [config('laraadmin.adminRoute') . '.cards.destroy', $data->data[$i][0]], 'method' => 'delete', 'style'=>'display:inline']);
                $output .= ' <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-times"></i></button>';
                $output .= Form::close();
                $data->data[$i][] = (string)$output;
            }
        }
        $out->setData($data);
        return $out;
    }
}
