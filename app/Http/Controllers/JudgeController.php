<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Judge;
use App\Model\Skills;
use App\Model\Country;
use App\Model\Region;
use Maatwebsite\Excel\Facades\Excel;

class JudgeController extends Controller {

    private $judge;

    function __construct() {
        $this->middleware('auth');
        $judge = new Judge();
    }

    public function index() {
        $page_title = 'Judge List';
        $sql = "select a.*, b.level_name, c.country_id, c.country_name, d.region_name from judge_lst_judges a "
                . " left join judge_lst_ljlevel b on a.skills_level=b.level_id"
                . " left join judge_countries c on a.country = c.country_id"
                . " left join judge_regions d on a.region=d.region_id order by judge_id" ;
        $judges = \DB::select($sql);
        return view('judge.list', compact('page_title', 'judges'));
    }

    public function create() {
        $page_title = "Judge Add";
        $skill_list = Skills::orderBy('level_id', 'asc')->get();
        $country_list = Country::all();
        $region_list = Region::all();
        return view('judge.create', compact('page_title', 'skill_list', 'country_list', 'region_list'));
    }

    public function createAction(Request $request) {
        // print_r($request->all());
        // exit;
        $this->validate($request, [
            'first_name' => 'required',
            'sur_name' => 'required',
        ]);
        $dob = '';
        if( $dob = $request['dob'] !=''){
            $dob = $request['dob'];
            $dob = explode('/', $dob);
            $dob = $dob[2] . '-' . $dob[1] . '-' . $dob[0];
        }
        $skills_level_achieved = '';
        if( $request['skills_level_achieved'] != ''){
            $skills_level_achieved = $request['skills_level_achieved'];
            $skills_level_achieved = explode('/', $skills_level_achieved);
            $skills_level_achieved = $skills_level_achieved[2] . '-' . $skills_level_achieved[1] . '-' . $skills_level_achieved[0];
        }   

        $membership_expiry_date = '';
        if( $request['membership_expiry_date'] != ''){
            $membership_expiry_date = $request['membership_expiry_date'];
            $membership_expiry_date = explode('/', $membership_expiry_date);
            $membership_expiry_date = $membership_expiry_date[2] . '-' . $membership_expiry_date[1] . '-' . $membership_expiry_date[0];
        }   
        
        Judge::create([
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),
            'first_name' => $request['first_name'],
            'sur_name' => $request['sur_name'],
            'email' => $request['email'],
            'dob' => $dob==''?null:$dob,
            'address_line1' => $request['address_line1'],
            'address_line2' => $request['address_line2'],
            'address_line3' => $request['address_line3'],
            'city' => $request['city'],
            'post_code' => $request['post_code'],
            'country' => $request['country'],
            'region' => $request['region'],
            'home_phone' => $request['home_phone'],
            'mobile_phone' => $request['mobile_phone'],
            'skills_level' => $request['skills_level'],
            'skills_level_achieved' => $skills_level_achieved==''?null:$skills_level_achieved,
            'membership_expiry_date' => $membership_expiry_date==''?null:$membership_expiry_date,
            'membership_paid_up' => $request['membership_paid_up'],
            'member_ship' => $request['member_ship'],
            'active'=>$request['active'],
        ]);
        return redirect()->back();
    }

    public function detail($id) {
        $page_title = 'Judge Detail';
        $sql = "select a.*, b.level_name, c.country_id, c.country_name, d.region_name from judge_lst_judges a "
                . " left join judge_lst_ljlevel b on a.skills_level=b.level_id "
                . " left join judge_countries c on a.country=c.country_id"
                . " left join judge_regions d on a.region=d.region_id"
                . " where judge_id=" . $id;
        $judge = \DB::select($sql)[0];
        return view('judge.detail', compact('page_title', 'judge'));
    }

    public function edit($id) {
        $skill_list = Skills::orderBy('level_id', 'asc')->get();
        $page_title = 'Judge Edit';
        $judge = Judge::find($id);
        $country_list = Country::all();
        $region_list = Region::all();
        return view('judge.edit', compact('page_title', 'judge', 'skill_list', 'country_list', 'region_list'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'first_name' => 'required',
            'sur_name' => 'required',
        ]);
        
        $dob = '';
        if( $dob = $request['dob'] !=''){
            $dob = $request['dob'];
            $dob = explode('/', $dob);
            $dob = $dob[2] . '-' . $dob[1] . '-' . $dob[0];
        }
        $skills_level_achieved = '';
        if( $request['skills_level_achieved'] != ''){
            $skills_level_achieved = $request['skills_level_achieved'];
            $skills_level_achieved = explode('/', $skills_level_achieved);
            $skills_level_achieved = $skills_level_achieved[2] . '-' . $skills_level_achieved[1] . '-' . $skills_level_achieved[0];
        }  

        $membership_expiry_date = '';
        if( $request['membership_expiry_date'] != ''){
            $membership_expiry_date = $request['membership_expiry_date'];
            $membership_expiry_date = explode('/', $membership_expiry_date);
            $membership_expiry_date = $membership_expiry_date[2] . '-' . $membership_expiry_date[1] . '-' . $membership_expiry_date[0];
        } 

        $judge = Judge::find($request['judge_id']);
        $judge->updated_at = \Carbon\Carbon::now();
        $judge->first_name = $request['first_name'];
        $judge->sur_name = $request['sur_name'];
        $judge->email = $request['email'];
        $judge->dob = $dob==''?null:$dob;
        $judge->address_line1 = $request['address_line1'];
        $judge->address_line2 = $request['address_line2'];
        $judge->address_line3 = $request['address_line3'];
        $judge->city = $request['city'];
        $judge->post_code = $request['post_code'];
        $judge->country = $request['country'];
        $judge->region = $request['region'];
        $judge->home_phone = $request['home_phone'];
        $judge->mobile_phone = $request['mobile_phone'];
        $judge->skills_level = $request['skills_level'];
        $judge->skills_level_achieved = $skills_level_achieved==''?null:$skills_level_achieved;
        $judge->membership_expiry_date = $membership_expiry_date==''?null:$membership_expiry_date;
        $judge->member_ship = $request['member_ship'];
        $judge->membership_paid_up = $request['membership_paid_up'];
        $judge->active = $request['active'];
        $judge->update();
        return redirect()->back();
    }

    public function delete($id) {
        $judge = Judge::find($id)->delete();
        return redirect()->back();
    }

    public function export() {
        $sql = "select a.*, b.level_name, c.country_name, skills_level, d.region_name from judge_lst_judges a "
                . " left join judge_lst_ljlevel b on a.skills_level=b.level_id"
                . " left join judge_countries c on a.country=c.country_id"
                . " left join judge_regions d on d.region=d.region_id order by judge_id";
        $export_data = \DB::select($sql);
        foreach ($export_data as $data) {
            $data->judge_id = 'LJ' . ($data->judge_id < 10 ? '00' . $data->judge_id : ($data->judge_id < 100 ? '0' . $data->judge_id : $data->judge_id));
            unset($data->member_ship);
            unset($data->country);
        }
        $export_data = json_decode(json_encode($export_data), true);

        Excel::create('judge', function($excel) use($export_data) {
            $excel->sheet('Sheet 1', function($sheet) use($export_data) {
                $sheet->fromArray($export_data);
            });
        })->export('xls');
    }

    public function printing() {
        $page_title = 'Judge List';
        $judges = Judge::all();
        return view('judge.print', compact('page_title', 'judges'));
    }

    public function active($id, $isactive){
        $judge = Judge::find($id);
        $judge->active = $isactive;
        $judge->update();
        return redirect()->back();
    }

    public function membership_paid_up($id, $ispaid){
        $judge = Judge::find($id);
        $judge->membership_paid_up = $ispaid;
        $judge->update();
        return redirect()->back();
    }

}
