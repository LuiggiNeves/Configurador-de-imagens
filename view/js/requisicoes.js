//ajax tipo de img

function modTipo() {
    const radioButtons = document.querySelectorAll('input[name="tipo_arquivo"]');
    let valorSelecionado = "";

    radioButtons.forEach(function(radioButton) {
        if (radioButton.checked) {
            valorSelecionado = radioButton.value;
        }
    });

    if (valorSelecionado !== "") {
        const xhttp = new XMLHttpRequest();
        const retorno = 1;
        const url = "config/converter.php?retorno=" + retorno + "&funcao=minhaFuncao&tipo_arquivo=" + valorSelecionado;

        xhttp.onload = function () {
            console.log(xhttp.responseText);
            Swal.fire({
                icon: 'success',
                title: 'Feito!',
                text: 'Tipo de imagem alterado',
                confirmButtonColor: '#7001ca',
                confirmButtonText: 'OK'
            });
        };

        xhttp.open("GET", url);
        xhttp.send();
    } else {
        console.error("Nenhum radio button selecionado.");
    }
}

function modTamanho() {
    const xhttp = new XMLHttpRequest();
    var retorno = 1;

    // Captura os valores de altura e largura
    var altura = document.getElementById('altura').value;
    var largura = document.getElementById('largura').value;

    // Constrói a URL com os parâmetros de altura e largura
    var url = "config/cut.php?retorno=" + retorno + "&funcao=minhaFuncao&altura=" + altura + "&largura=" + largura;

    xhttp.onload = function () {
        // Lógica após a conclusão da requisição
        console.log(xhttp.responseText);
        Swal.fire({
            icon: 'success',
            title: 'Feito!',
            text: 'Imagem redimencionada',
            confirmButtonColor: '#7001ca',
            confirmButtonText: 'OK'
        });
    };
    xhttp.open("GET", url);
    xhttp.send();
}



//ajax tamanho de img

