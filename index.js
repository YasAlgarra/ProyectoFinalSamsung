function validar_formulario()
{
	var nombre 		= document.getElementById("nombre").value;
    var apellido1 	= document.getElementById("apellido1").value;
    var apellido2 	= document.getElementById("apellido2").value;
    var email 		= document.getElementById("email").value;
    var login 		= document.getElementById("login").value;
    var password 	= document.getElementById("password").value;
    var email_registro = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i;
    

	if(nombre == '' || /^[0-9]+$/.test(nombre) ) //validar nombre: no vacío, solo letras
	{	
        document.getElementById("txt-err1").classList.remove("oculto");
		return false;
	}else{
    
        document.getElementById("txt-err1").classList.add("oculto");
    }

    if(apellido1 == '' || /^[0-9]+$/.test(apellido1) ) //validar apellido1: no vacío, solo letras
	{	
        document.getElementById("txt-err2").classList.remove("oculto");
		return false;
	} else {
    
        document.getElementById("txt-err2").classList.add("oculto");
    }

    if(apellido2 == '' || /^[0-9]+$/.test(apellido2) ) //validar apellido2: no vacío, solo letras
	{	
        document.getElementById("txt-err3").classList.remove("oculto");
		return false;
	} else {
    
        document.getElementById("txt-err3").classList.add("oculto");
    }

    if ( email == ''){ // validar correo: no vacío
        document.getElementById("txt-err4").classList.remove("oculto");
        return false;
    
    } else if (!email_registro.test(email)) { 
        // validar correo que cumpla con el formato
        text = "Incluye un signo @ en la dirección de correo electrónico. La dirección " + correo + " no incluye el signo @";
        return false;
    }
        // correo válido
	    document.getElementById("txt-err4").classList.add("oculto");
    

    if (login == '' || password == '') {
        if (login == '') {
            document.getElementById("txt-err5").classList.remove("oculto");
        } else {
            document.getElementById("txt-err5").classList.add("oculto");
        }
    
        if (password == '') {
            document.getElementById("txt-err6").classList.remove("oculto");
        } else {
            document.getElementById("txt-err6").classList.add("oculto");
        }
    
        return false;
    }

}

function mostrarDatos() {
    document.getElementById("myDiv").style.display = "block";
}
