<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EventLevel extends Model {

    protected $table = 'judge_event_levels';
    protected $primaryKey = 'event_level_id';

    protected $fillable = [
        'event_level_name', 'event_level_as'
    ];

}
