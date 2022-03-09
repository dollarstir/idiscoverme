<?php

namespace App\Http\Controllers;
use App\SystemSetup;
use App\SystemSetupContact;
use App\SystemSetupEmailAddress;
use Illuminate\Http\Request;

class SystemSetupController extends ValidationRequest
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('system.setup.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $softwareName = trim(filter_var(request()->softwareName,FILTER_SANITIZE_STRING));
        $softwareShortName = trim(filter_var(request()->softwareShortName,FILTER_SANITIZE_STRING));
        $organizationName = trim(filter_var(request()->organizationName,FILTER_SANITIZE_STRING));
        $color = trim(filter_var(request()->color,FILTER_SANITIZE_STRING));
        $location = trim(filter_var(request()->location,FILTER_SANITIZE_STRING));
        $gpsaddress = trim(filter_var(request()->gpsaddress,FILTER_SANITIZE_STRING));
        $pobox = trim(filter_var(request()->pobox,FILTER_SANITIZE_STRING));
        
        if(empty($softwareName) || empty($softwareShortName) || empty($organizationName) || empty($color) || empty($location) || empty($gpsaddress) || empty($pobox))
        return response()->json(["success"=>false,"message"=>"All fields required!"]);

        $data = array(
            "id"=>$this->reg_user_id(),
            "software_name"=>$softwareName,
            "software_short_name"=>$softwareShortName,
            "organization_name"=>$organizationName,
            "color"=>$color,
            "organization_location"=>$location,
            "organization_gps_address"=>$gpsaddress,
            "organization_pobox"=>$pobox
        );
        $setup = SystemSetup::create($data);
        $this->logos($setup);
        $this->saveSystemContact($setup);
        $this ->saveSystemEmailAddress($setup);
        return response()->json(["success"=>true,"message"=>"System is ready for use!"]);
    }
    private function saveSystemContact($setup){
        foreach(request()->phone as $phone){
            $phone = preg_replace("#[^0-9]#","",$phone);
            SystemSetupContact::create(["system_setup_id"=>$setup->id,"phone_number"=>trim($phone)]);
        }
    }
    private function saveSystemEmailAddress($setup){
        $data = [];
        foreach(request()->email as $email){
            SystemSetupEmailAddress::create(["system_setup_id"=>$setup->id,"email_address"=>trim(filter_var($email,FILTER_SANITIZE_STRING))]);
        }
        
    }
    private function logos($setup){
            $homepagelogo = file_get_contents(request()->file('homepagelogo'));
            $homepagelogoBase64 = base64_encode($homepagelogo);

            $headerlogo = file_get_contents(request()->file('headerlogo'));
            $headerlogoBase64 = base64_encode($homepagelogo);

            $favicon = file_get_contents(request()->file('favicon'));
            $faviconBase64 = base64_encode($favicon);

            $organization_logo = file_get_contents(request()->file('organz_logo'));
            $organization_logoBase64 = base64_encode($organization_logo);

            $data = array(
                "homepage_logo"=>$homepagelogoBase64,
                "header_logo"=>$headerlogoBase64,
                "favicon"=>$faviconBase64,
                "organization_logo"=>$organization_logoBase64
            );
            $setup->update($data);

            if(!\File::isDirectory(public_path("/logos")))
                \File::makeDirectory(public_path("/logos"));


            $homelogo_image = str_replace('data:image/png;base64,', '', $homepagelogoBase64);
            $homelogo_image = str_replace(' ', '+', $homelogo_image);
            $homelogoimageName ='homepagelogo.jpg';
            $path = public_path("/logos/").$setup->software_short_name.'_'.$homelogoimageName;
            file_put_contents($path, base64_decode($homelogo_image));

            $organization_image = str_replace('data:image/png;base64,', '', $organization_logoBase64);
            $organization_image = str_replace(' ', '+', $organization_image);
            $organizationimageName ='organizationlogo.jpg';
            $path = public_path("/logos/").$setup->software_short_name.'_'. $organizationimageName;
            file_put_contents($path, base64_decode($organization_image));
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
