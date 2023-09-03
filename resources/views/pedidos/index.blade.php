@extends('layouts.base')
@section('titulo', 'Pedidos')
@section('contenido')
    @if(count($pedidos) > 0)
        <div style="margin-bottom: 20px;">
            <h1>Lista de Pedidos</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_nuevo_pedido">Nueva Pedido</button>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre de la cuenta</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Valor</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedidos as $pedido)
                    <tr id="pid{{$pedido->_id}}">
                        <td>{{!empty($pedido->cuenta->nombre) ? $pedido->cuenta->nombre : 'Sin Asignar'}}</td>
                        <td>{{$pedido->producto}}</td>
                        <td>{{$pedido->cantidad}}</td>
                        <td>{{"$".number_format($pedido->valor, 0, ",", ".")}}</td>
                        <td>{{"$".number_format($pedido->total, 0, ",", ".")}}</td>
                        <td>
                            <button type="button" class="btn btn-success btn-sm show_pedido" data-id="{{$pedido->id}}">Editar</button>
                            <button type="button" class="btn btn-danger btn-sm delete_pedido" data-id="{{$pedido->id}}">Eliminar</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <center>
            <h2>Actualmente no hay datos</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal_nuevo_pedido">Nueva Pedido</button>
        </center>
    @endif

    <div class="modal fade" id="modal_nuevo_pedido" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_pedido_nuevo">
                        @csrf
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" id="cuenta_pedido">
                                <option selected disabled>Cuentas</option>
                                @foreach($cuentas as $cuenta)
                                    <option value="{{$cuenta->_id}}">{{$cuenta->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="producto_pedido" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="producto_pedido" />
                        </div>
                        <div class="mb-3">
                            <label for="cantidad_pedido" class="form-label">Cantidad</label>
                            <input type="number" class="form-control monto" id="cantidad_pedido" onKeyUp="valor_total()"/>
                        </div>
                        <div class="mb-3">
                            <label for="valor_pedido" class="form-label">Valor</label>
                            <input type="number" class="form-control monto" id="valor_pedido" onKeyUp="valor_total()"/>
                        </div>
                        <div class="mb-3">
                            <label for="total_pedido" class="form-label">Total</label>
                            <input type="number" class="form-control monto" id="total_pedido" disabled/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="guardar_pedido">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal_update_pedido" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Pedido</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form_pedido_update">
                        @csrf
                        <input type="hidden" id="up_pedido_id">
                        <div class="mb-3">
                            <select class="form-select" aria-label="Default select example" id="up_cuenta_pedido">
                                <option selected disabled>Cuentas</option>
                                @foreach($cuentas as $cuenta)
                                    <option value="{{$cuenta->_id}}">{{$cuenta->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="up_producto_pedido" class="form-label">Producto</label>
                            <input type="text" class="form-control" id="up_producto_pedido" />
                        </div>
                        <div class="mb-3">
                            <label for="up_cantidad_pedido" class="form-label">Cantidad</label>
                            <input type="number" class="form-control monto" id="up_cantidad_pedido" onKeyUp="up_valor_total()"/>
                        </div>
                        <div class="mb-3">
                            <label for="up_valor_pedido" class="form-label">Valor</label>
                            <input type="number" class="form-control monto" id="up_valor_pedido" onKeyUp="up_valor_total()"/>
                        </div>
                        <div class="mb-3">
                            <label for="up_total_pedido" class="form-label">Total</label>
                            <input type="number" class="form-control monto" id="up_total_pedido" disabled/>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="update_pedido">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection