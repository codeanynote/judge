<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\EventLevel;

class EventLevelController extends Controller
{

    function __construct() {
        $this->middleware('auth');
    }

    public function index(){
        $page_title = 'Event Levels';
        $event_level_list = EventLevel::all();
        return view('event_level.list', compact('page_title', 'event_level_list'));
    }

    public function create(Request $request){
        $page_title = 'Create New Event Level';
        return view('event_level.create');
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'event_level_name' => 'required',
            ]);
        $event_level = new EventLevel();
        $event_level->event_level_name = $request->input('event_level_name');
        $event_level->event_level_as = $request->input('event_level_as');
        $event_level->save();
        return redirect(route('event_level.list'));
    }

    public function detail($event_level_id){
        $page_title = 'Event Level Detail';
        $event_level = EventLevel::find($event_level_id);
        return view('event_level.detail', compact('page_title', 'event_level'));
    }

    public function edit($event_level_id){
        $page_title = 'Event Level Detail';
        $event_level = EventLevel::find($event_level_id);
        return view('event_level.edit', compact('page_title', 'event_level'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'event_level_name' => 'required',
            'event_level_id' => 'required'
            ]);
        $event_level_id = $request->event_level_id;

        $event_level = EventLevel::find($event_level_id);
        $event_level->event_level_name = $request->input('event_level_name');
        $event_level->event_level_as = $request->input('event_level_name');
        $event_level->save();
        return redirect(route('event_level.list'));
    }

    public function delete($event_level_id, Request $request){
        $event_level = EventLevel::find($event_level_id)->delete();
        return redirect()->back();
    }


}
