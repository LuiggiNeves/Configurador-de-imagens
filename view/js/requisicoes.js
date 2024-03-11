//ajax


function modTamanho() {
    const xhttp = new XMLHttpRequest();
    var retorno = 1;
    var url = "config/converter.php?retorno=" + retorno + "&funcao=minhaFuncao";

    xhttp.onload = function () {
        console.log(xhttp.responseText);
        Swal.fire({
            icon: 'success',
            title: 'Feito!',
            text: 'A img foi cortada com êxito.',
            confirmButtonColor: '#7001ca',
            confirmButtonText: 'OK'
        });
    };
    xhttp.open("GET", url);
    xhttp.send();
}

function modTipo() {
    const xhttp = new XMLHttpRequest();
    var retorno = 1;
    var url = "config/converter.php?retorno=" + retorno + "&funcao=minhaFuncao";

    xhttp.onload = function () {
        // Lógica após a conclusão da requisição
        console.log(xhttp.responseText);
        Swal.fire({
            icon: 'success',
            title: 'Feito!',
            text: 'A conversão foi executada com êxito.',
            confirmButtonColor: '#7001ca',
            confirmButtonText: 'OK'
        });
    };
    xhttp.open("GET", url);
    xhttp.send();
}