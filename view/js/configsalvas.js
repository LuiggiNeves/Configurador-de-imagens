function salvarConfiguracoes() {
    // Obtém os valores escolhidos pelo usuário
    var tipoArquivoSelecionado = document.querySelector('input[name="tipo_arquivo"]:checked').value;
    var altura = document.getElementById('altura').value;
    var largura = document.getElementById('largura').value;

    // Cria um objeto para armazenar as configurações
    var configuracoes = {
        tipoArquivo: tipoArquivoSelecionado,
        altura: altura,
        largura: largura
    };

    // Converte o objeto em uma string JSON e armazena no localStorage
    localStorage.setItem('configuracoes', JSON.stringify(configuracoes));

    Swal.fire({
        icon: 'success',
        title: 'Salvo!',
        text: 'A operação foi salva com êxito.',
        confirmButtonColor: '#7001ca',
        confirmButtonText: 'OK'
    });
}

function carregarConfiguracoes() {
    // Recupera a string JSON do localStorage
    var configuracoesSalvas = localStorage.getItem('configuracoes');

    if (configuracoesSalvas) {
        // Converte a string JSON de volta para um objeto
        var configuracoes = JSON.parse(configuracoesSalvas);

        // Atualiza os elementos do formulário com as configurações salvas
        document.querySelector('input[name="tipo_arquivo"][value="' + configuracoes.tipoArquivo + '"]').checked = true;
        document.getElementById('altura').value = configuracoes.altura;
        document.getElementById('largura').value = configuracoes.largura;

        alert('Configurações carregadas com sucesso!');
    } else {
        alert('Nenhuma configuração salva encontrada.');
    }
}