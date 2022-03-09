<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\SystemSetup;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class ClientsController extends ValidationRequest
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $setup = SystemSetup::take(1)->get()->first();
        $clients = Client::all();
        $clientrecord=true;
        return view('clients.index',compact('clients','clientrecord','setup'));
    }

    public function client_list(){
        $clients = Client::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$clients);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $setup = SystemSetup::take(1)->get()->first();
        return view('clients.create',compact('setup'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create($this ->save_basic_information());
        return response()->json(["success"=>true,"message"=>"Successfully registered new client!"]);
    }
    private function save_basic_information(){
        $id = $this->reg_user_id();
        return array(
            "id"=>$id,
            "firstName"=>trim(filter_var(request()->firstname,FILTER_SANITIZE_STRING)),
            "middleName"=>trim(filter_var(request()->midllename,FILTER_SANITIZE_STRING)),
            "lastName"=>trim(filter_var(request()->lastname,FILTER_SANITIZE_STRING)),
            "gender"=>trim(request()->gender),
            "password"=>Hash::make($id)
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
