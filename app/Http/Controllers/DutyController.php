<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Model\Duty;
use App\Model\Judge;
use App\Model\Event;
use App\Model\Skills;
use Maatwebsite\Excel\Facades\Excel;

class DutyController extends Controller {

    private $duty;

    function __construct() {
        $this->middleware('auth');
        $duty = new duty();
    }

    public function index() {
        $page_title = 'LJ Duty';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $judge_list = Judge::orderBy('judge_id', 'ASC')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();
        $sql = "select season from judge_lst_events where year>=" . $from_year . " and year<=" . $to_year . " group by season order by season desc";
        $event_season_list = \DB::select($sql);
        $event_level_list = array();
        $event_event_list = array();

        foreach ($judge_list as $key => $judge) {
            $duty = array();
            foreach ($event_list as $key1 => $event) {
                $sql = "select * from judge_dt_duty where judge_id=" . $judge->judge_id
                    . " and event_id=" . $event->event_id;
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $result[0]->season = $event->season;
                    $result[0]->event_level = $event->event_level;
                    $result[0]->event_start_date = $event->event_start_date;
                    $result[0]->event_finish_date = $event->event_finish_date;
                    array_push($duty, $result[0]);
                } else {
                    $temp = (object) ['judge_id' => $judge->judge_id, 'event_id' => $event->event_id, 'season' => $event->season,
                        'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date,
                        'event_level' => $event->event_level];
                    array_push($duty, $temp);
                }
            }
            $judge->duty = $duty;
        }

