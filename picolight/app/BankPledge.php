<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BankPledge extends Model
{
    use SoftDeletes;
	
	protected $table = 'bankpledges';
	
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
	public function pdf($bankpledges1)
	    {
	       $dompdf = new DOMPDF();
	       $bankpledges= BankPledge::where ('bankpledge_no',$bankpledges1)->get();

	        $pdf = PDF::loadView('pdf.bankpledgereport',['bankpledges'=>$bankpledges]);
	        return $pdf ->stream('bankpledgereport.pdf', array("Attachment" =>false));
	    }
}

	
   



