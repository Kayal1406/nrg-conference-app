<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;
use App\Conference; 

class FeedbackController extends Controller
{
    public function getFeedbackData(Request $request)
    {
        $conferenceid = Conference::where('conferencename', $request->cname)->value('id');
        $res = Survey::where('survey.conferenceid', $conferenceid )
            ->join('conference','survey.conferenceid','=','conference.id')
            ->join('standarduser','survey.user_id','=','standarduser.id')
            ->get();
    	return $res;
    }
}
