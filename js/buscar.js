var req;
// FUNÇÃO PARA BUSCA USUARIOS POR NOME
function buscarUser(nome) {

    // Verificando Browser
    if(window.XMLHttpRequest) {
       req = new XMLHttpRequest();
    }
    else if(window.ActiveXObject) {
       req = new ActiveXObject("Microsoft.XMLHTTP");
    }

    // Arquivo PHP juntamente com o valor digitado no campo (método GET)
    var url = "../views/ajax/buscar.php?nome="+nome;

    // Chamada do método open para processar a requisição
    req.open("Get", url, true);

    // Quando o objeto recebe o retorno, chamamos a seguinte função;
    req.onreadystatechange = function() {

        // Exibe a mensagem "Buscando Nome..." enquanto carrega

        // Verifica se o Ajax realizou todas as operações corretamente
        if(req.readyState == 4 && req.status == 200) {

        // Resposta retornada pelo buscar.php
    var resposta = req.responseText;

        // Abaixo colocamos a(s) resposta(s) na div dadosUser
        document.getElementById('target-content').innerHTML = resposta;
        }
    }
    req.send(null);
}