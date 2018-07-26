<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Judge;
use App\Model\Event;
use App\Model\EventLevel;
use App\Model\Duty;

class DashboardController extends Controller {

    function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $page_title = 'Dashboard';
        $user_count = User::count();
        $event_count = Event::count();
        $judge_count = Judge::count();
        $game_count = Duty::count();

        // Event Levels
        $event_levels = EventLevel::all()->keyBy('event_level_id');

        // Count of events by Season
        $sql = " select count(event_id) as count, season, event_level, event_level_name from judge_lst_events".
              " left join judge_event_levels on judge_lst_events.event_level=judge_event_levels.event_level_id".
              " group by season, event_level, event_level_name order by season desc";
        $events = \DB::select($sql);

        $events_by_seasons = array();
        foreach($events as $key=>$row){
            foreach($event_levels as $lvl_key=>$event_level){
                $c = new \stdClass();
                $c->count = 0;
                $events_by_seasons[$row->season][$lvl_key] = $c;
            }
        }

        foreach($events as $key=>$row){

            $events_by_seasons[$row->season][$row->event_level] = $row; 
        }

        // Count judges by skill level
        $sql = " select count(judge_id) as count, level_name from judge_lst_judges ".
               " left join judge_lst_ljlevel on judge_lst_ljlevel.level_id = judge_lst_judges.skills_level".
               " group by skills_level, level_name order by skills_level asc";
        $count_by_skilllvl = \DB::select($sql);

        // Count judges by years
        $sql = "select sum(CASE WHEN DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y')<20 THEN 1 ELSE 0 END) AS '< 20yrs',".
		      " sum(case when DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y') between 20 and 35 then 1 else 0 end) as '20yrs - 35yrs',".
		      " sum(case when DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y') between 35 and 50 then 1 else 0 end) as '35yrs - 50yrs',".
		      " sum(case when DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y') between 50 and 65 then 1 else 0 end) as '50yrs - 65yrs',".
		      " sum(case when DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(), dob)), '%Y')>65 then 1 else 0 end) as '> 65yrs'".
              " from judge_lst_judges";
        $demographics = \DB::select($sql);
        return view('dashboard', compact('page_title', 'user_count', 'event_count', 'judge_count', 'game_count', 'event_levels', 'events_by_seasons', 'count_by_skilllvl', 'demographics'));
    }

}
