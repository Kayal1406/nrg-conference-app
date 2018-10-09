<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
	public $table="conference";
    public $fillable = ['firstname',
    'lastname',
    'email',
    'conferencename',
    'conference_score',
    'conferenceurl',
    'description',
    'user_id',
    'conf_start',
    'conf_end',
    'travel_start',
    'travel_end',
    'location',
    'industry',
    'business',
    'frequency',
    'phone',
    'conference_cost',
    'another_phone',
    'another_email',
    'manager',
    'travel_cost',
    'travel_city',
    'nrg_past',
    'attendees_travelling',
    'role',
    'sponsoring_cost',
    'benefits',
    'deliverables',
    'audience',
    'manager_remarks',
    'status_m',
    'status_sm',
    'is_active',
    'salesforce_id',
    'created_by',
    'created_date',
    'modified_by',
    'modified_date',
    'is_delete'
    ];
    public $timestamps=false;
}
