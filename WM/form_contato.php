<form method="post" enctype="multipart/form-data">
    <div>
        <label for="Nome">Nome:</label>
        <input type="text" id="nome" name="nome" placeholder="Nome completo" value="<?php echo @$_POST['nome']; ?>">
    </div>
    <div>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email"  placeholder="exemplo@email.com" value="<?php echo @$_POST['email']; ?>">
    </div>
    <div>
        <label for="Celular">Celular:</label>
        <input type="phone" class="celular" maxlength="15" id="celular" name="celular" placeholder="(11) 91234-5678" data-mask="(00) 00000-0000" data-mask-selectonfocus="true" value="<?php echo @$_POST['celular']; ?>">
    </div>
    <div>
        <label for="Empresa">Empresa:</label>
        <input type="text"  id="empresa" name="empresa" placeholder="Onde você trabalha?" value="<?php echo @$_POST['empresa']; ?>">
    </div>
    <div>
        <label for="Assunto">Assunto:</label>
        <input type="text"  id="assunto" name="assunto" placeholder="Sobre o que quer falar?" value="<?php echo @$_POST['assunto']; ?>">
    </div>
    <div>
        <label for="Mensagem">Mensagem:</label>
        <textarea  id="mensagem" name="mensagem" rows="3" placeholder="Digite sua mensagem..." required></textarea>
    </div>
    <div>
        <label for="Arquivo">Selecione o arquivo...</label>
        <input type="file" id="file" name="arquivo" title="Aceitamos arquivos em pdf / doc / docx / ppt / jpeg com até 2Mb." value="<?php echo @$_POST['file']; ?>">
    </div>

    <div>
        <input type="hidden" name="enviar" value="send" />
        <input type="hidden" name="destino" value="email@aqui.com.br" />
        <input type="submit" name="Enviar" value="Enviar" />
    </div>
                    <p>
                   <?php
                        if("$_POST[nome]" >= '1'){
                            $nome = "$_POST[nome]";
                        }else{
                            $nome = '';
                        }if("$_POST[email]" >= '1'){
                            $email = "$_POST[email]";
                        }else{
                            $email = '';
                        }if("$_POST[empresa]" >= '1'){
                            $empresa = "$_POST[empresa]";
                        }else{
                            $empresa = '';
                        }if("$_POST[celular]" >= '1'){
                            $celular = "$_POST[celular]";
                        }else{
                            $celular = '';
                        }if("$_POST[assunto]" >= '1'){
                            $assunto = "$_POST[assunto]";
                        }else{
                            $assunto = '';
                        }if("$_POST[mensagem]" >= '1'){
                            $mensagem = "$_POST[mensagem]";
                        }else{
                            $mensagem = '';
                        }
                    ?>
                    <?php
                        if (isset($_POST['enviar']) && $_POST['enviar'] == 'send'){
                            $nome = strip_tags(trim($_POST['nome']));
                            $email = strip_tags(trim($_POST['email']));
                            $empresa = strip_tags(trim($_POST['empresa']));
                            $celular = strip_tags(trim($_POST['celular']));
                            $destino = strip_tags(trim($_POST['destino']));
                            $assunto = strip_tags(trim($_POST['assunto']));
                            $mensagem = strip_tags(trim($_POST['mensagem']));
                            $anexado = $_FILES['arquivo']['name'];
                            $extensao = strtolower(end(explode('.', $anexado)));
                            $extensoes = array ('doc', 'docx', 'pdf', 'ppt', 'png', 'jpeg', 'jpg', 'JPG');
                            $size = $_FILES['arquivo']['size'];
                            $maxsize = 1024 * 1024 * 2;

                        if(empty($anexado)){
                            echo "";
                         }elseif(array_search($extensao, $extensoes) === false){
                            $retorno = 'ACEITAMOS APENAS .doc / .docx / .pdf / .ppt / .jpeg</div>';
                         }elseif($size >= $maxsize){
                            $retorno = 'ENVIE NO MÁXIMO 2Mb</div>';
                         }if(empty($nome)) {
                            $retorno = '<strong>Ops!</strong> Informe o seu nome.';
                         }elseif (empty($email)) {
                            $retorno = '<strong>Ops!</strong> Informe o seu e-mail.';
                         }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                            $retorno = '<strong>Ops!</strong> Informe o um e-mail válido.';
                         }elseif (empty($assunto)) {
                            $retorno = '<strong>Ops!</strong> informe um assunto.';
                         }elseif (empty($mensagem)) {
                            $retorno = '<strong>Ops!</strong> Digite uma mensagem!';
                         }if(empty($retorno)) {

                        //<input type="hidden" name="enviar" value="send" />
                            $date = date("d/m/Y H:i");

                        // ******** ATENÇÃO ********
                        // ABAIXO ESTÁ A CONFIGURAÇÃO DO SEU FORMULÁRIO.
                        // ******** ATENÇÃO ********

                        //CABEÇALHO - CONFIGURAÇÕES SOBRE SEUS DADOS E SEU WEBSITE
                            $nome_do_site="//_Victor Franco";
                            $email_para_onde_vai_a_mensagem = "$destino";
                            $nome_de_quem_recebe_a_mensagem = "//_Victor Franco";
                            $exibir_apos_enviar='Obrigado por entrar em contato conosco';

                        //MAIS - CONFIGURAÇOES DA MENSAGEM ORIGINAL
                            $cabecalho_da_mensagem_original="From: $nome - $email\n";
                            $assunto_da_mensagem_original="$assunto - Mensagem do site";

                        // FORMA COMO RECEBERÁ O E-MAIL (FORMULÁRIO)
                        // ******** OBS: SE FOR ADICIONAR NOVOS CAMPOS, ADICIONE OS CAMPOS NA VARIÁVEL ABAIXO ********
                            $configuracao_da_mensagem_original="
                            <style>a{text-decoration: none;color: #ed193a;}</style>
                            <font face='Arial' size='2'>
                                <strong>Nome:</strong> $nome<br>
                                <strong>E-mail:</strong> <a href='mailto:$email'>$email</a><br>
                                <strong>Empresa:</strong> $empresa<br>
                                <strong>celular:</strong> $celular<br>
                                <strong>Assunto:</strong> $assunto<br><br>
                                <strong>Mensagem:</strong><br>
                                    $mensagem<br><br>

                                <strong>Mensagem enviada - $date</strong>
                            </font>";

                        //CONFIGURAÇÕES DA MENSAGEM DE RESPOSTA
                        // CASO $assunto_digitado_pelo_usuario="s" ESSA VARIAVEL RECEBERA AUTOMATICAMENTE A CONFIGURACAO
                        // "Re: $assunto"
                            $assunto_da_mensagem_de_resposta = "//_Victor Franco";
                            $cabecalho_da_mensagem_de_resposta = "From: $nome_do_site <$email_para_onde_vai_a_mensagem>\n";
                            $configuracao_da_mensagem_de_resposta="
                            <style>a{text-decoration: none;color: #4C1E0D;}</style>
                            <font face='Arial' size='2'>
                                <strong>$nome</strong>,<br>
                                Agradecemos o seu contato,<br>
                                Responderemos o seu email em breve. <br><br>

                                <strong>Atenciosamente,<br>
                                <a href='http://site.com.br/'>$nome_do_site</a></strong><br><br>
                                Enviado em: $date
                            </font>";

                        // ******** IMPORTANTE ********
                        // A PARTIR DE AGORA RECOMENDA-SE QUE NÃO ALTERE O SCRIPT PARA QUE O  SISTEMA FINCIONE CORRETAMENTE
                        // ******** IMPORTANTE ********

                        //ESSA VARIAVEL DEFINE SE É O USUARIO QUEM DIGITA O ASSUNTO OU SE DEVE ASSUMIR O ASSUNTO DEFINIDO
                        //POR VOCÊ CASO O USUARIO DEFINA O ASSUNTO PONHA "s" NO LUGAR DE "n" E CRIE O CAMPO DE NOME
                        //'assunto' NO FORMULARIO DE ENVIO
                            $assunto_digitado_pelo_usuario="s";

                        //ENVIO DA MENSAGEM ORIGINAL
                            $arquivo = isset($_FILES["arquivo"]) ? $_FILES["arquivo"] : FALSE;

                        if(file_exists($arquivo["tmp_name"]) and !empty($arquivo)){

                                $fp = fopen($_FILES["arquivo"]["tmp_name"],"rb");
                                $anexo = fread($fp,filesize($_FILES["arquivo"]["tmp_name"]));
                                $anexo = base64_encode($anexo);

                            fclose($fp);

                            $anexo = chunk_split($anexo);

                            $boundary = "XYZ-" . date("dmYis") . "-ZYX";
                            $mens = "--$boundary\n";
                            $mens .= "Content-Transfer-Encoding: 8bits\n";
                            $mens .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
                            $mens .= "$configuracao_da_mensagem_original\n";
                            $mens .= "--$boundary\n";
                            $mens .= "Content-Type: ".$arquivo["type"]."\n";
                            $mens .= "Content-Disposition: attachment; filename=\"".$arquivo["name"]."\"\n";
                            $mens .= "Content-Transfer-Encoding: base64\n\n";
                            $mens .= "$anexo\n";
                            $mens .= "--$boundary--\r\n";
                            $headers  = "MIME-Version: 1.0\n";
                            $headers .= "$cabecalho_da_mensagem_original";
                            $headers .= "Content-type: multipart/mixed; boundary=\"$boundary\"\r\n";
                            $headers .= "$boundary\n";
                        }else{
                            $mens = "$configuracao_da_mensagem_original\n";
                            $headers  = "MIME-Version: 1.0\n";
                            $headers .= "$cabecalho_da_mensagem_original";
                            $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
                        }if($assunto_digitado_pelo_usuario=="s"){
                            $assunto = "$assunto_da_mensagem_original";
                        };
                            $seuemail = "$email_para_onde_vai_a_mensagem";
                        mail($seuemail,$assunto,$mens,$headers);


                        //ENVIO DE MENSAGEM DE RESPOSTA AUTOMATICA
                            $headers = "$cabecalho_da_mensagem_de_resposta";
                            $headers .= "Content-Type: text/html; charset=\"UTF-8\"\n\n";
                        if($assunto_digitado_pelo_usuario=="s"){
                            $assunto = "$assunto_da_mensagem_de_resposta";
                        }else{
                            $assunto = "Re: $assunto";
                        };
                            $mensagem = "$configuracao_da_mensagem_de_resposta";
                        mail($email,$assunto,$mensagem,$headers);

                        /*echo "<script>window.location='$exibir_apos_enviar'</script>";*/
                        echo '<div class="alert alert-success" role="alert">Mensagem encaminhada com sucesso!</div>';
                        unset($nome, $email, $empresa, $celular, $assunto, $mensagem, $arquivo);
                            }else{
                                echo"$retorno";
                            } 
                        }
                    ?></p>
</form>