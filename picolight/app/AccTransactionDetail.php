<?php
/**
 * Model genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccTransactionDetail extends Model
{
    use SoftDeletes;
	
	protected $table = 'acctransactiondetails';
	
	protected $hidden = [
        
    ];

	protected $guarded = [];

	protected $dates = ['deleted_at'];

	public function trans()
    {
        return $this->belongsTo('App\AccTransactionMaster' , 'trans_m_id');
    }
}
