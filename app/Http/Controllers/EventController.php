<?php

namespace App\Http\Controllers;
use App\SystemSetup;
use App\EventType;
use App\Event;
use App\User;
use Auth;
use Illuminate\Http\Request;

class EventController extends ValidationRequest
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        if(User::count())
        $this->middleware('auth');
    }
    public function index()
    {
        $setup = SystemSetup::take(1)->get()->first();
        $eventrecords = true;
        return view("events.index",compact("setup","eventrecords"));
    }

    public function types(){
        $setup = SystemSetup::take(1)->get()->first();
        $eventtypesrecords = true;
        return view("events.types.index",compact("setup","eventtypesrecords"));
    }

    public function eventlist(){
        $events = Event::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$events);
    }
    public function eventtypelist(){
        $eventtypes = EventType::all();
        return array("response"=>true,"recordsTotal"=> 57,"recordsFiltered"=> 57,"data"=>$eventtypes);
    }

    public function createeventtype(){
        $setup = SystemSetup::take(1)->get()->first();
        return view("events.types.create",compact("setup"));
    }

    public function addeventtype(){
        $name = trim(addslashes(request()->name));
        $color = trim(addslashes(request()->color));

        if(empty($name) || empty($color))
            return response()->json(["success"=>false,"message"=>"All field required!"]);

        if(EventType::where("name",$name)->get()->count())
            return response()->json(["success"=>false,"message"=>"$name already exists!"]);

        EventType::create(["name"=>$name,"color"=>$color]);
        return response()->json(["success"=>true,"message"=>"Successfully added $name"]);
    }

    public function updateeventtype(EventType $eventtype){
        $name = trim(addslashes(request()->name));
        if(EventType::where("name",$name)->get()->count())
            return response()->json(["success"=>false,"message"=>"$name already exists!"]);

        $eventtype ->update(["name"=>$name]);
        return response()->json(["success"=>true,"message"=>"Successfully updated event type!"]);
    }

    public function deleteeventtype(EventType $eventtype){
        $eventtype->delete();
        return response()->json(["success"=>true,"message"=>"Successfully deleted event type!"]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventtypes = EventType::all();
        $setup = SystemSetup::take(1)->get()->first();
        return view("events.create",compact("setup","eventtypes"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event_name = trim(addslashes(request()->name));
        $event_description = trim(addslashes(request()->desc));
        $privacy = preg_replace("#[^0-9]#","",request()->privacy);
        $start_date = preg_replace("#[^0-9-]#","",request()->start_at);
        $start_time = preg_replace("#[^0-9:]#","",request()->start_time);
        $end_date = preg_replace("#[^0-9-]#","",request()->end_at);
        $end_time = preg_replace("#[^0-9:]#","",request()->end_time);

        $start_datetime = "$start_date $start_time";
        $end_datetime = "$end_date $end_time";

        if(empty($event_name) || empty($event_description) || empty($start_date) || empty($start_time) || empty($end_date) || empty($end_time))
        return response()->json(["success"=>false,"message"=>"All fields required!"]);

        
        if(Event::where(["name"=>$event_name,"privacy"=>$privacy,"user_id"=>Auth::user()->id])->get()->count())
            return response()->json(["success"=>false,"message"=>"$event_name already exists!"]);
        

        $event = Event::create(["id"=>$this ->reg_user_id(),"user_id"=>Auth::user()->id,"name"=>$event_name,"Description"=>$event_description,"start_at"=>$start_datetime,"end_at"=>$end_datetime,"privacy"=>$privacy]);
        return response()->json(["success"=>true,"message"=>"Successfully added event","evtid"=>$event->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $setup = SystemSetup::take(1)->get()->first();
        return view("events.detail",compact("setup","event"));
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
