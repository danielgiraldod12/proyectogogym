/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta destroy con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se elimino
 * correctamente
 * @param id
 */

function deleteUser(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('destroy', id),
                type: 'delete',
                success(res) {
                    if (res) {
                        Swal.fire(
                            'Eliminado!',
                            'Este registro ha sido eliminado!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta destroyasistencia con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se elimino
 * correctamente
 * @param id
 */

function deleteAsist(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('destroyasistencia', id),
                type: 'delete',
                success(res) {
                    if (res) {
                        Swal.fire(
                            'Eliminado!',
                            'Este registro ha sido eliminado!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax que apunta a la ruta createasistencia con
 * el id como parametro, y si la asistencia se crea satisfactoriamente saldra un mensaje
 * que dira que la asistencia se creo satisfactoriamente.
 * @param id
 */

function asistUser(id)
{
    Swal.fire({
        title: 'Estas seguro?',
        text: "No te preocupes, puedes eliminar la asistencia cuando quieras!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, creala!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('createasistencia', id),
                type: 'post',
                success(res) {
                    if (res){
                        Swal.fire(
                            'Asistencia creada!',
                            'Se ha creado una nueva asistencia!.',
                            'success',
                        )
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta destroyrn con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se elimino
 * correctamente
 * @param id
 */

function deleteRecord(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('destroyrn', id),
                type: 'delete',
                success(res) {
                    if (res) {
                        Swal.fire(
                            'Eliminado!',
                            'Este registro ha sido eliminado!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta destroyevents con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se elimino
 * correctamente
 * @param id
 */

function deleteEvent(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('destroyevents', id),
                type: 'delete',
                success(res) {
                    if (res) {
                        Swal.fire(
                            'Eliminado!',
                            'Este registro ha sido eliminado!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta destroyprog con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se elimino
 * correctamente
 * @param id
 */

function deleteProgram(id) {
    Swal.fire({
        title: '¿Estas seguro?',
        text: "No podras revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminalo!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('destroyprog', id),
                type: 'delete',
                success(res) {
                    if (res) {
                        Swal.fire(
                            'Eliminado!',
                            'Este registro ha sido eliminado!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta accept con el id como
 * parametro, y si el proceso de aceptar solicitud se ejecuta satisfactoriamente se recargara la
 * tabla sin tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se
 * elimino correctamente
 * @param id
 */
function accept(id)
{
    Swal.fire({
        title: 'Aceptar usuario?',
        text: "No te preocupes, puedes eliminar este usuario cuando quieras!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, creala!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('accept', id),
                type: 'post',
                success(res) {
                    if (res){
                        Swal.fire(
                            'Usuario aceptado!',
                            'Se ha creado un nuevo usuario!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

/**
 * El mensaje de confirmacion espera una respuesta, si la respuesta es
 * "isConfirmed", se ejecutara el ajax apuntando a la ruta deny con el id como
 * parametro, y si el registro se elimina satisfactoriamente se recargara la tabla sin
 * tener que recargar la pagina y ademas saldra el mensaje de aviso diciendo que se realizo
 * el proceso correctamente
 * @param id
 */

function deny(id){
    Swal.fire({
        title: 'Denegar usuario?',
        text: "Esto eliminara la solicitud de la tabla!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Si, eliminala!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: route('deny', id),
                type: 'delete',
                success(res) {
                    if (res){
                        Swal.fire(
                            'Solicitud eliminado!',
                            'Se ha eliminado la solicitud!.',
                            'success',
                        )
                        table.ajax.reload();
                    }
                }
            })
        }
    })
}

