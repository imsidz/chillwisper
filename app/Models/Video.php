<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function channel()
    {
        return $this->belongsTo(Channel::class, 'channel_id', 'id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_video', 'tag_id', 'video_id');
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'updated_at', 'publishedAt'];
}
