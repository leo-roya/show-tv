<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shows;

class ShowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shows = Shows::getShows(true);
        return view('shows.index', compact('shows'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shows.create', ['show_days'=>Shows::SHOW_DAYS]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Shows::getValidationRules());

        Shows::addShow(
            $request->get('title'),
            $request->get('description'),
            $request->get('day_start'),
            $request->get('day_end'),
            $request->get('show_time'),
            $request->get('active')
        );

        return redirect('/shows')->with('success', 'TV Show saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = Shows::getShowInfo($id);

        //Get episodes
        $episodes = [];

        return view('shows.show', ['show'=>$show, 'episodes'=>$episodes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $show = Shows::find($id);
        return view('shows.edit', ['show'=>$show, 'show_days'=>Shows::SHOW_DAYS]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(Shows::getValidationRules());

        Shows::updateShow(
            $id,
            $request->get('title'),
            $request->get('description'),
            $request->get('day_start'),
            $request->get('day_end'),
            $request->get('show_time'),
            $request->get('active')
        );
        return redirect('/shows')->with('success', 'Show updated!');
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
