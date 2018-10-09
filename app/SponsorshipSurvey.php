<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorshipSurvey extends Model
{
    public $table="sponsorship_survey";
    public $fillable = ['conference_id','conference_score','user_id','sponsorship_costs','is_speaker','leads','booth_traffic','relevant','promotional_assets','conf_social_mentions', 'invite_open', 'is_delete','nrg_social_mentions','created_by','created_date','updated_by','updated_date','is_delete'];
    public $timestamps=false;
}
