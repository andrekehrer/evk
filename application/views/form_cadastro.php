<?php require('header.php'); ?>
<?php require('menu.php'); ?>

<section id="" class=""> <br><br><br><br>
    <div class="container" data-aos="fade-up">
        <header class="section-header">
            <h2>Nas bagagens cabem sonhos! Te desejamos uma ótima viagem!</h2>
            <p>Faça seu cadastro</p>
        </header>

        <div class="row">
            <div class="col-lg-12">
                <form class="jotform-form" id="myFormCadastrar" action="cadastro/salvar_cadastro" method="post" enctype="multipart/form-data" id="" accept-charset="utf-8" autocomplete="on">
                    <!-- ///// CADASTRO ////// -->
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Nome</h4>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="nome" id="" aria-describedby="" placeholder="Nome">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="sobrenome" aria-describedby="" placeholder="Sobrenome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="telefone" name="telefone" aria-describedby="" placeholder="Telefone">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="email" name="email" aria-describedby="" placeholder="E-mail">
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- ///// Endereco ////// -->
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Endereço</h4>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="endereco" aria-describedby="" placeholder="Endereço">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="end_continuacao" aria-describedby="" placeholder="Endereço (cont.)">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="cidade" aria-describedby="" placeholder="Cidade">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="estado" aria-describedby="" placeholder="Estado">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="cep" aria-describedby="" placeholder="CEP / Código Postal">
                            </div>
                        </div>
                    </div><br>
                    <!-- ///// Sua Viagem ////// -->
                    <hr>
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <h4>Sua viagem</h4>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="origem_viagem" aria-describedby="" placeholder="Origem da viagem">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="destino_viagem" aria-describedby="" placeholder="Destino da bagagem">
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    ///// Identificação da bagagem ////// 
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Identificação da bagagem</h4>
                        </div>
                    </div>    
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="marca_bagagem" aria-describedby="" placeholder="Qual a marca da sua bagagem ?">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="" name="cor_bagagem" aria-describedby="" placeholder="Qual a cor da sua bagagem?">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <p>Qual o tamanho da sua bagagem</p>
                                <select class="form-select" name="tamanho_bagagem" aria-label="Default select example">
                                    <option value="1">Pequena</option>
                                    <option value="2">Média</option>
                                    <option value="3">Grande</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <input type="text" class="form-control" id="peso_bagagem" name="" aria-describedby="" placeholder="Qual o peso máximo da sua bagagem?">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <p>Qual o tipo da sua bagagem rígida ou maleável?</p>
                                <select class="form-select" name="tipo_bagagem" aria-label="Default select example">
                                    <option value="1">Rígida</option>
                                    <option value="2">Maleável</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <p>Qual o tipo da sua bagagem troller ou Esportiva?</p>
                                <select class="form-select" name="esportiva_bagagem" aria-label="Default select example">
                                    <option value="1">Troller</option>
                                    <option value="2">Esportiva</option>
                                </select>
                            </div>
                        </div>
                    </div><br>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Favor nos enviar uma foto da sua bagagem fechada.</h4>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="file-upload-wrapper">
                                <input type="file" id="input-file-now" name="foto_bagagem" class="file-upload" />
                            </div>
                        </div>
                    </div> <br> <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Conteúdo da bagagem </h4>
                            <p>Favor descrever com máximo detalhe o que está dentro de sua bagagem</p>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="file-upload-wrapper">
                                <textarea name="conteudo" class="form-control" id="conteudo" style="width: 100%" rows="10" placeholder="Digite aqui..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <input type="text" class="form-control" id="valor_total_da_bagagem" name="total_bagagem" aria-describedby="" placeholder="Valor total da sua bagagem">
                            </div>
                            <p>*Caso o valor da sua bagagem ultrapasse 10 mil reais recomendamos que declare junto a companhia aérea no momento do check in.</p>
                        </div>
                    </div><br><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Caso tenha algumas notas fiscais dos produtos que estão na sua bagagem , favor anexar aqui. Em caso de extravio isso lhe ajuda no reembolso.</h4>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="file-upload-wrapper">
                                <input type="file" id="input-file-now" name="nota_fiscal_bagagem" class="file-upload" />
                            </div>
                        </div>
                    </div><br><hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <h4>Favor nos mandar uma foto da bagagem pronta , 5 segundos antes de ser fechada .</h4>
                        </div>
                    </div>  
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="file-upload-wrapper">
                                <input type="file" id="input-file-now" name="ultima_foto_bagagem"  class="file-upload" />
                            </div>
                        </div>
                    </div><br><br> -->
                    <div class="row">
                        <div class="col-lg-6">
                            <h4>Escolha uma senha</h4>
                            <div class="file-upload-wrapper">
                                <input type="password" class="form-control" id="senha" name="senha" aria-describedby="" placeholder="Escolha uma senha">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <h4>Repetir senha</h4>
                            <div class="file-upload-wrapper">
                                <input type="password" class="form-control" id="senha2" name="senha2" aria-describedby="" placeholder="Digite novamente a senha">
                            </div>
                        </div>
                    </div><br><hr><br>
                    <div class="alert alert-danger" id="pass_msg" style="display:none" role="alert">
                        As senhas não são iguais.
                    </div>
                    <div class="alert alert-danger" id="pass_msg_retorno_erro" style="display:none" role="alert">
                        
                    </div>
                    <button type="submit" id="submit" style="width:100%" class="btn btn-primary">Cadastrar</button>
                </form>
            </div>
        </div> 
    </div> 
</section>
<?php require('footer.php'); ?>
    <script>
    $(document).ready(function() {

      $('#submit').click(function() {
        event.preventDefault();
        var passwords = jQuery("#senha").val();
        var repassword = jQuery("#senha2").val();
        if (repassword != passwords) {
            jQuery("#pass_msg").show();
            return false;
        } else {
            jQuery("#pass_msg").hide();
            ajax_call();
        }
      });

      function ajax_call() {
        var site_url = "<?=base_url()?>";
        $.ajax({
            url:'cadastro/salvar_cadastro',
            type: 'POST',
            data: $("#myFormCadastrar").serialize(),
            success: function(result) {
                console.log(result.cad);
                if(result.cad == 0){
                    jQuery("#pass_msg_retorno_erro").show().html(result.msg);
                }else{
                    jQuery("#pass_msg_retorno_erro").hide();
                    alert('Cadastrado com sucesso! Acesse seu email para ativar sua conta!');
                    // window.location.href = site_url;
                }
            },
            error: function(){
                alert("Fail")
            }
        });
      }
    });
  </script>