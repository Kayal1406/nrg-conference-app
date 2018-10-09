<?php
    
namespace App\Http\Controllers;

use App\Conference;
use App\User;
use App\Feedback;
use App\Lead;
use App\Apply;
use DB;
use Mail;
use Carbon\Carbon; 
use Datatables;
use Illuminate\Http\Request;
use Crypt;
use App\Notes;
use App\StandardUser;
use App\SponsorshipSurvey;
use Response;
use App\Survey;
use App\Leads;
use Validator;
use App\Salesforce;
use Cookie;
use Input;
use Auth;

class DashboardController extends Controller
{
    public function clearCookie()
    {
        return redirect('/')->withCookie(Cookie::forget('uemail'))
                            ->withCookie(Cookie::forget('ufn'))
                            ->withCookie(Cookie::forget('uln'))
                            ->withCookie(Cookie::forget('uid'))
                            ->withCookie(Cookie::forget('mfn'))
                            ->withCookie(Cookie::forget('mln'))
                            ->withCookie(Cookie::forget('uphone'))
                            ->withCookie(Cookie::forget('uanotherphone'))
                            ->withCookie(Cookie::forget('uanotheremail'))
                            ->withCookie(Cookie::forget('memail'));
    }

    public function popup()
    {
        return view('popup');
    }

    public function register(Request $request)
    {
        $this -> validate($request,[
            'useremail' =>'required',
        ]);

        $res = StandardUser::where('useremail', Input::get('useremail'))->first();
        $email = $request->useremail;

        if ($res) {
            $userid = json_decode($res)->id;
            $firstname = json_decode($res)->firstname;
            $lastname = json_decode($res)->lastname;
            $managerfirstname = json_decode($res)->manager_firstname;
            $managerlastname = json_decode($res)->manager_lastname;
            $manageremail = json_decode($res)->manager;
            $another_phone = json_decode($res)->another_phone;
            $phone = json_decode($res)->phone;
            $another_email = json_decode($res)->another_email;

            return back()
                ->withCookie(cookie('uemail', $email))
                ->cookie('uid', $userid)
                ->cookie('ufn', $firstname)
                ->cookie('uln', $lastname)
                ->cookie('uphone', $phone)
                ->cookie('uanotherphone', $another_phone)
                ->cookie('uanotheremail', $another_email)
                ->cookie('mfn', $managerfirstname)
                ->cookie('mln', $managerlastname)
                ->cookie('memail', $manageremail);
        }else{
            $standarduser = StandardUser::create($request->all());
            $userid = $standarduser->id;

        return back()
        ->withCookie(cookie('uemail', $email))
        ->cookie('uid', $userid);       
         }
    }

    public function getCookie(Request $request)
    {
      $value = $request->cookie('email');
      return $value;
    }

