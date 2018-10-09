<?php

namespace App\Http\Controllers;

use App\Apply;
use Carbon\Carbon; 
use Datatables;

class UserController extends Controller
{
    public function attendedConference()
    {
    	$apply = Apply::whereDate('confend', '<=', Carbon::now())
                                ->where('status_m', 'Approved')
                                ->orderBy('created_date', 'desc')->get();
        return view('attendedconference',compact('apply'));
    }
    public function getdata()
    {
        $apply = Apply::whereDate('confend', '<=', Carbon::now())
                                ->where('status_m', 'Approved')
                                ->orderBy('created_date', 'desc')->get();
        return Datatables::of($apply)
            ->make(true);
    }
}
