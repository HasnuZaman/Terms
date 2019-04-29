<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    //TableName
    protected $table = "terms";
    //table promarykey
    protected $primaryKey = "term_id";
    //table timestamp
    public $timestamps = true;
}
