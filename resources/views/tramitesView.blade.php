@extends('layouts.app')

@section('title', Lang::get('titles.presolicitud'))

@section('content')
<div class="card">
    <div class="card-header" id="headingOne">
        <a class="float-left" data-toggle="collapse" href="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1">
            Collapsible Group Item #1
        </a>
        <a class="float-right" href="#">Verificar</a>
    </div>
    <div id="multiCollapseExample1" class="collapse multi-collapse">
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="#">{{Lang::get('stagesStrings')}}</a>
                    <span class="badge badge-primary badge-pill">Completado</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{Lang::get('stagesStrings')}}
                    <span class="badge badge-primary badge-pill">Corregido</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{Lang::get('stagesStrings')}}
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
            </ul>
       </div>
    </div>
</div> 
@stop