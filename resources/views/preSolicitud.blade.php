@extends('layouts.app')

@section('title', Lang::get('titles.presolicitud'))

@section('content')
<div class="row">
    <div class="list col-md-12 clickable" data-toggle="modal" data-target="#exampleModalCenter">
        <div class="float-left ">Proceso X</div>
        <div class="float-right">En proceso</div>
    </div>
    <div class="list col-md-12 clickable">
        <div class="float-left">Proceso Y</div>
        <div class="float-right">Confirmado</div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
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
            </div>
        </div>
    </div>
</div>  
@stop