<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CTA_SessionList extends Model
{
    protected $table = "cta_sessions_list";
    protected $fillable = [
        'cta_session_id',
        'title',
        'icon',
        'order',
        'active'
    ];

    public function cta_session()
    {
        return $this->belongsTo(CTA_Session::class,'cta_session_id','id');
    }
}
