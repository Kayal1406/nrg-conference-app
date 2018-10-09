<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table="apply";

    protected $fillable = ['firstname',
    'lastname',
    'phone',
    'another_phone',
    'email',
    'another_email',
    'user_id',
    'mngemail',
    'conferenceid',
    'confname',
    'conf_frequency',
    'confstart',
    'confend',
    'confurl',
    'travelstart',
    'travelend',
    'conf_cost',
    'travel_cost',
    'conf_location',
    'conf_city',
    'attendees_travelling',
    'description',
    'deliverables',
    'role',
    'sponsoring_cost',
    'business',
    'benefits',
    'industry',
    'audience',
    'admin_remarks',
    'manager_remarks',
    'status_m',
    'status_sm',
    'created_by',
    'created_date',
    'modified_by',
    'modified_date',
    'is_delete'];
	
	public $timestamps=false;
}
