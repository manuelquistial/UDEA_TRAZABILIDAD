@extends('layouts.app')

@section('title', Lang::get('titles.general'))

@section('content')
    <form>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Nombre del proyecto</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Acta de compromiso</label>
            <select class="form-control" id="exampleFormControlSelect1">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Valor</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descripcion de solicitud</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputFile">Adjuntar archivo</label>
            <input type="file" class="form-control-file" id="exampleFormControlFile1">
            <small class="form-text text-muted">
                Nota
            </small>
        </div>
        <div class="float-right"><button type="submit" class="btn btn-light">Recibido</button></div>
        <div class="float-right"><button type="submit" class="btn btn-light">Correcion</button></div>
    </form>
@stop