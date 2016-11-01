<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CardGroup extends Model
{
    use SoftDeletes;
	
	protected $table = 'cardgroups';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	 
	public function cardtype()
	    {
	        return $this->belongsTo('App\GroupType' , 'group_type_id');
	    }
}
