<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Judge;

class Region extends Model {

    protected $table = 'judge_regions';
    protected $primaryKey = 'region_id';

    protected $fillable = [
        'region_name', 'region_as'
    ];

    // public function judges(){
    //     return $this->hasMany('App\Model\Judge');
    // }
}
