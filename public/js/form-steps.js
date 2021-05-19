/**
 * Le quito la clase d-none al div con id step2 y se la pongo al step1
 */

function firstStep(){
    step1 = $('#step1')
    step2 = $('#step2')

    step1.addClass('d-none')
    step2.removeClass('d-none')
}

/**
 * Le quito la clase d-none al div con id step1 y se la pongo al step2
 */


function secondStep(){
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
function sendForm(event){
    event.preventDefault();
    $('#form').submit()
}
