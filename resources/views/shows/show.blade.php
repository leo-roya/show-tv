<?php
/**
 * @var \App\Shows $show
 * @var object $episode
 */
?>

@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

    <!-- Portfolio Item Heading -->
    <h1 class="my-4">{{ $show['title'] }}</h1>

    <!-- Portfolio Item Row -->
    <div class="row">

        <div class="col-md-8">
            <img class="img-fluid" src="http://placehold.it/750x500" alt="">
        </div>

        <div class="col-md-4">
            <h3 class="my-3">{{ $show['title'] }}</h3>
            <p>{{ $show['description'] }}</p>
            <h3 class="my-3">Airing Time</h3>
            <p>{{ $show['day_start_txt'] }} - {{ $show['day_end_txt'] }} @ {{ $show['show_time_12'] }}</p>
        </div>

    </div>
    <!-- /.row -->

    <!-- Episodes -->
    <h3 class="my-4">Episodes</h3>

    <div class="row">

        @foreach($episodes as $episode)
        <div class="col-md-3 col-sm-6 mb-4">
            <a href="#">
                <img class="img-fluid" src="http://placehold.it/500x300" alt="">
            </a>
        </div>
        @endforeach

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection
