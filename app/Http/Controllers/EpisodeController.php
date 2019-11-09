<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Episodes;
use Intervention\Image\ImageManagerStatic as Image;

class EpisodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($showId)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Episodes::getValidationRules());

        $req = app('request');

        $showId = $request->get('show_id');
        if($req->hasfile('thumbnail'))
        {
            $pic = $req->file('thumbnail');
            $thumbnail = $showId . '_' . time() . '.' . $pic->getClientOriginalExtension();
            Image::make($pic)->resize(300, 300)->save( public_path('/uploads/episodes/thumbnails/' . $thumbnail) );
        }
        if($req->hasfile('video_content'))
        {
            $pic = $req->file('video_content');
            $videoContent = $showId . '_' . time() . '.' . $pic->getClientOriginalExtension();
            Image::make($pic)->resize(300, 300)->save( public_path('/uploads/episodes/video_content/' . $thumbnail) );
        }

        Episodes::addEpisode(
            $showId,
            $request->get('title'),
            $request->get('description'),
            $request->get('show_day'),
            $request->get('show_time'),
            $thumbnail??'default.png',
            $videoContent??'default.png'
        );

        return redirect('/shows/'.$showId.'/episodes')->with('success', 'TV Show saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
