<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Tour;
use App\About_Us;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	function __construct()
	{
		$MasterTours = Tour::select('id', 'title', 'description', 'image', 'price')->where('is_deleted', 0)->where('is_active', 1)->get();
		$About_Us = About_Us::orderBy('created_at', 'desc')->first();

		view()->share(['MasterTours' => $MasterTours, 'About_Us' => $About_Us]);
	}
}
