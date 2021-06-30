/**
 * Le quito la clase d-none al div con id step2 y se la pongo al step1
 */
function firstStep(event){
    event.preventDefault();
    idnum = $('#identification_num');
    user_name = $('#name');
    email = $('#email');
    step1 = $('#step1');
    step2 = $('#step2');

    console.log(idnum.val().length);
    console.log(user_name.val().length);
    console.log(email.val().length);

    if(idnum.val().length != 10){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡El número de identificación debe tener 10 números!',
        })
    }else if(user_name.val().length <= 2 || user_name.val().length >= 31){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡El nombre debe tener entre 3 y 30 carácteres!',
        })
    }else if(email.val().length <= 13 || email.val().length >= 30 ){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '¡El correo electrónico debe tener entre 13 y 30 carácteres!',
        })
    }else{
        step1.addClass('d-none')
        step2.removeClass('d-none')
    }
}

/**
 * Le quito la clase d-none al div con id step1 y se la pongo al step2
 */
function secondStep(event){
    event.preventDefault();
    step1 = $('#step1')
    step2 = $('#step2')
    step2.addClass('d-none')
    step1.removeClass('d-none')
}

/**
 * Con esta funcion evito que se envie la informacion hasta que no se haga click en el boton de
 * enviar, utilizando el preventDefault y el .submit de jQuery.
 * @param event
 */
function sendForm(){
    $('#form').submit()
}
