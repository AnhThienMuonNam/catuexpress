<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_Status extends Model
{
	protected $table = "order_statuses";
	protected $primaryKey = "id";

	public function orders()
	{
		return $this->hasMany('App\Order', 'order_status_id', 'id');
	}
}
