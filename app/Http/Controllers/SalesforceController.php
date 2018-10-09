<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Salesforce;
use App\User;

class SalesforceController extends Controller
{
    public function init()
    {
	$_SERVER['SF'] = parse_ini_file("sf_credentials.ini");//sf_credentials.ini
	$_SERVER['SF']['access_token'] = '';
	$access_token = User::where('id', 1)->pluck('access_token');

	if(empty($access_token[0]))
	{
		$_SERVER['SF']['access_token'] = $this->get_access_token();
			User::where('id', 1)
            ->update(['access_token' => $_SERVER['SF']['access_token']]);
	}

    $result = $this->get_record("Lead", "0123456ABCDefgh");
    $json = json_decode($result);
    $errorCode = $json[0]->errorCode;
    if($errorCode == "INVALID_SESSION_ID"){
                    $_SERVER['SF']['access_token'] = $this->get_access_token();
     	User::where('id', 1)
            ->update(['access_token' => $_SERVER['SF']['access_token']]);
    }

	}

	public function get_access_token() {
    //GET ACCESS TOKEN
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
	curl_setopt($ch, CURLOPT_URL, $_SERVER['SF']['url']."?grant_type=".$_SERVER['SF']['grant_type']."&client_id=".$_SERVER['SF']['client_id']."&client_secret=".$_SERVER['SF']['client_secret']."&username=". $_SERVER['SF']['username']."&password=".$_SERVER['SF']['password'].$_SERVER['SF']['security_token']."&format=json");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

	$result = curl_exec($ch);
	$json   = json_decode($result);
	$access_token = $json->access_token;
	curl_close($ch);
	return $access_token;
	}

	public function get_record($object_name, $id) {
		echo "<br>".$_SERVER['SF']['access_token'];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_SERVER['SF']['call_url'].$object_name."/".$id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:  OAuth ".$_SERVER['SF']['access_token'], "Authorization: Bearer token", "Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPGET, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$curl_get_response = curl_exec($ch);
		curl_close($ch);
		return $curl_get_response;
	}

	public function insert_record($object_name, $payload) {
		$data_post_string = json_encode($payload);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $_SERVER['SF']['call_url'].$object_name);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_post_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                           
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:  OAuth ".$_SERVER['SF']['access_token'], "Authorization: Bearer token", "Content-Type: application/json"));
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		$curl_post_response = curl_exec($ch);
		curl_close($ch);
		return $curl_post_response;
	}

	public function update_record($object_name, $payload, $id) {                                                                   
		$data_patch_string = json_encode($payload);
		$ch = curl_init();  
		curl_setopt($ch, CURLOPT_URL, $_SERVER['SF']['call_url'].$object_name."/".$id);  
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_patch_string);                                              
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization:  OAuth ".$_SERVER['SF']['access_token'], "Authorization: Bearer token", "Content-Type: application/json"));       
		$curl_patch_response = curl_exec($ch);
		curl_close($ch);
		return $curl_patch_response;
	}

}
