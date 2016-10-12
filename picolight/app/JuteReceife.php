<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JuteReceife extends Model
{
    use SoftDeletes;
	

	protected $table = 'jutereceives';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function supplier()
    {
        return $this->belongsTo('App\Jutemillsupplier');
    }
    public function item()
    {
        return $this->belongsTo('App\JuteMillItem');
    }
    // public function itemcategory()
    // {
    //     return $this->belongsTo('App\JuteMillItemCategory');
    // }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function itemcategory()
    {
        return $this->belongsTo('App\JuteMillItemCategory', 'itemcategorie_id');
    }

    public function pdf($jutereceives1)
    {
        $dompdf = new DOMPDF();
        $jutereceives= JuteReceife::where('jute_receive_no' , $jutereceives1)->get();

        $pdf = PDF::loadView('pdf.jutereceivereportClientcopy',['jutereceives'=>$jutereceives]);
        return $pdf ->stream('jutereceivereportClientcopy.pdf', array('Attachment' =>0));
    }
}
