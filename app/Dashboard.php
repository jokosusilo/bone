<?php

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    public function getCountData()
    {
    	return [
    		'post'    => DB::table('posts')->count(),
            'contact' => DB::table('contacts')->count()
    	];
    }
}
