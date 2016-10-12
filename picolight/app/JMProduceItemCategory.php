<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JMProduceItemCategory extends Model
{
    use SoftDeletes;
	
	protected $table = 'jmproduceitemcategorys';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];
	public function itemcategory()
    {
        return $this->belongsTo('App\JMProductionItem', 'produ_Item');
    }
}