    public function index(Request $request)
    {
        if(Cookie::get('uemail')){
            return redirect('/user');
        }
        elseif(Auth::user('name')){
            return redirect('/home');
        }
        else
        {
            $access_token = Salesforce::where('id', 1)->pluck('access_token');
            $cookieemail = $this->getCookie($request);
            $conference = Conference::where('status_sm', 'Approved')
                                    ->where('is_delete', '0')
                                    ->where('is_active', '0')
                                    ->orderBy('created_date', 'desc')->get();
            return view('dashboard',compact('conference','cookieemail'));
        }
    }
    public function getdashboard()
    {
        $conference = Conference::where('status_sm', 'Approved')
        ->where('is_delete', '0')->where('is_active', '0')->orderBy('created_date', 'desc')->get();
        return Datatables::of($conference)->make(true);
    }

// listview page controller
    public function listview()
    {
        return view('listview');
    }
    public function getPosts()
    {
        $conference = Conference::where('status_sm', 'Approved')
                                ->where('is_active', '0')
                                ->where('is_delete', '0')
                                ->orderBy('created_date', 'desc')->get();
        $conference->map(function ($conf) {
            $start_date = date("m/d/Y", strtotime($conf->conf_start));
            $end_date = date("m/d/Y", strtotime($conf->conf_end));
            $conf['conference_dates'] = $start_date.' - '.$end_date;
        });
        return Datatables::of($conference)->make(true);
    }

//Feedback Page Controller
    public function feedback($id)
    {
        $feedback = Conference::find($id);
        $attendees = Apply::where('conferenceid', $id)->where('status_m', 'Approved')->orderBy('created_date', 'desc')->get();
        return view('feedback', compact('feedback', 'attendees'));
    }
    public function feedbackPost(Request $request, $id)
    {
        $fileName1 = "";
        $fileName2 = "";
        $rules = array(
            'conferencename' =>'required',
            'yourname' =>'required',
            'email' =>'required',
            'objective' =>'required',
            'results' =>'required',
            'recommendations' =>'required',
            'key_customers' =>'required',
            'actions' =>'required',
            'business_opportunities' =>'required',
            'other_opportunities' =>'required',
            'upload_leads' =>'mimes:csv,xls,xlsx', 
            'upload_attendees' =>'mimes:csv,xls,xlsx',
            );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return back()->with('danger', 'File format not valid');
        }
        else 
        {
            if($file=$request->hasFile('upload_attendees')) {
                $file=$request->file('upload_attendees');
                $fileName1=$file->getClientOriginalName();
                if (!file_exists('uploads/feedback/attendees/'.$id.'')) {
                mkdir('uploads/feedback/attendees/'.$id.'', 0777, true);
                }
                $destinationPath='uploads/feedback/attendees/'.$id.'';
                $file->move($destinationPath,$fileName1);
            }

            if($file=$request->hasFile('upload_leads')) {
                $file=$request->file('upload_leads');
                $fileName2=$file->getClientOriginalName();
                if (!file_exists('uploads/feedback/leads/'.$id.'')) {
                mkdir('uploads/feedback/leads/'.$id.'', 0777, true);
                }
                $destinationPath='uploads/feedback/leads/'.$id.'';
                $file->move($destinationPath,$fileName2);
            }
            $feedback = Feedback::insert([
                                        'user_id' => $request->user_id,
                                        'conferenceid' => $request->conferenceid,
                                        'conferencename' =>$request->conferencename,
                                        'yourname' =>$request->yourname,
                                        'email' =>$request->email,
                                        'objective' =>$request->objective,
                                        'results' =>$request->results,
                                        'recommendations' =>$request->recommendations,
                                        'key_customers' =>$request->key_customers,
                                        'actions' =>$request->actions,
                                        'business_opportunities' =>$request->business_opportunities,
                                        'other_opportunities' =>$request->other_opportunities,
                                        'upload_attendees' =>$fileName1,
                                        'upload_leads' =>$fileName2,
                                            ]);
            }
        return back()->with('success', 'Thanks! Your Feedback has been Submitted!');
    }

