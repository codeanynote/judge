<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Country;

class CountryController extends Controller
{
    private $country;

    function __construct() {
        $this->middleware('auth');
        // $country = new Country();
    }

    public function index(){
        $page_title = 'Countries';
        $country_list = Country::all();
        return view('country.list', compact('page_title', 'country_list'));
    }

    public function create(Request $request){
        $page_title = 'Create New Country';
        return view('country.create');
    }
    
    public function save(Request $request){
        $this->validate($request, [
            'country_name' => 'required',
            ]);
        $country = new Country();
        $country->country_name = $request->input('country_name');
        $country->country_as = $request->input('country_as');
        $country->save();
        return redirect(route('country.list'));
    }

    public function detail($country_id){
        $page_title = 'Country Detail';
        $country = Country::find($country_id);
        return view('country.detail', compact('page_title', 'country'));
    }

    public function edit($country_id){
        $page_title = 'Country Detail';
        $country = Country::find($country_id);
        return view('country.edit', compact('page_title', 'country'));
    }
    
    public function update(Request $request){
        $this->validate($request, [
            'country_name' => 'required',
            'country_id' => 'required'
            ]);
        $country_id = $request->country_id;

        $country = Country::find($country_id);
        $country->country_name = $request->input('country_name');
        $country->country_as = $request->input('country_name');
        $country->save();
        return redirect(route('country.list'));
    }

    public function delete($country_id, Request $request){
        $country = Country::find($country_id)->delete();
        return redirect()->back();
    }


}
