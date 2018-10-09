<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StandardUser extends Model
{
    public $table="standarduser";
    public $fillable = ['firstname','lastname','useremail','manager_firstname','manager_lastname','manager_email','created_by','created_date','modified_by','modified_date','is_delete'];
    public $timestamps=false;
}
