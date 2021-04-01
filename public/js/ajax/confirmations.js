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


