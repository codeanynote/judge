<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Skills;

class SkillController extends Controller
{   
    private $country;

    function __construct() {
        $this->middleware('auth');
        // $country = new Country();
    }

    public function index(){
        $page_title = 'Skill Levels';
        $skill_list = Skills::all();
        return view('skill.list', compact('page_title', 'skill_list'));
    }

    public function create(Request $request){
        $page_title = 'Create New Skill Level';
        return view('skill.create');
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'level_name' => 'required',
            ]);
        $skill = new Skills();
        $skill->level_name = $request->input('level_name');
        $skill->level_as = $request->input('level_name');
        $skill->save();
        return redirect(route('skill.list'));
    }

    public function detail($level_id){
        $page_title = 'Skill Level Detail';
        $skill = Skills::find($level_id);
        return view('skill.detail', compact('page_title', 'skill'));
    }

    public function edit($level_id){
        $page_title = 'Skill Level Detail';
        $skill = Skills::find($level_id);
        return view('skill.edit', compact('page_title', 'skill'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'level_name' => 'required',
            'level_id' => 'required'
            ]);
        $level_id = $request->level_id;

        $skill = Skills::find($level_id);
        $skill->level_name = $request->input('level_name');
        $skill->level_as = $request->input('level_name');
        $skill->save();
        return redirect(route('skill.list'));
    }

    public function delete($level_id, Request $request){
        $skill = Skills::find($level_id)->delete();
        return redirect()->back();
    }
}
