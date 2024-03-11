<?php

if (isset($_GET['funcao'])) {
    $funcao = $_GET['funcao'];
    echo "Função recebida: " . $funcao;
} else {

    converterImagensParaPNG();
}

function converterImagensParaPNG() {

    $caminhoOrigem = '../config/imagem-originais';
    $caminhoDestino = '../config/imagem-convertidas/cut';

    if (!is_dir($caminhoOrigem)) {
        die("Diretório de origem não encontrado.");
    }

    if (!is_dir($caminhoDestino)) {
        if (!mkdir($caminhoDestino, 0777, true)) {
            die("Falha ao criar o diretório de destino.");
        }
    }

    $arquivos = glob($caminhoOrigem . '/*.jpeg') + glob($caminhoOrigem . '/*.jpg') + glob($caminhoOrigem . '/*.webp') + glob($caminhoOrigem . '/*.jfif');

    foreach ($arquivos as $arquivo) {
        $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);

        if (in_array($extensao, ['jpeg', 'jpg', 'webp', 'jfif'])) {
            switch ($extensao) {
                case 'jpeg':
                case 'jpg':
                    $imagem = imagecreatefromjpeg($arquivo);
                    break;
                case 'webp':
                    $imagem = imagecreatefromwebp($arquivo);
                    break;
                case 'jfif':
                    $imagem = imagecreatefromjpeg($arquivo);
                    break;
            }

            $caminhoDestinoPNG = $caminhoDestino . '/' . pathinfo($arquivo, PATHINFO_FILENAME) . '.png';

            imagepng($imagem, $caminhoDestinoPNG);

            imagedestroy($imagem);

            echo "Imagem convertida: $caminhoDestinoPNG<br>";
        } else {
            echo "Extensão não suportada: $arquivo<br>";
        }
    }
}
?>



