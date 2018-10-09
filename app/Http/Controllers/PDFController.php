<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Feedback;

class PDFController extends Controller
{
    public function getPDF()
    {
		$includeFile = Feedback::getPdfRendererPath();
    	$feedback = Feedback::all();
    	return Excel::create('consolidated_feedback', function($excel) use ($feedback) {
			$excel->sheet('mySheet', function($sheet) use ($feedback)
	        {
				$sheet->fromArray($feedback);
	        });
		})->download('pdf');

    }
}
