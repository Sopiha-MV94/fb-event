<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FbApp
 *
 * @package App
 * @mixin Eloquent
 * @property string name
 * @property number fb_id
 * @property string key
 */
class FbApp extends Model
{
    protected $fillable = [
        'name',
        'fb_id',
        'key'
    ];

    public function fbEvents()
    {
        return $this->belongsToMany(FbEvent::class, 'fb_app_events')
            ->withPivot('value_to_sum', 'parameters');
    }

    public static function getRules()
    {
        return [
            'name' => 'required|string',
            'fb_id' => 'required|numeric',
        ];
    }

    public function fbAppEvents()
    {
        return $this->hasMany(FbAppEvent::class);
    }

    public function fbAppEventLogs()
    {
        return $this->hasManyThrough(FbAppEventLog::class, FbAppEvent::class);
    }
}
