<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Model\Judge;

class Country extends Model {

    protected $table = 'judge_countries';
    protected $primaryKey = 'country_id';

    protected $fillable = [
        'country_name', 'country_as'
    ];

    // public function judges(){
    //     return $this->hasMany('App\Model\Judge');
    // }
}
