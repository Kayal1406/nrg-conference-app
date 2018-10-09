<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    public $table="survey";
    public $fillable = ['reason','competitors','conference_costs','conference_expenses','scheduled','attended','personal_contacts','elaborateno','additional_plans','recommend','attendees','companies','created_at','updated_at','is_delete', 'conferenceid', 'user_id'];
    public $timestamps=false;
}
