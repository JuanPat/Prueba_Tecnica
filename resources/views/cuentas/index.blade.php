@extends('layouts.base')
@section('titulo', 'Cuentas')
@section('contenido')
    @if(count($cuentas) > 0)
        <div style="margin-bottom: 20px;">
            <h1>Lista de Cuentas</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_nueva_cuenta">Nueva Cuenta</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cuentas as $cuenta)
                    <tr id="cid{{$cuenta->_id}}">
                        <td>{{$cuenta->nombre}}</td>
                        <td>{{$cuenta->email}}</td>
                        <td>{{$cuenta->telefono}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm show_cuenta" data-id="{{$cuenta->id}}">Editar</button>
                            <button type="button" class="btn btn-danger btn-sm delete_cuenta" data-id="{{$cuenta->id}}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <center>
            <h2>Actualmente no hay datos</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_nueva_cuenta">Nueva Cuenta</button>
        </center>
    @endif

    <div class="modal fade" id="modal_nueva_cuenta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nueva Cuenta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_cuenta_nueva">
                        @csrf
                        <div class="mb-3">
                            <label for="nombre_cuenta" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre_cuenta" />
                        </div>
                        <div class="mb-3">
                            <label for="email_cuenta" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email_cuenta" />
                        </div>
                        <div class="mb-3">
                            <label for="telefono_cuenta" class="form-label">Teléfono</label>
                            <input type="number" class="form-control" id="telefono_cuenta" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_cuenta">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_update_cuenta" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Cuenta</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_cuenta_update">
                        @csrf
                        <input type="hidden" id="up_cuenta_id">
                        <div class="mb-3">
                            <label for="up_nombre_cuenta" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="up_nombre_cuenta" />
                        </div>
                        <div class="mb-3">
                            <label for="up_email_cuenta" class="form-label">Email</label>
                            <input type="email" class="form-control" id="up_email_cuenta" />
                        </div>
                        <div class="mb-3">
                            <label for="up_telefono_cuenta" class="form-label">Teléfono</label>
                            <input type="number" class="form-control" id="up_telefono_cuenta" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="update_cuenta">Actualizar</button>
                </div>
            </div>
        </div>
    </div>
@endsection