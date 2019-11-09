<?php
/**
 * @var object $shows
 */
?>

@extends('layouts.app')

@section('content')
<!-- Page Content -->
<div class="container">

    <!-- Page Heading -->
    <h1 class="my-4">TV Shows</h1>

    <div class="row justify-content-center">
        @foreach($shows as $show)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100">
                <a href="{{ generateShowUrl($show->id) }}"><img class="card-img-top" src="http://placehold.it/700x400" alt=""></a>
                <div class="card-body">
                    <h4 class="card-title text-center">
                        <a href="{{ generateShowUrl($show->id) }}">{{ $show->title }}</a>
                    </h4>
                    <p class="card-text">{{ $show->description }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- /.row -->

    {{--
    <!-- Pagination -->
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">1</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">2</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#">3</a>
        </li>
        <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>--}}

</div>
<!-- /.container -->
@endsection
