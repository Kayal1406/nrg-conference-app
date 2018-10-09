<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Apply;
use Excel;
use Input;
use DB;
use App\Leads;
use Storage;
use Response;
use File;
use Validator;
use Cookie;
use App\StandardUser;
use Crypt;
use Mail;
use Redirect;
use App\User;

class ImportExportController extends Controller
{
    public function attendeeDownload($id)
	{
		$apply  = Apply::select('firstname','lastname', 'email', 'mngemail')->where('conferenceid', $id)->where('status_m', 'Approved')->orderBy('created_date', 'desc')->get()->toArray();
		if(empty($apply))
		{
			return Redirect::back()->with('danger','No data to download');
		}
		else
		{
		return Excel::create('Attendee_List', function($excel) use ($apply) {
			$excel->sheet('Mysheet', function($sheet) use ($apply)
	        {
				$sheet->fromArray($apply);
	        });
		})->download();
		}
	}

	public function leadsDownload($id)
	{
		$leads  = Leads::select('company','firstname','lastname','title', 'email')->where('conferenceid', $id)->orderBy('created_date', 'desc')->get()->toArray();
		if(empty($leads))
		{
			return Redirect::back()->with('danger','No data to download');
		}
		else
		{
		return Excel::create('Leads_List', function($excel) use ($leads) {
			$excel->sheet('Mysheet', function($sheet) use ($leads)
	        {
				$sheet->fromArray($leads);
	        });
		})->download();
		}
	}

