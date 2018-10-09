<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
	protected $table="feedback";
    protected $fillable = ['id','user_id','conferenceid','conferencename','yourname','email','objective','attendees','results','recommendations','key_customers','actions', 'business_opportunities', 'other_opportunities', 'upload_attendees', 'upload_leads'];
    public $timestamps=false;
}
