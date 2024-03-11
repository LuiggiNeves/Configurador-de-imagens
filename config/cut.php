<?php

if (isset($_GET['funcao'])) {


} else {


}

function redimensionarImagem($caminhoOriginal, $caminhoDestino, $novaLargura, $novaAltura) {
    // Obtém informações sobre a imagem original
    list($larguraOriginal, $alturaOriginal) = getimagesize($caminhoOriginal);

    // Cria uma nova imagem vazia com o tamanho desejado
    $novaImagem = imagecreatetruecolor($novaLargura, $novaAltura);

    // Determina o tipo da imagem original
    $tipoOriginal = exif_imagetype($caminhoOriginal);

    // Carrega a imagem original com base no tipo
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
        // Adicione mais casos conforme necessário para outros tipos de imagem
        default:
            return false; // Tipo de imagem não suportado
    }

    // Copia a região desejada da imagem original para a nova imagem
    imagecopyresampled($novaImagem, $imagemOriginal, 0, 0, 0, 0, $novaLargura, $novaAltura, $larguraOriginal, $alturaOriginal);

    // Salva a nova imagem
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
        // Adicione mais casos conforme necessário para outros tipos de imagem
    }

    // Libera a memória
    imagedestroy($novaImagem);
    imagedestroy($imagemOriginal);

    return true;
}

// Exemplo de uso:
$caminhoOriginal = '../config/imagem-originais';
$caminhoDestino = '../config/imagem-convertidas/type';
$novaLargura = 400;
$novaAltura = 200;



?>
