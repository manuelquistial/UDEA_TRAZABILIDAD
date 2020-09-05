@extends('layouts.lateralMenu.tipoTransaccionView')

@section('content')
<div class="modal-header">
    <div class="col-6 conf-header">
        <h5>{{ Lang::get('strings.menu_superior.correos') }}</h5>
    </div>
</div>
<div class="card-body">
    <div class="table-responsive-sm">
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>{{ Lang::get('strings.correos.codigos') }}</th>
                    <th>{{ Lang::get('strings.correos.estado') }}</th>
                </tr>
            </thead>
            <tbody id="items_tabla">
                
            </tbody>
        </table>
        <nav aria-label="Page navigation tipo transaccion" id="paginacion">
            
        </nav>
    </div>
</div>
@stop