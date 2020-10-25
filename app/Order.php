<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	protected $table = "orders";
	protected $primaryKey = "id";

	public function order_status()
	{
		return $this->belongsTo('App\Order_Status', 'order_status_id', 'id');
	}

	public function driver()
	{
		return $this->belongsTo('App\Driver', 'driver_id', 'id');
	}

	public function tour()
	{
		return $this->belongsTo('App\Tour', 'tour_id', 'id');
	}
}
