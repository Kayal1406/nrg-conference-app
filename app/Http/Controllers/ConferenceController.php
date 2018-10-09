<?php

namespace App\Http\Controllers;


use App\Conference;
use DB;
use App\StandardUser;
use Mail;
use Datatables;
use App\User;
use Illuminate\Http\Request;
use Crypt;
use Input;
use App\Notes;
use App\Leads;
use App\Apply;
use Carbon\Carbon;
use App\Feedback;
use Cookie;
use Validator;
use App\SponsorshipSurvey;
use Auth;
use Response;
use App\Survey;

class ConferenceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function index()
    {
        $conference = Conference::where('status_sm', 'Approved')
                        ->where('is_delete', '0')->orderBy('created_date', 'desc')->get();
        return view('supmng_pages.home',compact('conference'));
    }

    public function conferenceExist(Request $request)
    {
        $res = Conference::where('conferencename', $request->cname )->first();
        return $res;
    }
    public function gethome()
    {
        $conference = Conference::where('status_sm', 'Approved')
            ->where('is_delete', '0')->orderBy('created_date', 'desc')->get();
        return Datatables::of($conference)
            ->make(true);

    }
    public function edit($id)
    {
        $conference = Conference::find($id);
        $confstart = date("m/d/Y", strtotime($conference->conf_start));
        $confend = date("m/d/Y", strtotime($conference->conf_end));
        $travelstart = date("m/d/Y", strtotime($conference->travel_start));
        $travelend = date("m/d/Y", strtotime($conference->travel_end));
        return view('supmng_pages.edit', compact('conference', 'confstart', 'confend', 'travelstart', 'travelend'));
    }
    public function update(Request $request, $id)
    {
        $conference = Conference::find($id);

        $confstart = date("Y-m-d", strtotime($request->conf_start));
        $confend = date("Y-m-d", strtotime($request->conf_end));
        $travelstart = date("Y-m-d", strtotime($request->travel_start));
        $travelend = date("Y-m-d", strtotime($request->travel_end));

        $return = Conference::where('id', $id)->update([
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
            'audience' => $request->audience
        ]);

        return Response::json([
            'data' => 'success'
        ], 200);
    }
    public function delete($id)
    {
        DB::table('conference')->where('id', $id)->update(['is_delete' => '1']);
        return redirect('home')->with('danger', 'Conference has been Deleted!');
    }
    
    public function changeStatus()
    {
        $id = Input::get('id');
        $result = DB::update("UPDATE conference SET is_active = IF(is_active=1, 0, 1) WHERE id = '".$id."'");
    }

    public function approved_conference(Request $request, $id)
    {
        $notes = Notes::where('conferenceid', $id)->orderBy('created_at', 'desc')->get();
        $conference = Conference::find($id);
        $count = count(Leads::where('conferenceid', $id)->get());
        $modal_conf = Conference::where('id', $id)->first();
        $modal_conf['conference_dates'] = $modal_conf->conf_start.' to '.$modal_conf->conf_end;
        $similar_conference_id = Conference::where('conferencename', $conference->conferencename)->where('id', '!=', $id)->where('status_sm', 'Approved')->orderBy('created_date', 'desc')->pluck('id');

        $similar_id = Conference::where('conferencename', $conference->conferencename)
        ->where('status_sm', 'Approved')->where('id', '!=', $id)->orderBy('created_date', 'desc')->pluck('id');        
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

        $similar_conference = Conference::whereIn('id', $similar_conference_id)->get();
        $similar_conference->map(function ($similar) {
            $sim_attendees = Apply::where('conferenceid', $similar->id)->where('status_m', 'Approved')->where('is_delete', '0')->get();

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
            $leads_count = count(Leads::where('conferenceid', $similar->id)->get());
            $conf_score = SponsorshipSurvey::where('conference_id', $similar->id)->value('conference_score');
            $conf_costs = SponsorshipSurvey::where('conference_id', $similar->id)->value('sponsorship_costs');
            $is_speaker = SponsorshipSurvey::where('conference_id', $similar->id)->value('is_speaker');
            $similar['leads_count'] = $leads_count;
            $similar['conference_score'] = $conf_score;
            $similar['sponsorship_costs'] = $conf_costs;
            $similar['is_speaker'] = $is_speaker;
        });

        if (!file_exists('uploads/'.$id.'')) {
        }
        else
        {
        $documents = scandir('uploads/'.$id);
        unset( $documents[array_search('.', $documents)]);
        unset( $documents[array_search('..', $documents)]);
        }
        $attendees = Apply::where('conferenceid', $id)->where('status_m', 'Approved')->where('is_delete', '0')->get();
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
        $admin_email_notes_popup = User::where('id', 1)->value('email');
        return view('leads', compact('conference', 'overall_costs', 'att_score_avg','overall_score', 'modal_conf','adminEmail','is_admin','notes', 'documents', 'similar_conference','attendees', 'count', 'conf_score', 'admin_email_notes_popup'));
    }

    public function ConferenceDetails($id)
    {
        $conference = Conference::find($id);
        $notes = Notes::where('conferenceid', $id)->orderBy('created_at', 'desc')->get();
        $modal_conf = Conference::where('id', $id)->first();
        $modal_conf['conference_dates'] = $modal_conf->conf_start.' to '.$modal_conf->conf_end;
        $similar_conference_id = Conference::where('conferencename', $conference->conferencename)->where('status_sm', 'Approved')->where('id', '!=', $id)->pluck('id');

        $similar_id = Conference::where('conferencename', $conference->conferencename)->where('status_sm', 'Approved')->where('id', '!=', $id)->pluck('id');        
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
            $sim_attendees = Apply::where('conferenceid', $similar->id)->orderBy('created_date', 'desc')->where('status_m', 'Approved')->where('is_delete', '0')->get();

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
        $attendees = Apply::where('conferenceid', $id)->where('status_m', 'Approved')->orderBy('created_date', 'desc')->where('is_delete', '0')->get();
        $attendees->map(function ($attend) {
            $conf_cost = Apply::where('user_id', $attend->user_id)->value('conf_cost');
            $survey = Survey::where('user_id', $attend->user_id)->where('conferenceid', $attend->conferenceid)->value('recommend');
            $attend['survey'] = $survey;
            $attend['conf_cost'] = $conf_cost;
        });
        //Conference Score
        $conf_score = SponsorshipSurvey::where('conference_id', $id)->first();
        $attendee_ind_score = Survey::where('conferenceid', $id)->pluck('recommend')->toArray();
        if(count($attendee_ind_score) > 0){
            $att_score_avg = (array_sum($attendee_ind_score)) / (count($attendee_ind_score));
        }
        else{
            $att_score_avg = "N/A";
        }
        return view('conferencedetails', compact('conference', 'overall_costs', 'att_score_avg','overall_score','modal_conf','notes', 'similar_conference', 'attendees', 'conf_score'));
    }

    public function addNotes($id)
    {
        $apply = Apply::find($id);
        return view('email_forms.addnotes', compact('apply'));
    }

    public function addLeads($id)
    {
        $apply = Apply::find($id);
        return view('email_forms.addleads', compact('apply'));
    }

    public function rejectNew(Request $request)
    {
        $id = $request->input('id');
        $reason= $request->input('reason');
        $conferencename=Conference::where('id', $id)->value('conferencename');
        
        Conference::where('id', $id)->update(['sm_remarks' => $reason, 'status_sm' => 'Rejected']);

        $returnone = Conference::select('conference.conferencename','conference.email','conference.sm_remarks','conference.status_sm', 'standarduser.firstname')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('conference.id', $id)->first();
        $dataone = json_decode($returnone, true);
        $email = User::where('id', 1)->value('email');
        $data = array('dataone' => $dataone, 'email' => $email, 'conferencename' => $conferencename);        
        
        Mail::send('emails.userrejectioncreated', $data, function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Your New Conference Request Submission');
        });

        return back()->with('danger', 'Request has been rejected');
    }

    public function rejectApplied(Request $request)
    {
        $id = $request->input('id');
        $reason= $request->input('reason');

        Apply::where('id', $id)->update(['admin_remarks' => $reason, 'status_sm' => 'Rejected']);

        $returnone = Apply::find($id);
        $dataone = json_decode($returnone, true);

        Mail::send('emails.userrejection', $dataone, function($message) use ($dataone){
            $message->to($dataone['email']);
            $message->subject('Your conference request');
        });

        return back()->with('danger', 'Request has been Rejected');
    }
    //pastconference page controllers
    public function postConferencePageList()
    {
        $conference = Conference::where('status_sm', 'Approved')->orderBy('created_date', 'desc')->get();
        $apply = Apply::where('confend', '>', Carbon::now())->orderBy('created_date', 'desc')->where('status_m', 'Approved')->get();
        /*$conference = DB::table('apply')
            ->select('apply.conferenceid','conference.conferencename')
            ->join('conference','apply.conferenceid','=','conference.id')
            ->where('confend', '<', Carbon::now())
            ->where('status_m', 'Approved')
            ->get();
*/
            //echo $conference;
            /*?*/
        $feedback = Feedback::all();
        return view('postconferencepagelist',compact('conference', 'feedback'));
    }
    public function getpostConferencePageList()
    {
        $conference = Conference::where('status_sm', 'Approved')->orderBy('created_date', 'desc')->get();
        return Datatables::of($conference)->make(true);
    }


    public function getpast(Request $request)
    {
        $feedback = Feedback::all();
        return Datatables::of($feedback)->make(true);
    }

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
        return Datatables::of($leads)
            ->make(true);
    }
    public function sponsorshipSurvey(Request $request){
        $rules = array(
            'conference_id' => 'required',
            'user_id' => 'required',
            'sponsorship_costs' => 'required',
            'is_speaker' => 'required',
            'leads' => 'required',
            'booth_traffic' => 'required',
            'relevant' => 'required',
            'promotional_assets' => 'required',
            'nrg_social_mentions' => 'required',
            'conf_social_mentions' => 'required',
            'invite_open' => 'required'
        );

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) 
        {
            return back()->with('danger', 'Something went wrong!');
        }
        else
        {
            $survey = SponsorshipSurvey::create($request->all());
            $score = (0.6 * $request['leads'])+(0.1 * $request['booth_traffic'])+(0.05 * $request['relevant'])+(0.1 * $request['promotional_assets'])+(0.05 * $request['nrg_social_mentions'])+(0.05 * $request['conf_social_mentions'])+(0.05 * $request['invite_open']);
            $score_update = SponsorshipSurvey::where('id',$survey->id)->update([
                'conference_score' => $score
            ]);
            return back()->with('success', 'Your survey has been submitted');
        }
    }

    public function conferenceList(Request $request){
        $currentyear = date('Y');
        $pastyear = date('Y') - 2;
        $lastyear = date('Y') - 1;
        return view('conferencelist', compact('lastyear', 'pastyear', 'currentyear'));
    }

    public function getCurrentConferenceList(Request $request){
        $conference = Conference::where('status_sm', 'Approved')
                                ->where('is_active', '0')
                                ->where('is_delete', '0')
                                ->orderBy('created_date', 'desc')->get();
        $conference->map(function ($conf) {
            $start_date = date("m/d/Y", strtotime($conf->conf_start));
            $end_date = date("m/d/Y", strtotime($conf->conf_end));
            $conf['conference_dates'] = $start_date.' - '.$end_date;

            $attendee_ind_score = Survey::where('conferenceid', $conf->id)->pluck('recommend')->toArray();
            if(count($attendee_ind_score) > 0){
                $att_score_avg = (array_sum($attendee_ind_score)) / (count($attendee_ind_score));
                $conf['avg_attendee_score'] = $att_score_avg;
            }
            else{
                $conf['avg_attendee_score'] = "N/A";
            }
            
        });
        return Datatables::of($conference)->make(true);
    }

    public function getLastYearConferenceList(Request $request){
        $lastYear = date('Y') - 1;
        $conference = Conference::where('status_sm', 'Approved')
                                ->where('is_active', '0')
                                ->where( DB::raw('YEAR(conf_end)'), '=', $lastYear)
                                ->where('is_delete', '0')
                                ->orderBy('created_date', 'desc')->get();
        $conference->map(function ($conf) {
            $start_date = date("m/d/Y", strtotime($conf->conf_start));
            $end_date = date("m/d/Y", strtotime($conf->conf_end));
            $conf['conference_dates'] = $start_date.' - '.$end_date;

            $attendee_ind_score = Survey::where('conferenceid', $conf->id)->pluck('recommend')->toArray();
            if(count($attendee_ind_score) > 0){
                $att_score_avg = (array_sum($attendee_ind_score)) / (count($attendee_ind_score));
                $conf['avg_attendee_score'] = $att_score_avg;
            }
            else{
                $conf['avg_attendee_score'] = "N/A";
            }
        });
        return Datatables::of($conference)->make(true);
    }

    public function getPastYearConferenceList(Request $request){
        $pastYear = date('Y') - 2;
        $conference = Conference::where('status_sm', 'Approved')
                                ->where('is_active', '0')
                                ->where( DB::raw('YEAR(conf_end)'), '=', $pastYear)
                                ->where('is_delete', '0')
                                ->orderBy('created_date', 'desc')->get();
        $conference->map(function ($conf) {
            $start_date = date("m/d/Y", strtotime($conf->conf_start));
            $end_date = date("m/d/Y", strtotime($conf->conf_end));
            $conf['conference_dates'] = $start_date.' - '.$end_date;

            $attendee_ind_score = Survey::where('conferenceid', $conf->id)->pluck('recommend')->toArray();
            if(count($attendee_ind_score) > 0){
                $att_score_avg = (array_sum($attendee_ind_score)) / (count($attendee_ind_score));
                $conf['avg_attendee_score'] = $att_score_avg;
            }
            else{
                $conf['avg_attendee_score'] = "N/A";
            }
        });
        return Datatables::of($conference)->make(true);
    }
}
