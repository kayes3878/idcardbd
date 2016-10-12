<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Acc_account;

class Acc_ledger extends Model
{
    use SoftDeletes;
	
	protected $table = 'acc_ledgers';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];


	 public function childs() {
           return $this->hasMany('App\Acc_account','parent_id','id') ;
   }
}
