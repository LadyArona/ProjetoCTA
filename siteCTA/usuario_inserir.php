<?php include("include/config.php"); 
      include("include/conexao.php");
      include("include/funcoes.php");

    date_default_timezone_set('America/Sao_Paulo');
    
    $login        = $mysqli->real_escape_string($_POST['email']);
    $senha        = $mysqli->real_escape_string($_POST['senha']);
    $nome         = $mysqli->real_escape_string($_POST['nome']);
    $escolaridade = $mysqli->real_escape_string($_POST['escolaridade']);
    $cidade       = $mysqli->real_escape_string($_POST['cid_codigo']); 
    $descricao    = $mysqli->real_escape_string($_POST['descricao']);
    $dataHora     = date('Y-m-d H:i:s');
    
     foreach ($_POST['categoria'] as $key => $value){
        $categoria[$key] = $value;
    }    
    
    //Validações
    // Verifica se $email realmente existe e se é um email.
    if ( ! isset( $login ) || ! filter_var( $login, FILTER_VALIDATE_EMAIL ) ) {
        echo "<script>location.href='usuario_cadastrar.php?mensagem=w3-red&texto=Envie um Login (E-mail) válido.';</script>";
    } else {
        $sqlUsuarioExistente = "SELECT `usu_codigo` 
                                FROM `usuario` 
                                WHERE `usu_email` = '$login'";

        //Se encontrar esse e-mail então já existe, pede se quer recuperar a senha?
        $queryUsuarioExistente = $mysqli->query($sqlUsuarioExistente);    

        if (mysqli_num_rows($queryUsuarioExistente) > 0) {   
            echo "<script>location.href='usuario_cadastrar.php?mensagem=w3-red&texto=O e-mail de login ".$login." já está sendo usado! Tente utilizar a opção de recuperação de senha.';</script>";
       
        } else {     
            $sql = "INSERT INTO `usuario` (`usu_nome`, `usu_email`, `usu_senha`, `usu_escolaridade`, `cid_codigo`, `usu_descricao`, `usu_data_hora_cad`) 
                    VALUES ('$nome', '$login','".SHA1($senha)."', '$escolaridade', '$cidade', '$descricao', '$dataHora');";        

            $mysqli->query($sql);

            $sqlUsu = "SELECT `usu_codigo`
                     FROM `usuario`  
                     WHERE (`usu_email` = '". $login ."') AND (`usu_senha` = '". SHA1($senha) ."')    
                     LIMIT 1";     
                
            $queryUsu = $mysqli->query($sqlUsu);    

            if (mysqli_num_rows($queryUsu) > 0) { 
                if (!empty($categoria)) {
                    $N = count($categoria);
                    $resultado = $queryUsu->fetch_assoc();
                    for($i=0; $i < $N; $i++)
                    {
                        if ($i == 1) {
                            $situacao = 'ativo';
                        } else {
                            $situacao = 'pendente';
                        }
                            
                        $sqlCategoria = "INSERT INTO `usuario_categoria_usuario` (`usu_codigo`, `cat_usu_codigo`, `cat_usu_situacao`) VALUES ('". $resultado['usu_codigo'] ."', '". $categoria[$i] ."', '$situacao');";
                        $mysqli->query($sqlCategoria);
                    }
                }
            }  

            $emailmsg = montaMensagem($login, $nome, $senha);
            $emailret = smtpmailer($login, 'gerenciador.tgsi@gmail.com', 'ColabAD', 'Cadastro ColabAD', $emailmsg, 0);

            echo "<script>location.href='entrar.php?mensagem=w3-green&texto=Cadastro efetuado com sucesso! $emailret';</script>";
            $mysqli->Close();
            die();         
        }   
    }
?>

