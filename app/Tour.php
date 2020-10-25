<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    protected $table = "tours";
    protected $primaryKey = "id";

    public function orders()
	{
		return $this->hasMany('App\Order', 'tour_id', 'id');
	}
}