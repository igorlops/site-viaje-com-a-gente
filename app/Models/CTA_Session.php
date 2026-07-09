<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CTA_Session extends Model
{
    protected $table = "cta_sessions";
    protected $fillable = [
        'page_id',
        'title',
        'subtitle',
        'button_label',
        'button_url',
        'button_target',
        'button_variant',
        'button_icon',
        'secondary_button_label',
        'secondary_button_url',
        'secondary_button_target',
        'secondary_button_variant',
        'bg_color',
        'text_color',
        'alignment',
        'padding_vertical',
        'analytics_event_name',
        'order_position',
        'active'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function cta_session_list()
    {
        return $this->hasMany(CTA_SessionList::class,'id','cta_session_id');
    }
}
