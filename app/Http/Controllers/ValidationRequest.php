<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ValidationRequest extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function generateID(){
        $staffID = $this ->reg_rand();
        return $staffID;
	}
    protected function reg_user_id(){
		$digits_need = 6;
		$random_number = '';//set up a blank string
		$count = 0;
		$date = date('mdms',time());
		while($count < $digits_need){
			$random_digits = mt_rand(100000,999999);
			$random_number = $random_digits;
			$count++;
		}
		return "$random_number";
    }
    protected function reg_rand(){
		$digits_need = 6;
		$random_number = '';//set up a blank string
		$count = 0;
		$date = date('mdms',time());
		while($count < $digits_need){
			$random_digits = mt_rand(100000,999999);
			$random_number = $random_digits;
			$count++;
		}
		return "$random_number$date";
	}

	public function getInstitutionInitials($institution){
		$explode = explode("-",$institution);
		if(isset($explode[0]))
		return $explode[0];

		return null;
	}

	protected function filter_var($date){
		$date = explode("",$date);
		if(count($date))
			return $date[2]."-".$date[1]."-".$date[0];
		return "";
	}

	protected function filter_institution($institution_id){
        $explode = explode("-",$institution_id);
        return $explode[0];
    }
}
