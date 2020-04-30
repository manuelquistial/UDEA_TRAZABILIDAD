@extends('layouts.app')

@section('title', Lang::get('titles.menu'))

@section('content')
<div class="row">
    <div class="col-sm-4 card-padding">
        <div class="card clickable" data-toggle="modal" data-target="#exampleModalCenter">
            <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4 card-padding">
        <div class="card clickable">
            <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4 card-padding">
        <div class="card clickable">
            <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4 card-padding">
        <div class="card clickable">
            <div class="card-body">
                <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                ...
            </div>
        </div>
    </div>
</div>  
@stop