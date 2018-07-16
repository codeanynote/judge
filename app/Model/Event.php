<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Event extends Model {

    protected $table = 'judge_lst_events';
    protected $primaryKey = 'event_id';

    protected $fillable = [
        'event_name','event_number', 'year', 'season', 'event_start_date','event_finish_date', 'event_level',
        'event_manager', 'event_deputy_mgr', 'lead_assessor',
        'event_in_uk', 'created_at', 'updated_at'
    ];

    public $timestamps = false;

    public function get_event_level(){
        return $this->belongsTo('App\Model\EventLevel', 'event_level', 'event_level_id');
    }

    

}
