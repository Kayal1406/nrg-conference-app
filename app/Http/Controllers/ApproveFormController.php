<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conference;
use App\Apply;
use Mail;
use Datatables;
use Crypt;
use App\User;

class ApproveFormController extends Controller
{
	public function approvereject()
	{
        $apply = Apply::where('status_sm', 'Pending')->orderBy('created_date', 'desc')->get();
		$conference = Conference::where('status_sm', 'Pending')->orderBy('created_date', 'desc')->get();
        return view('approvereject', compact('conference', 'apply'));
	}

    public function getconference()
    {
        $conference = Conference::select('conference.conferencename','conference.conferenceurl','conference.frequency','conference.user_id', 'conference.id', 'standarduser.firstname')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('status_sm', 'Pending')->orderBy('conference.created_date', 'desc')->get();
        return Datatables::of($conference)->make(true);
    }

    public function getapply()
    {
        $apply = Apply::where('status_sm', 'Pending')->orderBy('created_date', 'desc')->get();
        return Datatables::of($apply)->make(true);
    }

    public function approve($id)
    {
        $returnone = Conference::select('conference.conferencename','conference.conferenceurl','conference.email','conference.frequency','conference.user_id', 'conference.id', 'standarduser.firstname','conference.industry','conference.business','conference.frequency')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('status_sm', 'Pending')->where('conference.id', $id)->first();
        $dataone = json_decode($returnone, true);
        $email = User::where('id', 1)->value('email');

        $data = array('dataone' => $dataone, 'email' => $email);

        Mail::send('emails.userapprovalcreated', $data, function($message) use ($data){
            $message->to($data['dataone']['email']);
            $message->subject('Your New Conference Request Submission');
        });

        Conference::where('id', $id)->update(['status_sm' => 'Approved']); 

        // $freq_abbreviations = array("LOY" => "LESS THEN ONCE A YEAR",
        //                             "OAY" => "ONCE A YEAR",
        //                             "MTY" => "MULITIPLE TIMES A YEAR"
        //                             );
        // app('App\Http\Controllers\SalesforceController')->init();
        // $salesforce_response =  app('App\Http\Controllers\SalesforceController')
        //                 ->insert_record("Conference__c", array("name" => $dataone['conferencename'],
        //                         "url__c" => $dataone['conferenceurl'],
        //                         "industry__c" => $dataone['industry'],
        //                         "why_is_this_conference_relevant__c" => $dataone['business'],
        //                         "frequency__c" => $freq_abbreviations[$dataone['frequency']]
        //                         ));
        // $salesforce_json = json_decode($salesforce_response);
        // $test = Conference::where('id', $id)->update(['salesforce_id' => $salesforce_json->id]);

        return back()->with('success', 'Request has been Approved');
    } 
  
    public function reject($id)
    {
        $returnone = Conference::select('conference.conferencename','conference.conferenceurl','conference.email','conference.frequency','conference.user_id', 'conference.id', 'standarduser.firstname')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('status_sm', 'Pending')->where('conference.id', $id)->first();
        $conferencename=Conference::where('id', $id)->value('conferencename');
        $dataone = json_decode($returnone, true);
        $email = User::where('id', 1)->value('email');
        $data = array('dataone' => $dataone, 'email' => $email, 'conferencename' => $conferencename);   

        Mail::send('emails.userrejectioncreated', $data, function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Your New Conference Request Submission');
        });

        Conference::where('id', $id)->update(['status_sm' => 'Rejected']); 
        return back()->with('danger', 'Request has been Rejected');
    } 



    public function listview()
    {
        $conference = Conference::where('is_delete', '0')->where('status_sm', 'Approved')->orderBy('created_date', 'desc')->get();
        return view('supmng_pages.listview',compact('conference'));
    }

    public function getlist()
    {
        $conference = Conference::where('is_delete', '0')->where('status_sm', 'Approved')->orderBy('created_date', 'desc')->get();
        return Datatables::of($conference)
            ->make(true);
    } 



    public function approveNewConference($link)
    {
        $decrypted = Crypt::decryptString($link);
        $conference = Conference::select('conference.conferencename','conference.conferenceurl','conference.email','conference.frequency','conference.user_id', 'conference.id', 'standarduser.firstname')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('status_sm', 'Pending')->where('conference.id', $decrypted)->first();
        $dataone = json_decode($conference, true);
        $email = User::where('id', 1)->value('email');
        $data = array('dataone' => $dataone, 'email' => $email);

        $conference_status = Conference::where('id', $decrypted)->value('status_sm');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
                case 'Rejected':
                    return view('emails.alreadyrejected');
                    break;

                case 'Pending':
                    Mail::send('emails.userapprovalcreated', $data, function($message) use ($data){
                    $message->to($data['dataone']['email']);
                    $message->subject('Your New Conference Request Submission');
                    });

                    Conference::where('id', $decrypted)->update(['status_sm' => 'Approved']);
                    // $freq_abbreviations = array("LOY" => "LESS THEN ONCE A YEAR",
                    //                 "OAY" => "ONCE A YEAR",
                    //                 "MTY" => "MULITIPLE TIMES A YEAR"
                    //                 );
                    // app('App\Http\Controllers\SalesforceController')->init();
                    // $salesforce_response =  app('App\Http\Controllers\SalesforceController')
                    //                 ->insert_record("Conference__c", array("name" => $dataone['conferencename'],
                    //                         "url__c" => $dataone['conferenceurl'],
                    //                         "industry__c" => $dataone['industry'],
                    //                         "why_is_this_conference_relevant__c" => $dataone['business'],
                    //                         "frequency__c" => $freq_abbreviations[$dataone['frequency']]
                    //                         ));
                    // $salesforce_json = json_decode($salesforce_response);
                    // $test = Conference::where('id', $id)->update(['salesforce_id' => $salesforce_json->id]);
                    return view('emails.approved');                    
                }
    }

    public function rejectNewConference($link)
    {
        $decrypted = Crypt::decryptString($link);
        $conference = Conference::select('conference.conferencename','conference.conferenceurl','conference.email','conference.frequency','conference.user_id', 'conference.id', 'standarduser.firstname', 'standarduser.lastname', 'conference.description', 'conference.industry', 'conference.business', 'conference.frequency')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('status_sm', 'Pending')->where('conference.id', $decrypted)->first();
        $dataone = json_decode($conference, true);

        $conference_status = Conference::where('id', $decrypted)->value('status_sm');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
            case 'Rejected':
                return view('emails.alreadyrejected');
                break;

            case 'Pending':     
                return view('approve', compact('conference'));
                break;  
            }
    }   
    public function rejectNewConferencePost(Request $request, $id)
    {
        $reason= $request->input('reason');
        $decrypted = Crypt::decryptString($id);
        $conferencename=Conference::where('id', $decrypted)->value('conferencename');

        Conference::where('id', $decrypted)->update(['sm_remarks' => $reason, 'status_sm' => 'Rejected']);

        $returnone = Conference::select('conference.conferencename','conference.email', 'standarduser.firstname', 'conference.sm_remarks', 'conference.status_sm')
            ->join('standarduser','conference.user_id','=','standarduser.id')
            ->where('conference.id', $decrypted)->first();
        $dataone = json_decode($returnone, true);
        $email = User::where('id', 1)->value('email');
        $data = array('dataone' => $dataone, 'email' => $email, 'conferencename' => $conferencename);   
        
        Mail::send('emails.userrejectioncreated', $data, function($message) use ($data){
            $message->to($data['email']);
            $message->subject('Your New Conference Request Submission');
        });

        return view('emails.rejected');
    }
}
