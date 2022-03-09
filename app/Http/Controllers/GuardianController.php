<?php

namespace App\Http\Controllers;
use App\SystemSetup;
use App\Guardian;
use App\MemberGuardian;
use App\Member;
use Illuminate\Http\Request;

class GuardianController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $guardianrecords = true;
        $setup = SystemSetup::take(1)->get()->first();
        return view('guardians.index',compact('guardianrecords','setup'));
    }

    public function list(){
        $guardians = Guardian::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$guardians);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Guardian $guardian)
    {
        $setup = SystemSetup::take(1)->get()->first();
        $guardianprofilerecord=true;
        return view('guardians.profile',compact('setup','guardian','guardianprofilerecord'));
    }

    public function wards(Guardian $guardian){
        $members = Member::whereIn("member_id",$this->get_wards($guardian->id))->get();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$members);
    }

    private function get_wards($guardian_id){
        $data=[];
        $wards = MemberGuardian::where("guardian_id",$guardian_id)->get();
        foreach($wards as $ward){
            $data[]=$ward->member_member_id;
        }
        return $data;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Guardian $guardian)
    {
        $fullname = trim(addslashes(request()->fullname));
        if(empty($fullname))
            return response()->json(["success"=>false,"message"=>"Please enter full name!"]);
        $guardian->update(["fullName"=>$fullname]);
        return response()->json(["success"=>true,"message"=>"Successfully updated profile!"]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
