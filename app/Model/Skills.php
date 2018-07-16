<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Skills extends Model {

    protected $table = 'judge_lst_ljlevel';
    protected $primaryKey = 'level_id';

    protected $fillable = [
        'level_name', 'level_as'
    ];


}
