<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conference;
use App\Feedback;
use App\Apply;
use Excel;
use DB;
use Mail;
use Carbon\Carbon; 
use Response;
use File;
use Datatables;
use Crypt;
use App\Notes;
use App\Survey;
use App\StandardUser;
use App\SponsorshipSurvey;
use App\Leads;
use Validator;
use App\Salesforce;
use Cookie;
use Input;
use Auth;

class SurveyController extends Controller
{
    public function postSurvey($id)
    {
        $uid = Cookie::get('uid');
        $conference = Conference::where('id', $id)->first();
        $active_conferences = Apply::select('apply.conferenceid','apply.confstart','apply.confend','conference.conferencename','conference.description','conference.conferenceurl')
            ->join('conference','apply.conferenceid','=','conference.id')
            ->where('apply.status_m', 'Approved')->where('apply.user_id', $uid)->where('apply.is_delete', '0')->where('apply.confend', '>', Carbon::now())
            ->orderBy('apply.created_date', 'desc')
            ->get();
        $conferencename = Conference::where('id', $id)->value('conferencename');
        $active_conferences->map(function ($active) {
            $uid = Cookie::get('uid');
            $survey_result = Survey::where('conferenceid', $active->conferenceid)->where('user_id', $uid)->first();
            if(!empty($survey_result)){
                $active['results'] = $survey_result->recommend;
            }
            else{
                $active['results'] = "";
            }
            $earliestStart = Apply::where('conferenceid', $active->conferenceid)
                            ->where('is_delete', '0')
                            ->where('status_m', 'Approved')
                            ->orderBy('confstart', 'asc')
                            ->first();
            $lastEnd = Apply::where('conferenceid', $active->conferenceid)
                            ->where('is_delete', '0')
                            ->where('status_m', 'Approved')
                            ->orderBy('confend', 'desc')
                            ->first();
            $start_date = date("d-m-Y", strtotime($earliestStart->confstart));
            $end_date = date("d-m-Y", strtotime($lastEnd->confend));
            $active['conference_dates'] = $start_date.' to '.$end_date;
        });
        if (!file_exists('uploads/'.$id.'')) {
        }
        else
        {
        $documents = scandir('uploads/'.$id);
            unset( $documents[array_search('.', $documents)]);
            unset( $documents[array_search('..', $documents)]);
        }
        $pastlastyear = date('Y') - 2;
        $lastyear = date('Y') - 1;
        $conference_cost = Conference::where('id', $id)->value('conference_cost');
        $travel_cost = Conference::where('id', $id)->value('travel_cost');
        return view('survey', compact('active_conferences', 'conference_cost', 'travel_cost','documents', 'conference', 'conferencename', 'lastyear', 'pastlastyear'));
    }

