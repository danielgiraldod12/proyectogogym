function editconf(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta accion editara este registro",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, editalo!',
    }).then(function (result) {
        if (result.isConfirmed) {
            document.getElementById('form').submit();
        }
    })
}