//new conference request page controller
    public function addnew()
    {
        return view('addnew');
    }
    
    public function addnewPost(Request $request)
    {
        $email = StandardUser::where('useremail', Input::get('email'))->value('useremail');
        $firstname = StandardUser::where('useremail', Input::get('email'))->value('firstname');
        $lastname = StandardUser::where('useremail', Input::get('email'))->value('lastname');

        if ($firstname == "" && $email == ""){
            $standarduser = StandardUser::insert([
                'useremail' => Input::get('email'), 
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'phone' => Input::get('phone'),
                'another_email' => Input::get('another_email'), 
                'another_phone' => Input::get('another_phone'),
                'manager' => Input::get('manager')
            ]);
        }
        else
        {
            $standarduser = StandardUser::where('useremail', Input::get('email'))->update([
                'firstname' => Input::get('firstname'),
                'lastname' => Input::get('lastname'),
                'phone' => Input::get('phone'),
                'another_email' => Input::get('another_email'),
                'another_phone' => Input::get('another_phone'),
                'manager' => Input::get('manager')
            ]);      
        }

        $confstart = date("Y-m-d", strtotime($request->conf_start));
        $confend = date("Y-m-d", strtotime($request->conf_end));
        $travelstart = date("Y-m-d", strtotime($request->travel_start));
        $travelend = date("Y-m-d", strtotime($request->travel_end));

        $return = Conference::create([
            'user_id' => $request->user_id,
            'conferencename' => $request->conferencename,
            'frequency' => $request->frequency,
            'conference_cost' => $request->conference_cost,
            'location' => $request->location,
            'conf_start' => $confstart,
            'conf_end' => $confend,
            'travel_start' => $travelstart,
            'travel_end' => $travelend,
            'conferenceurl' => $request->conferenceurl,
            'travel_cost' => $request->travel_cost,
            'travel_city' => $request->travel_city,
            'nrg_past' => $request->nrg_past,
            'attendees_travelling' => $request->attendees_travelling,
            'description' => $request->description,
            'role' => $request->role,
            'sponsoring_cost' => $request->sponsoring_cost,
            'business' => $request->business,
            'benefits' => $request->benefits,
            'deliverables' => $request->deliverables,
            'industry' => $request->industry,
            'audience' => $request->audience,
            'email' => $request->email
        ]);
        $data = json_decode($return, true);

        $user_id = StandardUser::where('useremail', Input::get('email'))->value('id');
        $res = Conference::where('conferencename', Input::get('conferencename'))->update(['user_id' => $user_id]);

        $firstname = $request->firstname;
        $lastname = $request->lastname;

        $encrypt = $return->id;
        $encrypted = Crypt::encryptString($encrypt);
        DB::table('conference')
            ->where('id', $encrypt)
            ->update(['link' => $encrypted]);

        $returnone = Conference::find($encrypt);
        $dataone = json_decode($returnone, true); 

        $similar_conference = Conference::where('conferencename', $request->conferencename)->where('id', '!=', $dataone['id'])->orderBy('created_date', 'desc')->get();
        $similar_decoded = json_decode($similar_conference, true);
        $admin_email = User::where('id', 1)->value('email');
        
        $data = array('formdata' => $dataone, 'firstname' => $firstname, 'lastname' => $lastname, 'email' => $email, 'similar' => $similar_decoded, 'admin_email' => $admin_email);

        Mail::send('emails.newreq', $data, function($message) use ($data){
            $message->from($data['formdata']['email']);
            $message->to($data['admin_email']);
            $message->subject('New Conference Request Submission');
        }); 

        return Response::json([
            'data' => 'success'
        ], 200);
    }

    public function getRelatedConf()
    {
        $conference_names = DB::table('conference')->pluck('conferencename');
        $conArray = array();
        $cVal = '';
        foreach ($conference_names as $key => $value) {
            $cVal .= $value.",";
        }
        $cValArr = explode(",", $cVal);
        array_pop($cValArr); 
        return $conference_names;
    }

    public function getRelatedUser()
    {
        $user_email = StandardUser::pluck('useremail');
        return $user_email;
    }

    public function pending()
    {
        $apply = Apply::where('user_id', Cookie::get('uid'))->orderBy('created_date', 'desc')->get();
        $conference = Conference::where('user_id', Cookie::get('uid'))->orderBy('created_date', 'desc')->get();
        return view('pending',compact('conference', 'apply'));
    }
    //apply to conference page controller
    public function apply($id)
    {
        $conference = Conference::find($id);
        $conf_start = date("m/d/Y", strtotime($conference->conf_start));
        $conf_end = date("m/d/Y", strtotime($conference->conf_end));
        return view('apply', compact('conference', 'conf_start', 'conf_end'));
    }
    public function applyPost(Request $request)
    {
        $email = StandardUser::where('useremail', Input::get('email'))->value('useremail');
        $firstname = StandardUser::where('useremail', Input::get('email'))->value('firstname');
        $lastname = StandardUser::where('useremail', Input::get('email'))->value('lastname');
        $manageremail = StandardUser::where('useremail', Input::get('email'))->value('manager');        

        if($manageremail == "" && $email == ""){
            $standarduser = StandardUser::insert([
                'useremail' => $request->email,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone, 
                'another_phone' => $request->another_phone, 
                'another_email' => $request->another_email,    
                'manager_email' => $request->mngemail
                 ]);     
            $firstname = StandardUser::where('useremail', Input::get('email'))->value('firstname');
            $lastname = StandardUser::where('useremail', Input::get('email'))->value('lastname');
            $manageremail = StandardUser::where('useremail', Input::get('email'))->value('manager_email');
        }
        elseif($manageremail == "" && $email != ""){
            $standarduser = StandardUser::where('useremail', $request->email)->update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'phone' => $request->phone, 
                'another_phone' => $request->another_phone,
                'another_email' => $request->another_email,
                'manager_email' => $request->mngemail
                ]);     
            $firstname = StandardUser::where('useremail', Input::get('email'))->value('firstname');
            $lastname = StandardUser::where('useremail', Input::get('email'))->value('lastname');
            $manageremail = StandardUser::where('useremail', Input::get('email'))->value('manager_email');
        }

        $conf_start = date("Y-m-d", strtotime($request->confstart));
        $conf_end = date("Y-m-d", strtotime($request->confend));
        $travel_start = date("Y-m-d", strtotime($request->travelstart));
        $travel_end = date("Y-m-d", strtotime($request->travelend));

        $return = Apply::create(['firstname' => $request->firstname,
                                 'lastname' => $request->lastname,
                                 'phone' => $request->phone,
                                 'another_phone' => $request->another_phone,
                                 'email' => $request->email,
                                 'another_email' => $request->another_email,
                                 'mngemail' => $request->mngemail,
                                 'confname' => $request->confname,
                                 'confstart' => $conf_start,
                                 'confend' => $conf_end,
                                 'confurl' => $request->confurl,
                                 'travelstart' => $travel_start,
                                 'travelend' => $travel_end,
                                 'conf_frequency' => $request->conf_frequency,
                                 'conf_cost' => $request->conf_cost,
                                 'travel_cost' => $request->travel_cost,
                                 'conf_location' => $request->conf_location,
                                 'conf_city' => $request->conf_city,
                                 'attendees_travelling' => $request->attendees_travelling,
                                 'description' => $request->description,
                                 'deliverables' => $request->deliverables,
                                 'role' => $request->role,
                                 'sponsoring_cost' => $request->sponsoring_cost,
                                 'business' => $request->business,
                                 'benefits' => $request->benefits,
                                 'industry' => $request->industry,
                                 'audience' => $request->audience,
                                 'conferenceid' => $request->conferenceid
                                ]);
        // $update_dates = Apply::where('id', $return->id)->update(['confstart' => $confstart, 'confend' => $confend, 'travelstart' => $travelstart, 'travelend' => $travelend]);
        $data = json_decode($return, true);

        $user_id = StandardUser::where('useremail', Input::get('email'))->value('id');
        $res = Apply::where('email', Input::get('email'))->update(['user_id' => $user_id]);
        $mngemail = $request->mngemail;
        
        $encrypt = $return->id;
        $encrypted = Crypt::encryptString($encrypt);
        DB::table('apply')
            ->where('id', $encrypt)
            ->update(['link' => $encrypted]);

        $returnone = Apply::find($encrypt);
        $dataone = json_decode($returnone, true); 

        $conferenceid = $dataone['conferenceid'];
        $attendees = Apply::where('conferenceid', $conferenceid)->where('status_m', 'Approved')->where('id', '!=', $encrypt)->orderBy('created_date', 'desc')->get();        $attendeesone = json_decode($attendees, true);
        $email = User::where('id', 1)->value('email');

        $data = array('formdata' => $dataone, 'participants' => $attendeesone, 'email' => $email);

        Mail::send('emails.appliedconference', $data, function($message) use ($data){
            $message->from($data['formdata']['email']);
            $message->to($data['email']);
            $message->subject('New Request to Attend Submission');
        });
        return Response::json([
            'data' => 'success'
        ], 200);
    }

    public function leads($id)
    {
        $conference = Conference::find($id);
        $notes = Notes::where('conferenceid', $id)->orderBy('created_at', 'desc')->get();
        $modal_conf = Conference::where('id', $id)->first();
        $modal_conf['conference_dates'] = $modal_conf->conf_start.' to '.$modal_conf->conf_end;
        $similar_conference_id = Conference::where('conferencename', $conference->conferencename)->where('status_sm', 'Approved')->where('id', '!=', $id)->orderBy('created_date', 'desc')->pluck('id');
        $similar_id = Conference::where('conferencename', $conference->conferencename)->where('status_sm', 'Approved')->where('id', '!=', $id)->orderBy('created_date', 'desc')->pluck('id');        
        $similar_id->push($id);

        $conf_score_all = SponsorshipSurvey::whereIn('conference_id', $similar_id)->pluck('conference_score');
        $overall_score = 0;
        foreach($conf_score_all as $key=>$value){
            $overall_score += $value;
        }
        $overall_score = $overall_score/count($similar_id);
        
        $conf_costs_all = SponsorshipSurvey::whereIn('conference_id', $similar_id)->pluck('sponsorship_costs');
        $overall_costs = 0;
        foreach($conf_costs_all as $key=>$value){
            $overall_costs += $value;
        }
        $overall_costs = $overall_costs/count($similar_id);

        $similar_conference = Conference::whereIn('id', $similar_conference_id)->orderBy('created_date', 'desc')->get();
        $similar_conference->map(function ($similar) {
            $sim_attendees = Apply::where('conferenceid', $similar->id)->where('status_m', 'Approved')->where('is_delete', '0')->orderBy('created_date', 'desc')->get();

            $sim_attendees->map(function ($sim) {
                $conf_cost = Apply::where('user_id', $sim->user_id)->value('conf_cost');
                $sim_survey = Survey::where('user_id', $sim->user_id)->where('conferenceid', $sim->conferenceid)->value('recommend');
                $sim_attendees['sim_survey'] = $sim_survey;
                $sim_attendees['conf_cost'] = $conf_cost;
            });

            $similar['sim_attendees'] = $sim_attendees;
            $similar['conference_dates'] = $similar->conf_start.' to '.$similar->conf_end;

            $sim_attendee_ind_score = Survey::where('conferenceid', $similar->conferenceid)->pluck('recommend')->toArray();
            if(count($sim_attendee_ind_score) > 0){
                $sim_att_score_avg = (array_sum($sim_attendee_ind_score)) / (count($sim_attendee_ind_score));
                $similar['sim_att_score_avg'] = $sim_att_score_avg;
            }
            else{
                $similar['sim_att_score_avg'] = "N/A";
            }

            $conf_score = SponsorshipSurvey::where('conference_id', $similar->id)->value('conference_score');
            $conf_costs = SponsorshipSurvey::where('conference_id', $similar->id)->value('sponsorship_costs');
            $is_speaker = SponsorshipSurvey::where('conference_id', $similar->id)->value('is_speaker');

            $similar['conference_score'] = $conf_score;
            $similar['sponsorship_costs'] = $conf_costs;
            $similar['is_speaker'] = $is_speaker;
        });
        // return $similar_conference;
        if (!file_exists('uploads/'.$id.'')) {
        }
        else
        {
        $documents = scandir('uploads/'.$id);
        unset( $documents[array_search('.', $documents)]);
        unset( $documents[array_search('..', $documents)]);
        }
        $attendees = Apply::where('conferenceid', $id)->where('status_m', 'Approved')->where('is_delete', '0')->orderBy('created_date', 'desc')->get();
        $attendees->map(function ($attend) {
            $conf_cost = Apply::where('user_id', $attend->user_id)->value('conf_cost');
            $survey = Survey::where('user_id', $attend->user_id)->where('conferenceid', $attend->conferenceid)->value('recommend');
            $attend['survey'] = $survey;
            $attend['conf_cost'] = $conf_cost;
        });
        //ADMIN CHECK
        if(Auth::guest() != 1 AND Cookie::get('uemail') == ""){
            $adminEmail = Auth::user()->email;
            $is_admin = 1;
        }
        else{
            $is_admin = "";
            $adminEmail = "";
        }
        //Conference Score
        $conf_score = SponsorshipSurvey::where('conference_id', $id)->first();
        $attendee_ind_score = Survey::where('conferenceid', $id)->pluck('recommend')->toArray();
        if(count($attendee_ind_score) > 0){
            $att_score_avg = (array_sum($attendee_ind_score)) / (count($attendee_ind_score));
        }
        else{
            $att_score_avg = "N/A";
        }
        return view('leads', compact('conference', 'modal_conf', 'overall_costs', 'overall_score', 'att_score_avg', 'documents', 'notes', 'attendees', 'similar_conference', 'conf_score','is_admin','adminEmail'));
    }
    
    public function user()
    {
        $uid = Cookie::get('uid');
        $active_conferences = Apply::select('apply.conferenceid','conference.conf_start','conference.conf_end','conference.conferencename','conference.description','conference.conferenceurl', 'apply.confend')
            ->join('conference','apply.conferenceid','=','conference.id')
            ->where('apply.status_m', 'Approved')->where('apply.user_id', $uid)->where('apply.is_delete', '0')->whereDate('apply.confend', '>=', Carbon::now())
            ->orderBy('apply.created_date', 'desc')
            ->get();
        $active_conferences->map(function ($active) {
            $start_date = date("m/d/Y", strtotime($active->conf_start));
            $end_date = date("m/d/Y", strtotime($active->conf_end));
            $active['conference_dates'] = $start_date.' to '.$end_date;
        });
        $pastlastyear = date('Y') - 2;
        $lastyear = date('Y') - 1;
        $currentyear = date('Y');
        return view('user', compact('active_conferences', 'lastyear', 'pastlastyear', 'currentyear'));
    }

    public function gethistory($uid)
    {
        $currentDate = Carbon::now();
        $history = Apply::where('confend', '<', $currentDate)
                        ->where( DB::raw('YEAR(confend)'), '=', date('Y'))
                        ->where('status_m', 'Approved')
                        ->where('is_delete', '0')
                        ->where('user_id', $uid)
                        ->orderBy('created_date', 'desc')->get();        
        $history->map(function ($his) {
            $uid = Cookie::get('uid');
            $survey_result = Survey::where('conferenceid', $his->conferenceid)->where('user_id', $uid)->first();
            if(!empty($survey_result)){
                $his['results'] = $survey_result->recommend;
            }
            else{
                $his['results'] = "";
            }

            $start_date = date("m/d/Y", strtotime($his->confstart));
            $end_date = date("m/d/Y", strtotime($his->confend));
            $his['conference_dates'] = $start_date.' to '.$end_date;
        });
        return Datatables::of($history)->make(true);
    }

    public function historyLastYear($uid)
    {
        $lastYear = date('Y') - 1;
        $history_lastyear = Apply::where( DB::raw('YEAR(confend)'), '=', $lastYear)
                        ->where('user_id', Cookie::get('uid'))
                        ->where('status_m', 'Approved')
                        ->where('is_delete', '0')
                        ->orderBy('created_date', 'desc')->get();
        $history_lastyear->map(function ($lastyear) {
            $uid = Cookie::get('uid');
            $survey_result = Survey::where('conferenceid', $lastyear->conferenceid)->where('user_id', $uid)->first();
            if(!empty($survey_result)){
                $lastyear['results'] = $survey_result->recommend;
            }
            else{
                $lastyear['results'] = "";
            }
            $start_date = date("m/d/Y", strtotime($lastyear->conf_start));
            $end_date = date("m/d/Y", strtotime($lastyear->conf_end));
            $lastyear['conference_dates'] = $start_date.' to '.$end_date;
        });
        return Datatables::of($history_lastyear)->make(true);
    }

    public function historyPastLastYear($uid)
    {
        $pastLastYear = date('Y') - 2;
        $history_pastlastyear = Apply::where( DB::raw('YEAR(confend)'), '=', $pastLastYear)
                                ->where('user_id', Cookie::get('uid'))
                                ->where('is_delete', '0')
                                ->where('status_m', 'Approved')
                                ->orderBy('created_date', 'desc')->get();
        $history_pastlastyear->map(function ($lastyear) {
            $uid = Cookie::get('uid');
            $survey_result = Survey::where('conferenceid', $lastyear->conferenceid)->where('user_id', $uid)->first();
            if(!empty($survey_result)){
                $lastyear['results'] = $survey_result->recommend;
            }
            else{
                $lastyear['results'] = "";
            }            
            $start_date = date("m/d/Y", strtotime($lastyear->conf_start));
            $end_date = date("m/d/Y", strtotime($lastyear->conf_end));
            $lastyear['conference_dates'] = $start_date.' to '.$end_date;
        });
        return Datatables::of($history_pastlastyear)->make(true);
    }

    public function getconference($uid)
    {
        $conference = Conference::where('user_id', $uid)->orderBy('created_date', 'desc')->get();
        return Datatables::of($conference)->make(true);
    }
    public function getapply($uid)
    {
        $apply = Apply::where('user_id', $uid)->orderBy('created_date', 'desc')->get();
        return Datatables::of($apply)->make(true);
    }
    public function leadsStore(Request $request)
    {
        $rules = array(
            'conferenceid' => 'required',
            'firstname' => 'required',
            'email' => 'unique:leads',
            'lastname' => 'required',
            'company' => 'required',
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            if(isset($request->submit_lead)){
                return back()->with('danger', 'Leads already inserted!');
            }
            elseif(isset($request->another_lead)){
                return back()->with('another_lead', 1)
                             ->with('wrong', 'Leads already inserted!');
            }
            else{
                //
            }
        }
        else
        {
            if(!empty($request->sendleads)){
                $user = StandardUser::where('id', $request->user_id)->first();
                $conference = Conference::where('id', $request->conferenceid)->first();
                $email = User::where('id', 1)->value('email');

                $data = array('leads' => $request->all(), 'user' => $user, 'conference' => $conference, 'email' => $email);
                // return $data;
                Mail::send('emails.sendassist', $data, function ($mail) use ($data) {
                    $mail->to($data['leads']['sendleads']);
                    $mail->from($data['email']);
                    $mail->subject($data['conference']['conferencename']." - Lead");
                });  
                if(isset($request->submit_lead)){
                    return back()->with('success', 'Lead has been submitted');
                }
                elseif(isset($request->another_lead)){
                    return back()->with('another_lead', 1);
                }
                else{
                    //
                }
            }
            else{
                $leads = Leads::create($request->all());
                // app('App\Http\Controllers\SalesforceController')->init();
                // $salesforce_response =  app('App\Http\Controllers\SalesforceController')
                //                         ->insert_record("Lead", array("firstname" => $request->firstname,
                //                                 "lastname" => $request->lastname,
                //                                 "email" => $request->email,
                //                                 "company" => $request->company,
                //                                 "status" => "Open"));
                // $salesforce_json = json_decode($salesforce_response);
                // $test = Leads::where('id', $leads->id)->update(['salesforce_id' => $salesforce_json->id]);
                if(isset($request->submit_lead)){
                    return back()->with('success', 'Lead has been submitted');
                }
                elseif(isset($request->another_lead)){
                    return back()->with('another_lead', 1);
                }
                else{
                    //
                }
            }
        }
    }

// leads list page controller
    public function leadslist()
    {
        $conference = Conference::where('status_sm', 'Approved')->orderBy('created_date', 'desc')->get();
        $leads = DB::table('leads')
            ->select('leads.conferenceid','leads.firstname','leads.lastname','leads.email','leads.company','conference.conferencename')
            ->join('conference','leads.conferenceid','=','conference.id')
            ->orderBy('leads.created_date', 'desc')
            ->get();
        return view('leadslist',compact('leads', 'conference'));
    }
    public function getdata()
    {
        $leads = DB::table('leads')
            ->select('leads.conferenceid','leads.firstname','leads.lastname','leads.email','leads.company','conference.conferencename')
            ->join('conference','leads.conferenceid','=','conference.id')
            ->orderBy('leads.created_date', 'desc')
            ->get();
        /*$conference =Conference::with(array('conference'))->get();*/
        return Datatables::of($leads)
            ->make(true);
    }
    public function addNotes(Request $request)
    {
        $this -> validate($request,[
            'conferenceid' => 'required',
            'useremail' => 'required',
            'notes' => 'required'
            ]);

        Notes::create($request->all());
        return back()->with('success', 'Your notes has been submitted');
    }
}