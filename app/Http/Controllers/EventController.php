<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Model\Event;
use App\Model\Judge;
use App\Model\Duty;
use App\Model\EventLevel;
use Maatwebsite\Excel\Facades\Excel;

class EventController extends Controller {

    private $event;

    function __construct() {
        $this->middleware('auth');
        $event = new Event();
    }

    public function index() {
        $page_title = 'Event List';
        $events = Event::all();
        return view('event.list', compact('page_title', 'events'));
    }

    public function create() {
        $page_title = "Add a new Event";
        $event_level_list = EventLevel::all();
        $judges = Judge::orderBy('judge_id', 'asc')->get();
        foreach ($judges as $judge) {
            $judge->lj_number = 'LJ' . ($judge->judge_id < 10 ? '00' . $judge->judge_id : ($judge->judge_id >= 10 && $judge->judge_id < 100 ? '0' . $judge->judge_id : $judge->judge_id));
        }
        return view('event.create', compact('page_title', 'event_level_list', 'judges'));
    }

    public function createAction(Request $request) {
        $this->validate($request, [
            'event_name' => 'required',
            'season' => 'required',
            'event_start_date' => 'required',
            'event_finish_date' => 'required',
            'event_manager' => 'required',
            'event_deputy_mgr' => 'required',
            'lead_assessor' => 'required'
        ]);
        $sql = "select max(event_number) max_num from judge_lst_events where year='" . $request['year'] . "'";
        $result = \DB::select($sql);
        $max_num = (int) ($result[0]->max_num);
        if (sizeof($result) > 0 && $max_num != null) {
            $max_num++;
        } else {
            $max_num = 1;
        }
        $event_number = '001';
        if ($max_num < 10)
            $event_number = '00' . $max_num;
        else if ($max_num >= 10 && $max_num < 100)
            $event_number = '0' . $max_num;
        else if ($max_num > 100)
            $event_number = $max_num;

//exit($event_number.'fdfdasfsd');

        $event_start_date = $request['event_start_date'];
        $event_start_date = explode('/', $event_start_date);
        $event_start_date = $event_start_date[2] . '-' . $event_start_date[1] . '-' . $event_start_date[0];

        $event_finish_date = $request['event_finish_date'];
        $event_finish_date = explode('/', $event_finish_date);
        $event_finish_date = $event_finish_date[2] . '-' . $event_finish_date[1] . '-' . $event_finish_date[0];

        Event::create([
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'event_name' => $request['event_name'],
            'event_number' => $event_number,
            'year' => $request['year'],
            'season' => $request['season'],
            'event_start_date' => $event_start_date,
            'event_finish_date' => $event_finish_date,
            'event_level' => $request['event_level'],
            'event_in_uk' => $request['event_in_uk'],
            'event_manager' => $request['event_manager'],
            'event_deputy_mgr' => $request['event_deputy_mgr'],
            'lead_assessor' => $request['lead_assessor']
        ]);
        if ($request['toinfo'])
            return redirect(route('event.ljinfo'));

        return redirect()->back();
    }

    public function detail($id) {
        $page_title = 'Event Detail';
        $event = Event::find($id);
        return view('event.detail', compact('page_title', 'event'));
    }

    public function edit($id) {
        $page_title = 'Event Edit';
        $event = Event::find($id);
        $event_level_list = EventLevel::all();
        return view('event.edit', compact('page_title', 'event', 'event_level_list'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'event_name' => 'required',
            'season' => 'required',
            'event_start_date' => 'required',
            'event_finish_date' => 'required',
        ]);

        $event_start_date = $request['event_start_date'];
        $event_start_date = explode('/', $event_start_date);
        $event_start_date = $event_start_date[2] . '-' . $event_start_date[1] . '-' . $event_start_date[0];

        $event_finish_date = $request['event_finish_date'];
        $event_finish_date = explode('/', $event_finish_date);
        $event_finish_date = $event_finish_date[2] . '-' . $event_finish_date[1] . '-' . $event_finish_date[0];


        $event = Event::find($request['event_id']);
        $event->updated_at = \Carbon\Carbon::now();
        $event->event_name = $request['event_name'];
        $event->year = $request['year'];
        $event->season = $request['season'];
        $event->event_start_date = $event_start_date;
        $event->event_finish_date = $event_finish_date;
        $event->event_level = $request['event_level'];
        $event->event_in_uk = $request['event_in_uk'];
        $event->update();
        return redirect()->back();
    }

    public function delete($id) {
        $event = Event::find($id)->delete();
        return redirect()->back();
    }

    public function export() {

        $export_data = Event::orderBy('season', 'ASC')->orderBy('event_level', 'ASC')->orderBy('event_id', 'ASC')->get();

        foreach ($export_data as $data) {
            $data->event_number = 'E' . substr($data->year, 2) . $data->event_number;
            unset($data->event_id);
        }

        $export_data = json_decode(json_encode($export_data), true);

        Excel::create('event', function($excel) use($export_data) {
            $excel->sheet('Sheet 1', function($sheet) use($export_data) {
                $sheet->fromArray($export_data);
            });
        })->export('xls');
    }

    public function printing() {
        $page_title = 'Event List';
        $events = Event::all();
        return view('event.print', compact('page_title', 'events'));
    }

    public function ljInformation() {
        $page_title = "Add Line Judges to Events";
        $events = Event::orderBy('event_id', 'asc')->get();
        $judges = Judge::orderBy('judge_id', 'asc')->get();
        foreach ($judges as $judge) {
            $judge->lj_number = 'LJ' . ($judge->judge_id < 10 ? '00' . $judge->judge_id : ($judge->judge_id >= 10 && $judge->judge_id < 100 ? '0' . $judge->judge_id : $judge->judge_id));
        }
        return view('event.ljinfo', compact('page_title', 'events', 'judges'));
    }

    public function getLjInfo() {
        $event_id = Input::get('event_id');
        $page_title = "LJ Information";
        $sql = "select a.*, DATE_FORMAT(a.start_date, '%d/%m/%Y') start_date, DATE_FORMAT(a.finish_date, '%d/%m/%Y') finish_date, b.* from judge_dt_duty a "
                . " inner join judge_lst_judges b on a.judge_id=b.judge_id "
                . " where a.event_id=" . $event_id.' order by a.judge_id';
        $dutys = \DB::select($sql);
        return response()->json($dutys);
    }

    public function ljinformationUpdate(Request $request) {

        $event_id = $request['event_id'];
        Duty::where('event_id', '=', $event_id)->delete();

        for ($i = 0; $i < 12; $i++) {
            if ($request['judge_id'][$i] != null) {
                $judge_id = $request['judge_id'][$i];

                $start_date = null;
                if ($request['start_date'][$i] != null) {
                    $start_date = $request['start_date'][$i];
                    $start_date = explode('/', $start_date);
                    $start_date = $start_date[2] . '-' . $start_date[1] . '-' . $start_date[0];
                }

                $finish_date = null;
                if ($request['finish_date'][$i] != null) {
                    $finish_date = $request['finish_date'][$i];
                    $finish_date = explode('/', $finish_date);
                    $finish_date = $finish_date[2] . '-' . $finish_date[1] . '-' . $finish_date[0];
                }

                Duty::create([
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now(),
                    'event_id' => $event_id,
                    'judge_id' => $judge_id,
                    'start_date' => $start_date,
                    'finish_date' => $finish_date,
                ]);
            }
        }

        return redirect()->back()->withErrors(['All LJ Information has been Saved']);;
    }

}