    public function postSurveyForm(Request $request){
        if(Input::hasFile('documents_feedback')){
            $doc = $request->documents_feedback;
            $docPath = 'uploads/'.$request->conferenceid;
            File::makeDirectory($docPath, $mode = 0777, true, true);
                $docDestinationPath = $docPath.'/'; 
                $filename = $doc->getClientOriginalName();
                $ext1 = $doc->getClientOriginalExtension();
                $success = $doc->move($docDestinationPath, $filename);
        }

        $leads_emails = Leads::pluck('email')->toArray();
        if(Input::hasFile('leads_list_feedback')){
            $path = Input::file('leads_list_feedback')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            unset($data[0]); 
            $totalRows = $data->count();

            if($totalRows <= 200){
            $user_id = Cookie::get('uid');
            $conferenceid = $request->input('conferenceid');
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                $dataObj[] = (object) array('user_id' => $user_id,
                                            'conferenceid' => $conferenceid, 
                                            'firstname' => $value->firstname, 
                                            'lastname' => $value->lastname, 
                                            'title' => $value->title,
                                            'company' => $value->company,
                                            'email' => $value->email, 
                                            'phone' => $value->phone,
                                            'notes' => $value->notes,
                    'attributes' => Array(
                        "type" => "Lead",
                        "referenceId" => "lead".$key
                    ));
                    if (in_array($value->email, $leads_emails))
                    continue;
                        $insert[] = ['user_id' => $user_id,'conferenceid' => $conferenceid, 'firstname' => $value->firstname, 'lastname' => $value->lastname, 'title' => $value->title, 'company' => $value->company, 'email' => $value->email, 'phone' => $value->phone, 'notes' => $value->notes];
                        $leads_emails[] = $value->email;
                    }
                    if(!empty($insert)){
                        $obj = Leads::insert($insert);
                        // return back()->with('success', 'Thanks! Leads Imported Successfully!');
                    }
                    else
                    {
                        // return back()->with('danger', 'Oops! Lead Already Inserted!');
                    }
                }
            }
            else
            {
                // return back()->with('danger', 'Oops! Can insert only 200 at a stretch!');
            }
        }

        $emails_applied = Apply::pluck('email')->toArray();
        if(Input::hasFile('attendees_list_feedback')){
            $path = Input::file('attendees_list_feedback')->getRealPath();
            $data = Excel::load($path, function($reader) {
            })->get();
            unset($data[0]); 
            $conferenceid = $request->input('conferenceid');
            $user_id = Cookie::get('uid');
            
            if(!empty($data) && $data->count()){
                foreach ($data as $key => $value) {
                    $insert_applied = [
                                'conferenceid' => $conferenceid,
                                'user_id' => $user_id,
                                'firstname' => $value->firstname, 
                                'lastname' => $value->lastname,
                                'email' => $value->email, 
                                'mngfirstname' => $value->mngfirstname, 
                                'mnglastname' => $value->mnglastname, 
                                'mngemail' => $value->mngemail, 
                                'confname' => $value->confname, 
                                'confstart' => $value->confstart, 
                                'confend' => $value->confend, 
                                'confurl' => $value->confurl, 
                                'travel' => $value->travel, 
                                'travelstart' => $value->travelstart, 
                                'travelend' => $value->travelend, 
                                'reg_costs' => $value->reg_costs,
                                'sponsoring_costs' => $value->sponsoring_costs, 
                                'exhibit_costs' => $value->exhibit_costs,
                                'other_costs' => $value->other_costs,
                                'support' => $value->support,
                                'deliverables' => $value->deliverables,
                                'travelcosts' => $value->travelcosts,
                                'role' => $value->role,
                                'sponsoring' => $value->sponsoring,
                                'business' => $value->business,
                                'benefits' => $value->benefits
                            ];

                            if (in_array($value->email, $emails_applied))
                            continue;
                                $insert_applied[] = [
                                    'user_id' => $user_id,
                                    'firstname' => $value->firstname, 
                                    'lastname' => $value->lastname,
                                    'email' => $value->email, 
                                    'mngfirstname' => $value->mngfirstname, 
                                    'mnglastname' => $value->mnglastname, 
                                    'mngemail' => $value->mngemail, 
                                    'confname' => $value->confname, 
                                    'confstart' => $value->confstart, 
                                    'confend' => $value->confend, 
                                    'confurl' => $value->confurl, 
                                    'travel' => $value->travel, 
                                    'travelstart' => $value->travelstart, 
                                    'travelend' => $value->travelend, 
                                    'reg_costs' => $value->reg_costs,
                                    'sponsoring_costs' => $value->sponsoring_costs, 
                                    'exhibit_costs' => $value->exhibit_costs,
                                    'other_costs' => $value->other_costs,
                                    'support' => $value->support,
                                    'deliverables' => $value->deliverables,
                                    'travelcosts' => $value->travelcosts,
                                    'role' => $value->role,
                                    'sponsoring' => $value->sponsoring,
                                    'business' => $value->business,
                                    'benefits' => $value->benefits,
                                    'status_sm' => 'Approved',
                                    'status_m' => 'Approved'
                                ];
                                $emails_applied[] = $value->email;
                            }
                    
                    if(!empty($insert_applied)){
                        $apply = Apply::create($insert_applied);
                        // return back()->with('success', 'Thanks! Leads Imported Successfully!');
                    }
                    else
                    {
                        // return back()->with('danger', 'Oops! Lead Already Inserted!');
                    }				
                // return back()->with('success', 'Thanks! Attendees has been inserted succesfully!');									
                // }

                // $ret = Apply::create($insert_applied);
               }	
        }

        $survey = Survey::create([
            'reason' => $request->reason,
            'competitors' => $request->competitors,            
            'conference_costs' => $request->conference_costs,
            'conference_expenses' => $request->conference_expenses,
            'scheduled' => $request->scheduled,
            'attended' => $request->attended,
            'personal_contacts' => $request->personal_contacts,
            'elaborateno' => $request->elaborateno,
            'additional_plans' => $request->additional_plans,
            'recommend' => $request->recommend,
            'attendees' => $request->attendees,
            'companies' => $request->companies,
            'conferenceid' => $request->input('conferenceid'),
            'user_id' => Cookie::get('uid')
        ]);

        return Response::json([
                'data' => $survey
        ], 200);
    }
}
