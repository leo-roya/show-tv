<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class Shows extends Model
{
    protected $fillable = [
        'title',
        'description',
        'day_start',
        'day_end',
        'show_time',
        'active',
    ];

    const SHOW_DAYS=[
        '1' => 'Sunday',
        '2' => 'Monday',
        '3' => 'Tuesday',
        '4' => 'Wednesday',
        '5' => 'Thursday',
        '6' => 'Friday',
        '7' => 'Saturday',
    ];
    const SHOW_INFO_KEY = 'show_info_';

    public static function getValidationRules()
    {
        return [
            'title'=>'required',
            'description'=>'required',
            'day_start'=>'required',
            'day_end'=>'required',
            'show_time'=>'required',
        ];
    }

    /**
     * Add a New Show
     * @param string $title
     * @param string $description
     * @param integer $dayStart
     * @param integer $dayEnd
     * @param string $showTime
     * @param boolean $active
     */
    public static function addShow($title, $description, $dayStart, $dayEnd, $showTime, $active)
    {
        $show = new static([
            'title' => $title,
            'description' => $description,
            'day_start' => $dayStart,
            'day_end' => $dayEnd,
            'show_time' => $showTime,
            'active' => $active
        ]);
        $show->save();
    }

    /**
     * Update Show Information
     * @param integer $id
     * @param string $title
     * @param string $description
     * @param integer $dayStart
     * @param integer $dayEnd
     * @param string $showTime
     * @param boolean $active
     */
    public static function updateShow($id, $title, $description, $dayStart, $dayEnd, $showTime, $active)
    {
        $show = static::find($id);

        $show->title = $title;
        $show->description = $description;
        $show->day_start = $dayStart;
        $show->day_end = $dayEnd;
        $show->show_time = $showTime;
        $show->active = $active??0;
        $show->save();

        //Flush show cache
        static::flushShowInfo($id);
    }

    public static function getShowInfo($id)
    {
        $cacheKey = static::SHOW_INFO_KEY.$id;
        $showInfo = json_decode(Redis::get($cacheKey), true);

        if(empty($showInfo))
        {
            $show = Shows::find($id);
            $showInfo = [
                'id' => $show->id,
                'title' => $show->title,
                'description' => $show->description,
                'day_start_txt' => static::SHOW_DAYS[$show->day_start],
                'day_end_txt' => static::SHOW_DAYS[$show->day_end],
                'show_time' => $show->show_time,
                'show_time_12' => date("h:i A", strtotime($show->show_time)),
            ];

            Redis::set($cacheKey, json_encode($showInfo));
        }
        return $showInfo;
    }

    /**
     * Flush Show Info
     * @param integer $id
     */
    public static function flushShowInfo($id)
    {
        Redis::del(static::SHOW_INFO_KEY.$id);
    }

    /**
     * @param bool $activeOnly Only active shows
     * @param bool $random To get random shows
     * @return mixed
     */
    public static function getShows($activeOnly=false, $random=false)
    {
        $shows = Shows::when($activeOnly, function ($query) {
            return $query->where('active', 1);
        })->when($random, function ($query) {
            return $query->limit(5);
        })
        ->get();

        return $shows;
    }
}
