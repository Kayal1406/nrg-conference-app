<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Apply;
use Input;
use Crypt;
use Mail;
use App\Conference;
use Datatables;
use App\User;

class AppliedConferenceController extends Controller
{
    public function approve($id)
    {
        $returnone = Apply::find($id);
        $dataone = json_decode($returnone, true);

        $conferenceid = $dataone['conferenceid'];
        $attendees = Apply::where('conferenceid', $conferenceid)->where('id', '!=', $id)->where('status_m', 'Approved')->orderBy('created_date', 'desc')->get();
        $attendeesone = json_decode($attendees, true);
        $email = User::where('id', 1)->value('email');

        $data = array('formdata' => $dataone, 'participants' => $attendeesone, 'email' => $email);

        Mail::send('emails.managermail', $data, function($message) use ($data){
            $message->from($data['email']);
            $message->to($data['formdata']['mngemail']);
            $message->subject('REVIEW NEEDED: Conference Request Submission');
        });

        $apply = Apply::where('id', $id)->update(['status_sm' => 'Approved']);
        return back()->with('success', 'Thanks! Request has been Approved!');
    }
    
    public function reject($id)
    {
        $returnone = Apply::find($id);
        $dataone = json_decode($returnone, true);

        Mail::send('emails.userrejection', $dataone, function($message) use ($dataone){
            $message->to($dataone['email']);
            $message->subject('Your conference request');
        });

        Apply::where('id', $id)->update(['status_sm' => 'Rejected']);
        return back()->with('danger', 'Request has been Rejected');
    }

    public function ApproveAppliedConference($id)
    {
        $decrypted = Crypt::decryptString($id);

        $returnone = Apply::find($decrypted);
        $dataone = json_decode($returnone, true);

        $conference_status = Apply::where('id', $decrypted)->value('status_sm');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
            case 'Rejected':
                return view('emails.alreadyrejected');
                break;

            case 'Pending':
                $conferenceid = $dataone['conferenceid'];
                $attendees = Apply::where('conferenceid', $conferenceid)->where('id', '!=', $decrypted)->where('status_m', 'Approved')->get();
                $attendeesone = json_decode($attendees, true);
                $email = User::where('id', 1)->value('email');

                $data = array('formdata' => $dataone, 'participants' => $attendeesone, 'email' => $email);

                Mail::send('emails.managermail', $data, function($message) use ($data){
                    $message->from($data['email']);
                    $message->to($data['formdata']['mngemail']);
                    $message->subject('REVIEW NEEDED: Conference Request Submission');
                });

                Apply::where('id', $decrypted)->update(['status_sm' => 'Approved']);
                return view('emails.approved');
            }
        }

        public function RejectAppliedConference($id)
        {
        $decrypted = Crypt::decryptString($id);
        $returnone = Apply::find($decrypted);
        $dataone = json_decode($returnone, true);

        $conference_status = Apply::where('id', $decrypted)->value('status_sm');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
            case 'Rejected':
                return view('emails.alreadyrejected');
                break;

            case 'Pending':
                $apply = Apply::find($decrypted);
                return view('emails.admin_rejecting_applied', compact('apply'));
                }
        }

        public function RejectAppliedConferencePost(Request $request, $id)
        {

            $reason= $request->input('reason');
            $decrypted = Crypt::decryptString($id);

            Apply::where('id', $decrypted)->update(['admin_remarks' => $reason, 'status_sm' => 'Rejected']);

            $returnone = Apply::find($decrypted);
            $dataone = json_decode($returnone, true);

            Mail::send('emails.userrejection', $dataone, function($message) use ($dataone){
                $message->to($dataone['email']);
                $message->subject('Your conference request');
            });

            return view('emails.rejected');
        }

        public function managerApproveAppliedConference($id)
        {
        $decrypted = Crypt::decryptString($id);

        $returnone = Apply::find($decrypted);
        $dataone = json_decode($returnone, true);

        $conference_status = Apply::where('id', $decrypted)->value('status_m');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
            case 'Rejected':
                return view('emails.alreadyrejected');
                break;

            case 'Pending':

                Mail::send('emails.userapproval', $dataone, function($message) use ($dataone){
                    $message->to($dataone['email']);
                    $message->subject('Your conference request');
                });

                Apply::where('id', $decrypted)->update(['status_m' => 'Approved']);
                return view('emails.approved');
            }
        }

        public function managerRejectAppliedConference($id)
        {
        $decrypted = Crypt::decryptString($id);
        $returnone = Apply::find($decrypted);
        $dataone = json_decode($returnone, true);

        $conference_status = Apply::where('id', $decrypted)->value('status_m');

        switch ($conference_status) {
            case 'Approved':
                return view('emails.alreadyapproved');
                break;
                
            case 'Rejected':
                return view('emails.alreadyrejected');
                break;

            case 'Pending':
                $apply = Apply::find($decrypted);
                return view('managerapprove', compact('apply'));
                }
        }

        public function managerRejectAppliedConferencePost(Request $request, $id)
        {

            $reason= $request->input('reason');
            $decrypted = Crypt::decryptString($id);

            Apply::where('id', $decrypted)->update(['manager_remarks' => $reason, 'status_m' => 'Rejected']);

            $returnone = Apply::find($decrypted);
            $dataone = json_decode($returnone, true);

            Mail::send('emails.manager_userrejection', $dataone, function($message) use ($dataone){
                $message->to($dataone['email']);
                $message->subject('Your conference request');
            });
            return view('emails.rejected');
        }
}