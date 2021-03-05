function editconf()
    {
    var mensaje;
    var opcion = confirm("¿Estas seguro que deseas editar este registro?");
    if (opcion == true) {
        mensaje = " ";
	} else {
        mensaje = " ";
        return false;
	}
	document.getElementById("parrafo").innerHTML = mensaje;
}

function deleteconf()
    {
    var mensaje;
    var opcion = confirm("¿Estas seguro que deseas eliminar este registro?");
    if (opcion == true) {
        mensaje = " ";
	} else {
        mensaje = " ";
        return false;
	}
	document.getElementById("parrafo").innerHTML = mensaje;
}

function asistconf()
{
    var mensaje;
    var opcion = confirm("¿Estas seguro que deseas crear esta asistencia?");
    if (opcion == true) {
        mensaje = " ";
    } else {
        mensaje = " ";
        return false;
    }
    document.getElementById("parrafo").innerHTML = mensaje;
}