	public function importLeads(Request $request, $id)
	{
		switch (Input::get('doctype')) {
            case 'potential_leads':
            $rules = array(
				'import_leads' => 'mimes:csv,xls,xlsx',
			);

			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails()) 
			{
				return back()->with('danger', 'File format not valid');
			}
			else 
			{
				$conferenceid = $request->input('conferenceid');
					if(Input::hasFile('import_leads')){
						$path = Input::file('import_leads')->getRealPath();
						$data = Excel::load($path, function($reader) {
						})->get();
						unset($data[0]); 
						$totalRows = $data->count();
						$lead_not_inserted[] = "";
						$uninserted_lead = "";
						if($totalRows <= 200){
							$user_id = Cookie::get('uid');
							$conferenceid = $request->input('conferenceid');
							if(!empty($data) && $data->count()){
								foreach ($data as $key => $value) {
									$lead[] = ['user_id' => $user_id,
												'conferenceid' => $conferenceid, 
												'firstname' => $value->firstname, 
												'lastname' => $value->lastname, 
												'title' => $value->title,
												'company' => $value->company,
												'email' => $value->email, 
												'phone' => $value->phone,
												'notes' => $value->notes];
									$emails = Leads::where('conferenceid', $conferenceid)->pluck('email')->toArray();
									if (in_array($value->email, $emails))
									{
										$lead_not_inserted[] = $value->firstname;
									}
									else{
										$create_leads = Leads::create([
														'user_id' => $user_id,
														'conferenceid' => $conferenceid, 
														'firstname' => $value->firstname, 
														'lastname' => $value->lastname, 
														'title' => $value->title,
														'company' => $value->company,
														'email' => $value->email, 
														'phone' => $value->phone,
														'notes' => $value->notes
													]);
										// app('App\Http\Controllers\SalesforceController')->init();
										// $salesforce_response =  app('App\Http\Controllers\SalesforceController')
										// 				->insert_record("Lead", array("firstname" => $value->firstname,
										// 						"lastname" => $value->lastname,
										// 						"email" => $value->email,
										// 						"company" => $value->company,
										// 						"status" => "Open"));
										// $salesforce_json = json_decode($salesforce_response);
										// $test = Leads::where('id', $create_leads->id)->update(['salesforce_id' => $salesforce_json->id]);
									}
								}
								unset( $lead_not_inserted[array_search('', $lead_not_inserted)]);
								if(count($data) == count($lead_not_inserted)){
									return back()->with('danger', 'Lead Already Inserted!');
								}
								elseif(empty($lead_not_inserted))
								{
									return back()->with('success', 'Leads Imported Successfully!');
								}
								else
								{
									$uninserted_lead = implode(',', $lead_not_inserted);
									return back()->with('info', 'Leads named "'.$uninserted_lead.'" has been already inserted. Other leads are inserted successfully');
								}
							}
					    }
						else
						{
							return back()->with('danger', 'Can insert only 200 at a stretch!');
						}
					}

				}
                break;
                
                case 'attendees_list':
                $rules = array(
				            'import_leads' => 'mimes:csv,xls,xlsx',
				        );

				        $validator = Validator::make($request->all(), $rules);
				        if ($validator->fails()) 
				        {
				            return back()->with('danger', 'File format not valid');
				        }
				        else 
				        {
						$conferenceid = $request->input('conferenceid');
                        $emails = Apply::where('conferenceid', $conferenceid)->pluck('email')->toArray();
						if(Input::hasFile('import_leads')){
							$path = Input::file('import_leads')->getRealPath();
							$data = Excel::load($path, function($reader) {
							})->get();
							unset($data[0]); 
							$conferenceid = $request->input('conferenceid');
							$user_id = Cookie::get('uid');

							if(!empty($data) && $data->count()){
								foreach ($data as $key => $value) {
									if (in_array($value->email, $emails)){
											$emails[] = $value->email;
											return back()->with('danger', 'Attendees already inserted');	
										}
									else		
									{

										$conf_start = date("Y-m-d", strtotime($value->confstart));
										$conf_end = date("Y-m-d", strtotime($value->confend));
										$travel_start = date("Y-m-d", strtotime($value->travelstart));
										$travel_end = date("Y-m-d", strtotime($value->travelend));
										$insert = ['conferenceid' => $conferenceid,
												'user_id' => $user_id,
											   'firstname' => $value->firstname,
												'lastname' => $value->lastname,
												'phone' => $value->phone,
												'another_phone' => $value->another_phone,
												'email' => $value->email,
												'another_email' => $value->another_email,
												'mngemail' => $value->mngemail,
												'confname' => $value->confname,
												'confstart' => $conf_start,
												'confend' => $conf_end,
												'confurl' => $value->confurl,
												'travelstart' => $travel_start,
												'travelend' => $travel_end,
												'conf_frequency' => $value->conf_frequency,
												'conf_cost' => $value->conf_cost,
												'travel_cost' => $value->travel_cost,
												'conf_location' => $value->conf_location,
												'conf_city' => $value->conf_city,
												'attendees_travelling' => $value->attendees_travelling,
												'description' => $value->description,
												'deliverables' => $value->deliverables,
												'role' => $value->role,
												'sponsoring_cost' => $value->sponsoring_cost,
												'business' => $value->business,
												'benefits' => $value->benefits,
												'industry' => $value->industry,
												'audience' => $value->audience
												];

										$email = StandardUser::where('useremail', $value->email)->value('useremail');
										$firstname = StandardUser::where('useremail', $value->email)->value('firstname');
										$lastname = StandardUser::where('useremail', $value->email)->value('lastname');
										$manageremail = StandardUser::where('useremail', $value->email)->value('manager_email');

										if($manageremail == "" || $email == ""){
											$standarduser = StandardUser::insert(['useremail' => $value->email,'firstname' => $value->firstname, 'lastname' => $value->lastname,'manager_firstname' => $value->mngfirstname, 'manager_lastname' => $value->mnglastname, 'manager_email' => $value->mngemail]);     
											$firstname = StandardUser::where('useremail', $value->email)->value('firstname');
											$lastname = StandardUser::where('useremail', $value->email)->value('lastname');
											$manageremail = StandardUser::where('useremail', $value->email)->value('manager_email');
											$email = StandardUser::where('useremail', $value->email)->value('useremail');
										}
								        $return = Apply::create($insert);
								        $data = json_decode($return, true);

								        $encrypt = $return->id;
								        $encrypted = Crypt::encryptString($encrypt);
								        DB::table('apply')
								            ->where('id', $encrypt)
								            ->update(['link' => $encrypted]);

								        $managerfirstname = $value->mngfirstname;
								        $managerlastname = $value->mnglastname;
								        $manageremail = $value->mngemail;

								        $returnone = Apply::find($encrypt);
								        $dataone = json_decode($returnone, true); 

								        $conferenceid = $dataone['conferenceid'];
								        $attendees = Apply::where('conferenceid', $conferenceid)->where('id', '!=', $encrypt)->where('status_m', 'Approved')->orderBy('created_date', 'desc')->get();
								        $attendeesone = json_decode($attendees, true);
										$email = User::where('id', 1)->value('email');

								        $data = array('formdata' => $dataone, 'participants' => $attendeesone, 'email' => $email);

								        Mail::send('emails.appliedconference', $data, function($message) use ($data){
								            $message->from($data['formdata']['email']);
								            $message->to($data['email']);
								            $message->subject('New Request to Attend Submission');
								        });
									}	
								}				
								return back()->with('success', 'Thanks! Attendees has been inserted succesfully!');									
								}
							}	
						}						
                    break;
                    case 'other_docs':
	                    $rules = array(
				            'import_leads' => 'mimes:doc,docx,pdf,csv,xls,xlsx',
				        );

				        $validator = Validator::make($request->all(), $rules);
				        if ($validator->fails()) 
				        {
				            return back()->with('danger', 'File format not valid');
				        }
				        else 
				        {
						    if($file=$request->hasFile('import_leads')) {
						        $file=$request->file('import_leads');
						        $fileName=$file->getClientOriginalName();
						        if (!file_exists('uploads/'.$id.'')) {
    								mkdir('uploads/'.$id.'', 0777, true);
								}
						        $destinationPath='uploads/'.$id.'';
						        $file->move($destinationPath,$fileName);
						        return back()->with('success', 'File uploaded successfully.');
						        }
							}
						}		
				}
}