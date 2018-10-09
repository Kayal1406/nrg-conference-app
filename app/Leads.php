<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leads extends Model
{
    public $table="leads";
    public $fillable = ['conferenceid','user_id','firstname','lastname','title','company','email','phone','notes','created_by','created_date','modified_by','modified_date','is_delete','potential','sendleads','salesforce_id'];
    public $timestamps=false;
}
