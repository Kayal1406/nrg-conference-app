<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salesforce extends Model
{
    public $table="users";
    public $fillable = ['salesforce_token'];
    public $timestamps=false;
}
