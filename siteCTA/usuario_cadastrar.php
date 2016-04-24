<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php
            include("cabecalho.php");
            $pagina = 'IN';
        ?>    
            
        <title>colabAD | Cadastrar </title>           
    </head>    

    <body>
        
    <?php
        include("navegacao.php");
    ?>
        
    <div id="main" class="w3-container" style="margin-left:300px;margin-top:118px">    
        <div class="w3-container w3-section w3-padding-large w3-card-4 w3-light-grey">
            <h1>Cadastrar Usuário</h1>
        </div>
        <div class="w3-container w3-section w3-padding-large w3-card-4 w3-light-grey">
            
            <?php
                if((isset($_GET['mensagem'])) && (isset($_GET['texto']))){
                    echo "<div class='w3-container ".$_GET['mensagem']."'><span onclick='this.parentElement.style.display=\"none\"' class='w3-closebtn'>X</span>";
                    echo $_GET['texto'];
                    echo "</div>";
                }
            ?>              
            
            <div class="w3-container">
                <form id="cadastro_usuario" action="usuario_inserir.php" method="POST">
                    <div class="w3-section">
                       <label><strong>Nome</strong></label>
                        <input class="w3-input w3-border w3-margin-bottom" id="nome" name="nome" type="text" placeholder="Insira seu nome completo" required>

                        <label><strong>Login (E-mail)</strong></label>
                        <input class="w3-input w3-border" id="email" name="email" type="text" placeholder="Insira seu email" required>

                        <label><strong>Senha</strong></label>
                        <input class="w3-input w3-border w3-margin-bottom" id="senha" name="senha" type="password" placeholder="Insira sua senha" required>

                               
                        <label for="escolaridade"><strong>Escolaridade</strong>
                            <select name="escolaridade" id="escolaridade" required>
                                <option value=""disabled selected> Selecione uma opção </option>
                                <option value="Primeiro Grau Incompleto">1º Grau - Incompleto</option>
                                <option value="Primeiro Grau Completo">1º Grau - Completo</option>
                                <option value="Segundo Grau Incompleto">2º Grau - Incompleto</option>
                                <option value="Segundo Grau Completo">2º Grau - Completo</option>
                                <option value="Terceiro Grau Incompleto">3º Grau - Superior Incompleto</option>
                                <option value="Terceiro Grau Completo">3º Grau - Superior Completo</option>
                                <option value="Especializa&ccedil;&atilde;o">Especialização</option>
                                <option value="Mestrado">Mestrado</option>
                                <option value="Doutorado">Doutorado</option>
                            </select>  <br/>
                        </label>    

                        <label  for="estado"><strong>Estado</strong>
                            <select  name="estado" id="estado"required>
                                <option value="" disabled selected>Selecione uma opção</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espirito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </label> <br> 
                    
                    <label><strong>Cidade</strong></label>
                    <input class="w3-input w3-border w3-margin-bottom"  id="cidade" name="cidade" type="text" placeholder="Insira o nome de sua cidade" required>
                      <label><strong>Conte-nos qual é o seu conhecimento sobre áudio-descrição:</strong></label> 
                      <textarea class="w3-input w3-border" name="descricao" id="descricao"></textarea></br>
                            <label required><strong>Deseja contribuir também como:</strong> (Para ser aceito seu usuário será avaliado pelo administrador do sistema)<br>
                             
                                <input type='hidden' class="w3-check"  id='categoria' name='categoria[]' value='1'checked>
                                <label for='categoria1' class="w3-validate"></label></p>
                                <input class="w3-check" id='categoria' name='categoria[]' type='checkbox' value='2'>
                                <label for='categoria2' class="w3-validate"><strong>Áudio-descritor</strong> (O usuário tem permissão de fazer áudio-descricao nas imagens)</label></p>
                                <p>
                                <input class="w3-check" id='categoria' name='categoria[]' type='checkbox' value='3'>
                                <label for='categoria3' class="w3-validate"><strong> Revisor</strong> (O usuário tem permissão de fazer revisões das imagens com áudio-descrição)</label></p>
 
        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
          <button class="w3-btn w3-btn-block w3-green">Enviar</button>
        </div>
                </form>
              </div>
            </div>
        </div>
 
        <?php
            include("rodape.php");
        ?>    
    </body>
</html> 