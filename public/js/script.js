$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#guardar_cuenta").click(function(e) {
    debugger;
    e.preventDefault();

    var nombre = $("#nombre_cuenta").val();
    var email = $("#email_cuenta").val();
    var telefono = $("#telefono_cuenta").val();

    $.ajax({
        url:"{{route('cuenta.store')}}",
        type: "POST",
        data: {
            nombre: nombre,
            email: email,
            telefono: telefono
        },
        success:function(data) {
            console.log(data);
        }
    })
});