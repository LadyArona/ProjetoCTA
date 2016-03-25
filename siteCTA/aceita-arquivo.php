<?php

$destino = 'img/' . $_FILES['arquivo']['name'];
 
$arquivo_tmp = $_FILES['arquivo']['name'];
 
move_uploaded_file( $arquivo_tmp, $destino  );
//move_uploaded_file($_files['arquivo']['tmp_name'] , $_files['arquivo']['name'])

?>

<?php
/******
 * Upload de imagens
 ******/
 
// verifica se foi enviado um arquivo
if ( isset( $_FILES[ 'arquivo' ][ 'name' ] ) && $_FILES[ 'arquivo' ][ 'error' ] == 0 ) {
    echo 'Voc� enviou o arquivo: <strong>' . $_FILES[ 'arquivo' ][ 'name' ] . '</strong><br />';
    echo 'Este arquivo � do tipo: <strong > ' . $_FILES[ 'arquivo' ][ 'type' ] . ' </strong ><br />';
    echo 'Tempor�riamente foi salvo em: <strong>' . $_FILES[ 'arquivo' ][ 'tmp_name' ] . '</strong><br />';
    echo 'Seu tamanho �: <strong>' . $_FILES[ 'arquivo' ][ 'size' ] . '</strong> Bytes<br /><br />';
 
    $arquivo_tmp = $_FILES[ 'arquivo' ][ 'tmp_name' ];
    $nome = $_FILES[ 'arquivo' ][ 'name' ];
     
        // Pega a extensao
    $extensao = pathinfo ( $nome, PATHINFO_EXTENSION );
 
    // Converte a extensao para mimusculo
    $extensao = strtolower ( $extensao );
 
    // Somente imagens, .jpg;.jpeg;.gif;.png
    // Aqui eu enfilero as extes�es permitidas e separo por ';'
    // Isso server apenas para eu poder pesquisar dentro desta String
    if ( strstr ( '.jpg;.jpeg;.gif;.png', $extensao ) ) {
        // Cria um nome �nico para esta imagem
        // Evita que duplique as imagens no servidor.
        // Evita nomes com acentos, espa�os e caracteres n�o alfanum�ricos
        $novoNome = uniqid ( time () ) . $extensao;
 
        // Concatena a pasta com o nome
        $destino = 'img / ' . $novoNome;
 
        // tenta mover o arquivo para o destino
        if ( @move_uploaded_file ( $arquivo_tmp, $destino ) ) {
            echo 'Arquivo salvo com sucesso em : <strong>' . $destino . '</strong><br />';
//            echo '< img src = "' . $destino . '" />';
        }
        else
            echo 'Erro ao salvar o arquivo. Aparentemente voc� n�o tem permiss�o de escrita.<br />';
    }
    else
        echo 'Voc� poder� enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"<br />';
}
else
    echo 'Voc� n�o enviou nenhum arquivo!';



//$imagem = 'images/' . $id_noticia . '.jpg';
//if( file_exists( $imagem ) )
//    echo '<img src="' . $imagem . '" />