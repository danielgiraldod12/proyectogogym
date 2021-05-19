/**
 * La funcion espera que le respondan en la confirmacion de los mensajes,
 * si se devuelve un "isConfirmed", ejecutara el submit del formulario automaticamente,
 * si no, simplemente se cerrara la confirmacion.
 * @param event
 */

function editconf(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Estas seguro?',
        text: "Esta accion editara este registro",
        icon: 'info',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, editalo!',
    }).then(function (result) {
        if (result.isConfirmed) {
            document.getElementById('form').submit();
        }
    })
}
/**
 * La funcion espera que le respondan en la confirmacion de los mensajes,
 * si se devuelve un "isConfirmed", ejecutara el submit del formulario automaticamente,
 * si no, simplemente se cerrara la confirmacion.
 * @param event
 */

function editrol(event) {
    event.preventDefault();
    Swal.fire({
        title: 'Estas seguro?',
        icon: 'info',
        showCancelButton: true,
        cancelButtonText: "Cancelar",
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, editalo!',
    }).then(function (result) {
        if (result.isConfirmed) {
            document.getElementById('form').submit();
        }
    })
}



