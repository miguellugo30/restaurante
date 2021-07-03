@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 ></h1>
@stop

@section('content')
    <div class="col viewResult"></div>
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModal"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary float-left" data-dismiss="modal"><i class="fas fa-times"></i> Cerrar</button>
                    <button type="button" class="btn btn-sm btn-primary" id="action"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
    <!-- MODAL -->
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="modalCuenta" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tituloModalCuenta"></h5>
                    <!--button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button-->
                </div>
                <div class="modal-body" id="modal-body-cuenta">

                </div>
                <div class="modal-footer">
                    <input type="hidden" name="mesa-id" id="mesa-id" value="">
                    <button type="button" class="btn btn-sm btn-danger float-left" id="cancelar" data-dismiss="modal"><i class="fas fa-times"></i> Cancelar</button>
                    <button type="button" class="btn btn-sm btn-danger float-left" id="eliminarMesa" ><i class="fas fa-trash-alt"></i> Eliminar Mesa</button>
                    <button type="button" class="btn btn-sm btn-warning float-left" id="cerrarCuenta"><i class="fas fa-times"></i> Cerrar Cuenta</button>
                    <button type="button" class="btn btn-sm btn-primary float-left" id="abrirCuenta"><i class="fas fa-edit"></i> Abrir Cuenta</button>
                    <button type="button" class="btn btn-sm btn-primary" id="saveCuenta"><i class="fas fa-save"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
    <!-- FIN MODAL -->
@stop

@section('css')

@stop

@section('js')
<script src="{{ asset('js/operacion.js') }}"></script>
@stop
