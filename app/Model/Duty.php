<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Duty extends Model {

    protected $table = 'judge_dt_duty';
    protected $primaryKey = 'duty_id';
    protected $fillable = [
        'judge_id', 'event_id', 'status', 'cancel_reason', 'start_date', 'finish_date', 'created_at', 'updated_at'
    ];
    public $timestamps = false;


}
