<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    public $table="notes";
    public $fillable = ['conferenceid','username','useremail','notes','created_by','created_date','modified_by','modified_date','is_delete'];
    public $timestamps=false;
}
