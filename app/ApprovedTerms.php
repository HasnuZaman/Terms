<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApprovedTerms extends Model
{
    //
    //TableName
    protected $table = "approved_terms";
    //table promarykey
    protected $primaryKey = "id";
    //table timestamp
    public $timestamps = true;
}
