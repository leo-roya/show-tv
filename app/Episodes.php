<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model
{
    protected $fillable = [
        'show_id',
        'ep_id',
        'title',
        'description',
        'show_day',
        'show_time',
        'thumbnail',
        'video_content',
    ];

    public static function getValidationRules()
    {
        return [
            'show_id'=>'required',
            'ep_id'=>'required',
            'title'=>'required',
            'description'=>'required',
            'show_day'=>'required',
            'show_time'=>'required',
            'thumbnail'=>'required',
            'video_content'=>'required',
        ];
    }

    public static function addEpisode($showId, $title, $description, $showDay, $showTime, $thumbnail, $videoContent)
    {
        $epId = static::where('show_id', $showId)->orderBy('ep_id', 'desc')->limit(1)->get()[0]->ep_id??1;

        $show = new static([
            'show_id'=>$showId,
            'ep_id'=>$epId,
            'title'=>$title,
            'description'=>$description,
            'show_day'=>$showDay,
            'show_time'=>$showTime,
            'thumbnail'=>$thumbnail,
            'video_content'=>$videoContent,
        ]);
        $show->save();
    }
}
