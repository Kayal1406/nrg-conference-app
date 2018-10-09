<?php

namespace App\Http\Controllers;

use Request;
use DB;
use Input;
use Mail;
use App\Apply;
use Carbon\Carbon;
use App\Feedback;
use Response;

class SearchController extends Controller
{
    public function relativeSearch()
    {
        if(Request::ajax()) {
          	$data = Input::all();
	        $confInfo = DB::table('conference')->where('conferencename',$data['name'])->where('id', '!=', $data['id'])->orderBy('created_date', 'desc')->get();
	        return $confInfo;
        }
    }

    public function attendeeListDownload($id)
    {
        $conferenceid = Feedback::where('id', $id)->value('conferenceid');
        $filename = Feedback::where('id', $id)->value('upload_attendees');
        $file = public_path()."/uploads/feedback/attendees/$conferenceid/$filename";
        $headers = array(
                  'Content-Type: Attendee List',
                );
        return Response::download($file, 'Attendees_list.xlsx', $headers);
    }

    public function leadsListDownload($id)
    {
        $conferenceid = Feedback::where('id', $id)->value('conferenceid');
        $filename = Feedback::where('id', $id)->value('upload_leads');
        $file = public_path()."/uploads/feedback/leads/$conferenceid/$filename";
        $headers = array(
                  'Content-Type: Attendee List',
                );
        return Response::download($file, 'Leads_list.xlsx', $headers);
    }
}