<?php
include("include/conexao.php"); 
include("include/funcoes.php");

$imagem=1;
$usuario=2;
$categoria=1;
  
if (isset($_FILES['arquivo'])) {
    $pasta = 'uploads/';
 
    $_UP['pasta'] = $pasta;

    // Tamanho m�ximo do arquivo (em Bytes)
    $_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
    //
    // Array com as extens�es permitidas
    $_UP['extensoes'] = array('jpg','pjeg','gif','png');

    // Renomeia o arquivo
    $_UP['renomeia'] = true;

    // Array com os tipos de erros de upload do PHP
    $_UP['erros'][0] = 'N�o houve erro';
    $_UP['erros'][1] = 'O arquivo no upload � maior do que o limite!';
    $_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado!';
    $_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente.';
    $_UP['erros'][4] = 'N�o foi feito o upload do arquivo.';

    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivo']['error'] != 0) {
      die("N�o foi poss�vel fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error']]);
      exit; // Para a execu��o do script
    }

    // Faz a verifica��o da extens�o do arquivo
    $nome_original = $_FILES['arquivo']['name'];
    $extensao = strtolower(end(explode('.', $nome_original)));
    if (array_search($extensao, $_UP['extensoes']) === false) {
      echo "<script>location.href='index.php?mensagem=error&texto=Por favor, envie arquivos com as seguintes extens�es: jpg;.jpeg;.gif;.png';</script>";    
      die();
    }

    // Faz a verifica��o do tamanho do arquivo
    if ($_UP['tamanho'] < $_FILES['arquivo']['size']) {
      echo "<script>location.href='index.php?mensagem=error&texto=O arquivo enviado � muito grande, envie arquivos de at� 2Mb.';</script>";    
      die();  
    }
   
    // Primeiro verifica se deve trocar o nome do arquivo
    if ($_UP['renomeia'] == true) {
      // Cria um nome baseado no UNIX TIMESTAMP atual e com extens�o jpg;.jpeg;.gif;.png'
      $novo_nome = md5(time()).'jpg'; 
    } else {
      // Mant�m o nome original do arquivo
      $novo_nome = $_FILES['arquivo']['name'];
    }
      $nome_original = $_FILES['arquivo']['name'];

    $upload = move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'] . $novo_nome);

//    session_start();
    date_default_timezone_set('America/Sao_Paulo');

//    $usuario = $_SESSION['UsuarioCOD'];
    $data = date('Y-m-d');
    $hora = date('H:i:s');
//    $audiodescricao = $mysqli->real_escape_string($_POST['texto']);
    $audiodescricao="ola mundo!";
//    $arqNome = $novo_nome;

    if ($upload == true) {
        // Cria uma query MySQL
       $sql = "INSERT INTO 
               `imagens`(`img_codigo`, `usu_codigo`, `img_data`, `img_hora`, `cat_codigo`, `img_audiodescricao`, `img_nome`, `img_nome_original`,`img_extensao`) 
                 VALUES ('$imagem', '$usuario','$data','$hora','$categoria','$audiodescricao','$novo_nome','$nome_original','$extensao)";
        
// Executa o insert    
        mysqli_query($mysqli, $sql) or die(mysqli_error($mysqli));

        //Volta ara a p�gina anterior
        echo "Arquivo enviado com Sucesso!!";
        exit;

    } else {
    echo "N�o foi possivel fazer upload da imagem!!";    
    die();    
    }
}
    $mysqli->Close();
    ?>