        $event_event_list = array();
        for ($i = 0; $i < sizeof($event_season_list); $i ++) {
            $sql = "select event_name, event_start_date, event_finish_date, event_level from judge_lst_events "
                . " where year>=" . $from_year . " and year<=" . $to_year . " and season='" . $event_season_list[$i]->season . "' "
                . " order by season desc, event_start_Date desc, event_id";
            $event_event_list[$i] = \DB::select($sql);
        }
        return view('duty.ljlist', compact('page_title', 'judge_list', 'event_list', 'event_season_list', 'event_event_list', 'years', 'from_year', 'to_year'));
    }

    public function event() {
        $page_title = 'Event Report';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $level_list = Skills::orderBy('level_id', 'asc')->get();

        $judge_list = Judge::orderBy('judge_id', 'ASC')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();
        $sql = "select season from judge_lst_events where year>=" . $from_year . " and year<=" . $to_year . " group by season order by season desc";
        $event_season_list = \DB::select($sql);
        $event_level_list = array();
        $event_event_list = array();

        foreach ($level_list as $key => $level) {
            $duty = array();
            foreach ($event_list as $key1 => $event) {
                $sql = "select count(duty_id) `count`, b.event_id, c.skills_level from judge_dt_duty a "
                        . " inner join judge_lst_events b on a.event_id=b.event_id "
                        . " inner join judge_lst_judges c on a.judge_id=c.judge_id"
                        . " where c.skills_level=" . $level->level_id
                        . " and a.event_id=" . $event->event_id . " group by b.event_id, c.skills_level";
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $result[0]->season = $event->season;
                    $result[0]->event_start_date = $event->event_start_date;
                    $result[0]->event_finish_date = $event->event_finish_date;
                    array_push($duty, $result[0]);
                } else {
                    $temp = (object) ['count' => 0, 'event_id' => $event->event_id, 'season' => $event->season,
                                'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date,
                                'skills_level' => $level->skills_level];
                    array_push($duty, $temp);
                }
            }
            $level->duty = $duty;
        }

        foreach ($event_list as $key1 => $event) {
            $sql = "select count(duty_id) `count`, b.event_id from judge_dt_duty a "
                    . " inner join judge_lst_events b on a.event_id=b.event_id "
                    . " where a.event_id=" . $event->event_id . " group by b.event_id";

            $result = \DB::select($sql);
            if (sizeof($result) > 0) {
                $result[0]->season = $event->season;
                $result[0]->event_start_date = $event->event_start_date;
                $result[0]->event_finish_date = $event->event_finish_date;
                $event->total = $result[0];
            } else {
                $temp = (object) ['count' => 0, 'event_id' => $event->event_id, 'season' => $event->season,
                            'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date];
                $event->total = $temp;
            }
        }



        $event_event_list = array();
        for ($i = 0; $i < sizeof($event_season_list); $i ++) {
            $sql = "select event_name, event_start_date, event_finish_date, event_level from judge_lst_events "
                    . " where year>=" . $from_year . " and year<=" . $to_year . " and season='" . $event_season_list[$i]->season . "' "
                    . " order by season desc, event_start_Date desc, event_id";
            $event_event_list[$i] = \DB::select($sql);
        }
        return view('duty.event', compact('page_title', 'level_list', 'event_list', 'event_season_list', 'event_event_list', 'years', 'from_year', 'to_year'));
    }

    public function update() {
        $judge_id = $_REQUEST['judge_id'];
        $event_id = $_REQUEST['event_id'];
        $value = $_REQUEST['value'];

        if ($value == 'true') {
            Duty::create([
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                'judge_id' => $judge_id,
                'event_id' => $event_id,
            ]);
        } else {
            Duty::where('judge_id', '=', $judge_id)->where('event_id', '=', $event_id)->delete();
        }
        $data = ['message' => 'ok'];
        return response()->json($data);
    }

    public function export() {
        $page_title = 'LJ Duty';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $judge_list = Judge::orderBy('judge_id', 'ASC')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();

        $judge_list = json_decode(json_encode($judge_list), true);
        $event_list = json_decode(json_encode($event_list), true);

        $export_data = array();
        foreach ($judge_list as $key => $judge) {
            $data = array();
            $data['LJ Number'] = 'LJ' . ($judge['judge_id'] < 10 ? '00' . $judge['judge_id'] : ($judge['judge_id'] < 100 ? '0' . $judge['judge_id'] : $judge['judge_id']));
            $data['LJ Name'] = $judge['first_name'] . ' ' . $judge['sur_name'];
            foreach ($event_list as $key1 => $event) {
                $sql = "select * from judge_dt_duty where judge_id=" . $judge['judge_id']
                        . " and event_id=" . $event['event_id'];
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $data[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] = 'X';
                } else {
                    $data[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] = '';
                }
            }
            array_push($export_data, $data);
        }

        Excel::create('ljduty', function($excel) use($export_data) {
            $excel->sheet('Sheet 1', function($sheet) use($export_data) {
                $sheet->fromArray($export_data);
            });
        })->export('xls');
    }

    public function event_export() {
        $page_title = 'Event Report';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $level_list = Skills::orderBy('level_id', 'asc')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();

        $level_list = json_decode(json_encode($level_list), true);
        $event_list = json_decode(json_encode($event_list), true);

        $export_data = array();
        $sum_arr = array();
        $sum_arr['LJ Level'] = 'Total LJs';

        foreach ($event_list as $key1 => $event) {
            $sum_arr[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] = 0;
        }

        foreach ($level_list as $key => $level) {
            $data = array();
            $data['LJ Level'] = $level['level_name'];
            foreach ($event_list as $key1 => $event) {
                $sql = "select count(duty_id) `count`, b.event_id, c.skills_level from judge_dt_duty a "
                        . " inner join judge_lst_events b on a.event_id=b.event_id "
                        . " inner join judge_lst_judges c on a.judge_id=c.judge_id"
                        . " where c.skills_level=" . $level['level_id']
                        . " and a.event_id=" . $event['event_id'] . " group by b.event_id, c.skills_level";
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $data[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] = $result[0]->count;
                    $sum_arr[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] += $result[0]->count;
                } else {
                    $data[$event['season'] . ' ' . $event['event_number'] . ' ' . $event['event_name']] = 0;
                }
            }
            array_push($export_data, $data);
        }
        array_push($export_data, $sum_arr);

        Excel::create('event_duty', function($excel) use($export_data) {
            $excel->sheet('Sheet 1', function($sheet) use($export_data) {
                $sheet->fromArray($export_data);
            });
        })->export('xls');
    }

    public function printing() {
        $page_title = 'LJ Duty';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $judge_list = Judge::orderBy('judge_id', 'ASC')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();
        $sql = "select season from judge_lst_events where year>=" . $from_year . " and year<=" . $to_year . " group by season order by season desc";
        $event_season_list = \DB::select($sql);
        $event_level_list = array();
        $event_event_list = array();

        foreach ($judge_list as $key => $judge) {
            $duty = array();
            foreach ($event_list as $key1 => $event) {
                $sql = "select * from judge_dt_duty where judge_id=" . $judge->judge_id
                        . " and event_id=" . $event->event_id;
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $result[0]->season = $event->season;
                    $result[0]->event_level = $event->event_level;
                    $result[0]->event_start_date = $event->event_start_date;
                    $result[0]->event_finish_date = $event->event_finish_date;
                    array_push($duty, $result[0]);
                } else {
                    $temp = (object) ['judge_id' => $judge->judge_id, 'event_id' => $event->event_id, 'season' => $event->season,
                                'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date,
                                'event_level' => $event->event_level];
                    array_push($duty, $temp);
                }
            }
            $judge->duty = $duty;
        }

        $event_event_list = array();
        for ($i = 0; $i < sizeof($event_season_list); $i ++) {
            $sql = "select event_name, event_start_date, event_finish_date, event_level from judge_lst_events "
                    . " where year>=" . $from_year . " and year<=" . $to_year . " and season='" . $event_season_list[$i]->season . "' "
                    . " order by season desc, event_start_Date desc, event_id";
            $event_event_list[$i] = \DB::select($sql);
        }
        return view('duty.print', compact('page_title', 'judge_list', 'event_list', 'event_season_list', 'event_event_list', 'years', 'from_year', 'to_year'));
    }

    public function event_printing() {
        $page_title = 'Event Report';
        $from_year = Input::get('from_year');
        $to_year = Input::get('to_year');

        $sql = "select year from judge_lst_events group by year order by year";
        $years = \DB::select($sql);
        $max_key = array_search(max($years), $years);
        $min_key = array_search(min($years), $years);
        if ($from_year == null)
            $from_year = $years[$min_key]->year;
        if ($to_year == null)
            $to_year = $years[$max_key]->year;

        $level_list = Skills::orderBy('level_id', 'asc')->get();

        $judge_list = Judge::orderBy('judge_id', 'ASC')->get();
        $event_list = Event::orderBy('season', 'desc')->where('year', '>=', $from_year)->where('year', '<=', $to_year)->orderBy('event_start_date', 'desc')->orderBy('event_id', 'ASC')->get();
        $sql = "select season from judge_lst_events where year>=" . $from_year . " and year<=" . $to_year . " group by season order by season desc";
        $event_season_list = \DB::select($sql);
        $event_level_list = array();
        $event_event_list = array();

        foreach ($level_list as $key => $level) {
            $duty = array();
            foreach ($event_list as $key1 => $event) {
                $sql = "select count(duty_id) `count`, b.event_id, c.skills_level from judge_dt_duty a "
                        . " inner join judge_lst_events b on a.event_id=b.event_id "
                        . " inner join judge_lst_judges c on a.judge_id=c.judge_id"
                        . " where c.skills_level=" . $level->level_id
                        . " and a.event_id=" . $event->event_id . " group by b.event_id, c.skills_level";
                $result = \DB::select($sql);
                if (sizeof($result) > 0) {
                    $result[0]->season = $event->season;
                    $result[0]->event_start_date = $event->event_start_date;
                    $result[0]->event_finish_date = $event->event_finish_date;
                    array_push($duty, $result[0]);
                } else {
                    $temp = (object) ['count' => 0, 'event_id' => $event->event_id, 'season' => $event->season,
                                'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date,
                                'skills_level' => $level->skills_level];
                    array_push($duty, $temp);
                }
            }
            $level->duty = $duty;
        }

        foreach ($event_list as $key1 => $event) {
            $sql = "select count(duty_id) `count`, b.event_id from judge_dt_duty a "
                    . " inner join judge_lst_events b on a.event_id=b.event_id "
                    . " where a.event_id=" . $event->event_id . " group by b.event_id";

            $result = \DB::select($sql);
            if (sizeof($result) > 0) {
                $result[0]->season = $event->season;
                $result[0]->event_start_date = $event->event_start_date;
                $result[0]->event_finish_date = $event->event_finish_date;
                $event->total = $result[0];
            } else {
                $temp = (object) ['count' => 0, 'event_id' => $event->event_id, 'season' => $event->season,
                            'event_start_date' => $event->event_start_date, 'event_finish_date' => $event->event_finish_date];
                $event->total = $temp;
            }
        }

        $event_event_list = array();
        for ($i = 0; $i < sizeof($event_season_list); $i ++) {
            $sql = "select event_name, event_start_date, event_finish_date, event_level from judge_lst_events "
                    . " where year>=" . $from_year . " and year<=" . $to_year . " and season='" . $event_season_list[$i]->season . "' "
                    . " order by season desc, event_start_Date desc, event_id";
            $event_event_list[$i] = \DB::select($sql);
        }
        return view('duty.event_print', compact('page_title', 'level_list', 'event_list', 'event_season_list', 'event_event_list', 'years', 'from_year', 'to_year'));
    }

}
