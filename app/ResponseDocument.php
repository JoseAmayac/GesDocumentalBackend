<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseDocument extends Model
{
    protected $fillable = [
        'description','filePath','document_id'
    ];
}
