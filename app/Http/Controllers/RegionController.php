<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Region;

class RegionController extends Controller
{
    private $region;

    function __construct() {
        $this->middleware('auth');
        // $region = new Region();
    }

    public function index(){
        $page_title = 'Regions';
        $region_list = Region::all();
        return view('region.list', compact('page_title', 'region_list'));
    }

    public function create(Request $request){
        $page_title = 'Create New Region';
        return view('region.create');
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'region_name' => 'required',
            ]);
        $region = new Region();
        $region->region_name = $request->input('region_name');
        $region->region_as = $request->input('region_as');
        $region->save();
        return redirect(route('region.list'));
    }

    public function detail($region_id){
        $page_title = 'Region Detail';
        $region = Region::find($region_id);
        return view('region.detail', compact('page_title', 'region'));
    }

    public function edit($region_id){
        $page_title = 'Region Detail';
        $region = Region::find($region_id);
        return view('region.edit', compact('page_title', 'region'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'region_name' => 'required',
            'region_id' => 'required'
            ]);
        $region_id = $request->region_id;

        $region = Region::find($region_id);
        $region->region_name = $request->input('region_name');
        $region->region_as = $request->input('region_name');
        $region->save();
        return redirect(route('region.list'));
    }

    public function delete($region_id, Request $request){
        $region = Region::find($region_id)->delete();
        return redirect()->back();
    }


}
