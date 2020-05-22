<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'name','description','filePath','status','dependency_id'
    ];

    public function response(){
        return $this->hasOne(ResponseDocument::class);
    }

    public function dependency(){
        return $this->belongsTo(Dependency::class);
    }
}
