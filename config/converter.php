<?php

if (isset($_GET['tipo_arquivo'])) {
    $tipoArquivo = $_GET['tipo_arquivo'];

    echo "Tipo de arquivo selecionado: " . $tipoArquivo;

    switch ($tipoArquivo) {
        case 'jpeg':
            converterImagensParaJPEG();
            break;
        case 'png':
            converterImagensParaPNG();
            break;
        default:
            echo "Tipo de arquivo não suportado.";
    }
} else {
    echo "Tipo de arquivo não especificado na requisição.";
}

function converterImagensParaPNG() {

    $caminhoOrigem = '../config/imagem-originais';
    $caminhoDestino = '../config/imagem-convertidas/type/Png';

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

function converterImagensParaJPEG() {
    $caminhoOrigem = '../config/imagem-originais';
    $caminhoDestino = '../config/imagem-convertidas/type/Jpg';

    if (!is_dir($caminhoOrigem)) {
        die("Diretório de origem não encontrado.");
    }

    if (!is_dir($caminhoDestino)) {
        if (!mkdir($caminhoDestino, 0777, true)) {
            die("Falha ao criar o diretório de destino.");
        }
    }

    $arquivos = glob($caminhoOrigem . '/*.png') + glob($caminhoOrigem . '/*.jpg') + glob($caminhoOrigem . '/*.webp') + glob($caminhoOrigem . '/*.jfif');

    foreach ($arquivos as $arquivo) {
        $extensao = pathinfo($arquivo, PATHINFO_EXTENSION);

        if (in_array($extensao, ['png', 'jpg', 'webp', 'jfif'])) { // Ajuste aqui: mudança para 'png'
            switch ($extensao) {
                case 'png': // Ajuste aqui: mudança para 'png'
                    $imagem = imagecreatefrompng($arquivo); // Ajuste aqui: mudança para 'png'
                    break;
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

            $caminhoDestinoJPEG = $caminhoDestino . '/' . pathinfo($arquivo, PATHINFO_FILENAME) . '.jpg'; // Mudança aqui: extensão para '.jpg'

            imagejpeg($imagem, $caminhoDestinoJPEG); // Ajuste aqui: mudança para 'imagejpeg'

            imagedestroy($imagem);

            echo "Imagem convertida: $caminhoDestinoJPEG<br>";
        } else {
            echo "Extensão não suportada: $arquivo<br>";
        }
    }
}




