<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function caterory(){
    	return $this->hasmany('App\Caterory','parent_id');
    }
}
