<?php

if (isset($_GET['funcao'])) {
    $funcao = $_GET['funcao'];
    echo "Função recebida: " . $funcao;
} else {
}

if (isset($_GET['altura']) && isset($_GET['largura'])) {
    $altura = $_GET['altura'];
    $largura = $_GET['largura'];
    $caminhoOriginal = 'imagem-originais';
    $caminhoDestino = 'imagem-convertidas/cut';

    echo "Altura: " . $altura . ", Largura: " . $largura;
    redimensionarImagem($caminhoOriginal, $caminhoDestino, $largura, $altura);
}

function redimensionarImagem($caminhoOriginal, $caminhoDestino, $novaLargura, $novaAltura) {
    list($larguraOriginal, $alturaOriginal) = getimagesize($caminhoOriginal);
    $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);
    $tipoOriginal = exif_imagetype($caminhoOriginal);

    switch ($tipoOriginal) {
        case IMAGETYPE_JPEG:
            $imagemOriginal = imagecreatefromjpeg($caminhoOriginal);
            break;
        case IMAGETYPE_PNG:
            $imagemOriginal = imagecreatefrompng($caminhoOriginal);
            break;
        case IMAGETYPE_GIF:
            $imagemOriginal = imagecreatefromgif($caminhoOriginal);
            break;
        default:
            return false;
    }

    imagecopyresampled($novaImagem, $imagemOriginal, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);

    switch ($tipoOriginal) {
        case IMAGETYPE_JPEG:
            imagejpeg($novaImagem, $caminhoDestino);
            break;
        case IMAGETYPE_PNG:
            imagepng($novaImagem, $caminhoDestino);
            break;
        case IMAGETYPE_GIF:
            imagegif($novaImagem, $caminhoDestino);
            break;
    }

    imagedestroy($novaImagem);
    imagedestroy($imagemOriginal);

    return true;
}

?>
