<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Judge extends Model {

    protected $table = 'judge_lst_judges';
    protected $primaryKey = 'judge_id';

    protected $fillable = [
        'first_name', 'sur_name', 'email', 'dob','address_line1', 'address_line2', 
        'address_line3', 'city', 'post_code', 'country', 'home_phone', 'mobile_phone',
        'skills_level', 'skills_level_achieved', 'membership_expiry_date', 'member_ship', 'active', 'created_at', 'updated_at'
    ];

    public $timestamps = false;

    public function get_country(){
        return $this->belongsTo('App\Model\Country', 'country', 'country_id');
    }

    public function get_region(){
        return $this->belongsTo('App\Model\Region', 'region', 'region_id');
    }

    public function get_skill_level(){
        return $this->belongsTo('App\Model\Skills', 'skills_level', 'level_id');
    }

}
