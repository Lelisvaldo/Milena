// FUNÇÃO PARA MUDAR STATUS DO USUARIO
function cbAdmin (cdUser, statusAdm) {
    var  sAdmin;

    if(statusAdm == 'null'){sAdmin = 1;}
    else if(statusAdm == 'checked'){sAdmin = 0;}

    $.post( "../views/ajax/alterUser.php", {
        codUser: cdUser,
        statusAdmin: sAdmin
    });
}

// FUNÇÃO PARA APAGAR USUARIO
function delUserAdmin (cdUser) {
    $.post( "../views/ajax/deleteUser.php", {
        cdUser: cdUser,
    });
}