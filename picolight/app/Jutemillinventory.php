<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jutemillinventory extends Model
{
    use SoftDeletes;
	
	protected $table = 'jutemillinventorys';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function item()
	    {
	        return $this->belongsTo('App\JuteMillItem');
	    }

	public function itemcategory()
	    {
	        return $this->belongsTo('App\JuteMillItemCategory' , 'item_categorie_id');
	    }
	public function pdf($jutemillinventorys1)
	    {
	       $dompdf = new DOMPDF();
	       $jutemillinventorys= Jutemillinventory::all();

	        $pdf = PDF::loadView('pdf.jutemillinventoryreport',['jutemillinventorys'=>$jutemillinventorys]);
	        return $pdf ->stream('jutemillinventoryreport.pdf', array("Attachment" =>false));
	    }
}
