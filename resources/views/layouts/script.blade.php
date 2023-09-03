<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // $(document).on('click', '#update_cuenta', function(e) {

    $(document).on('click', '#guardar_cuenta', function(e) {
        e.preventDefault();

        var nombre = $("#nombre_cuenta").val();
        var email = $("#email_cuenta").val().toLowerCase().trim();
        var telefono = $("#telefono_cuenta").val();

        $.ajax({
            url: "{{route('cuenta.store')}}",
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
        var ruta = "{{route('cuenta.show',['%idcuenta%'])}}";
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

        var ruta = "{{route('cuenta.update',['%idcuenta%'])}}";
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
</script>