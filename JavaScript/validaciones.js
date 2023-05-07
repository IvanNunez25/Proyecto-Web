function ValidarInicio(){
    
    /* Validación de campos NO vacios */
    if((document.formularioIniciarSesion.user.value.length == 0) ||
       (document.formularioIniciarSesion.pass.value.length == 0)){

        alert('Todos los campos deben ser llenados correctamente');
        return false;
    }

    var expresionRegularUsuario = /^[a-zA-Z0-9 ]+$/;
    
    if(!(expresionRegularUsuario.test(document.formularioIniciarSesion.user.value))) {
        alert('El usuario debe ser válido');
        return false;
    }   

    return true;
}

function ValidarRegistro(){
    
    /* Validación de campos NO vacios */
    if((document.formularioRegistrase.usuario.value.length == 0) ||
       (document.formularioRegistrase.contra.value.length == 0)){

        alert('Todos los campos deben ser llenados correctamente');
        return false;
    }

    var expresionRegularUsuario = /^[a-zA-Z0-9 ]+$/;
    
    if(!(expresionRegularUsuario.test(document.formularioRegistrase.usuario.value))) {
        alert('El nombre de usuario no debe contener caracteres especiales');
        return false;
    }   

    return true;
}

function ValidarAdmin(){
    
    /* Validación de campos NO vacios */
    if((document.formularioAdministrador.usuario.value.length == 0) ||
       (document.formularioAdministrador.password.value.length == 0)){

        alert('Todos los campos deben ser llenados correctamente');
        return false;
    }

    var expresionRegularUsuario = /^[a-zA-Z0-9 ]+$/;
    
    if(!(expresionRegularUsuario.test(document.formularioAdministrador.usuario.value))) {
        alert('El nombre de usuario no debe contener caracteres especiales');
        return false;
    }   

    return true;
}