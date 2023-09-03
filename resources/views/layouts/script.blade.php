<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    /**Cuentas */
    $(document).on('click', '#guardar_cuenta', function(e) {
        e.preventDefault();

        var nombre = $("#nombre_cuenta").val();
        var email = $("#email_cuenta").val().toLowerCase().trim();
        var telefono = $("#telefono_cuenta").val();

        $.ajax({
            url: "{{route('cuentas.store')}}",
            type: "POST",
            data: {
                nombre: nombre,
                email: email,
                telefono: telefono
            },
            success:function(data) {
                if(data.success) {
                    $('#modal_nueva_cuenta').modal('hide');
                    $('#form_cuenta_nueva')[0].reset();
                    $('.table').load(location.href + ' .table');
                }
            }
        })
    });

    $(document).on('click', '.show_cuenta', function(e) {
        var id = $(this).data('id');
        var ruta = "{{route('cuentas.show',['%idcuenta%'])}}";
        ruta = ruta.replace('%idcuenta%',id);

        $.get(ruta, function(cuenta) {
            $('#up_cuenta_id').val(cuenta._id);
            $('#up_nombre_cuenta').val(cuenta.nombre);
            $('#up_email_cuenta').val(cuenta.email);
            $('#up_telefono_cuenta').val(cuenta.telefono);
            $('#modal_update_cuenta').modal('toggle');
        });
    });

    $(document).on('click', '#update_cuenta', function(e) {
        e.preventDefault();

        var id = $('#up_cuenta_id').val();
        var nombre = $('#up_nombre_cuenta').val();
        var email = $('#up_email_cuenta').val();
        var telefono = $('#up_telefono_cuenta').val();

        var ruta = "{{route('cuentas.update',['%idcuenta%'])}}";
        ruta = ruta.replace('%idcuenta%',id);

        $.ajax({
            url: ruta,
            type: "PUT",
            data: {
                nombre: nombre,
                email: email,
                telefono: telefono
            },
            success:function(data) {
                if(data.success) {
                    $('#modal_update_cuenta').modal('hide');
                    $('#form_cuenta_update')[0].reset();
                    $('.table').load(location.href + ' .table');
                }
            }
        });

    });

    $(document).on('click', '.delete_cuenta', function(e) {
        var id = $(this).data('id');
        var ruta = "{{route('cuentas.destroy',['%idcuenta%'])}}";
        ruta = ruta.replace('%idcuenta%',id);

        if(confirm("Es una accion permanente")) {
            $.ajax({
                url: ruta,
                type: "DELETE",
                success:function(data) {
                    $('#cid'+id).remove();
                }
            });
        }
    });

    /**Pedidos */
    function valor_total() {
        var cantidad = Number($('#cantidad_pedido').val());
        var valor = Number($('#valor_pedido').val());        
        var resultado = valor*cantidad;

        $('#total_pedido').val(resultado);
    }

    function up_valor_total() {
        var cantidad = Number($('#up_cantidad_pedido').val());
        var valor = Number($('#up_valor_pedido').val());        
        var resultado = valor*cantidad;

        $('#up_total_pedido').val(resultado);
    }

    $(document).on('click', '#guardar_pedido', function(e) {
        e.preventDefault();

        var cuenta_id = $("#cuenta_pedido option:selected").val();
        var producto = $("#producto_pedido").val();
        var cantidad = $("#cantidad_pedido").val();
        var valor = $("#valor_pedido").val();
        var total_pedido = $("#total_pedido").val();

        $.ajax({
            url: "{{route('pedidos.store')}}",
            type: "POST",
            data: {
                cuenta_id: cuenta_id,
                producto: producto,
                cantidad: cantidad,
                valor: valor,
                total_pedido: total_pedido
            },
            success:function(data) {
                if(data.success) {
                    $('#modal_nuevo_pedido').modal('hide');
                    $('#form_pedido_nuevo')[0].reset();
                    $('.table').load(location.href + ' .table');
                }
            }
        })
    });

    $(document).on('click', '.show_pedido', function(e) {
        var id = $(this).data('id');
        var ruta = "{{route('pedidos.show',['%idPedido%'])}}";
        ruta = ruta.replace('%idPedido%',id);

        $.get(ruta, function(pedido) {
            console.log(pedido);
            $('#up_pedido_id').val(pedido._id);
            $('#up_cuenta_pedido option[value='+pedido.cuenta_id+']').prop("selected", true);
            $('#up_producto_pedido').val(pedido.producto);
            $('#up_cantidad_pedido').val(pedido.cantidad);
            $('#up_valor_pedido').val(pedido.valor);
            $('#up_total_pedido').val(pedido.total);
            $('#modal_update_pedido').modal('toggle');
        });
    });

    $(document).on('click', '#update_pedido', function(e) {
        e.preventDefault();

        var id = $('#up_pedido_id').val();
        var cuenta_id = $('#up_cuenta_pedido').val();
        var producto = $('#up_producto_pedido').val();
        var cantidad = $('#up_cantidad_pedido').val();
        var valor = $('#up_valor_pedido').val();
        var total_pedido = $('#up_total_pedido').val();

        var ruta = "{{route('pedidos.update',['%idPedido%'])}}";
        ruta = ruta.replace('%idPedido%',id);

        $.ajax({
            url: ruta,
            type: "PUT",
            data: {
                cuenta_id: cuenta_id,
                producto: producto,
                cantidad: cantidad,
                valor: valor,
                total_pedido: total_pedido
            },
            success:function(data) {
                if(data.success) {
                    $('#modal_update_pedido').modal('hide');
                    $('#form_pedido_update')[0].reset();
                    $('.table').load(location.href + ' .table');
                }
            }
        });

    });

    $(document).on('click', '.delete_pedido', function(e) {
        var id = $(this).data('id');
        var ruta = "{{route('pedidos.destroy',['%idPedido%'])}}";
        ruta = ruta.replace('%idPedido%',id);

        if(confirm("Es una accion permanente")) {
            $.ajax({
                url: ruta,
                type: "DELETE",
                success:function(data) {
                    $('#pid'+id).remove();
                }
            });
        }
    });
</script>