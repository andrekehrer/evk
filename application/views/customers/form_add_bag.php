<form class="jotform-form" id="myFormCadastrar" action="<?=base_url();?>customers/add_bag" method="post" enctype="multipart/form-data" id="" accept-charset="utf-8" autocomplete="on">
    <div class="row">
        <div class="col-lg-12">
            <h4>Identificação da bagagem</h4>
        </div>
    </div>    
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <input type="hidden" name="id_viagem" value="<?=$id_viagem?>">
                <p>Marca</p>
                <input type="text" class="form-control" id="" name="marca_mala" aria-describedby="" placeholder="Qual a marca da sua bagagem ?">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <p>Cor</p>
                <input type="text" class="form-control" id="" name="cor_mala" aria-describedby="" placeholder="Qual a cor da sua bagagem?">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <p>Qual o tamanho da sua bagagem</p>
                <select class="form-select" name="tamanho_mala" aria-label="Default select example">
                    <option value="Pequena">Pequena</option>
                    <option value="Média">Média</option>
                    <option value="Grande">Grande</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <p>Peso da Mala</p>
                <input type="text" class="form-control" id="peso_bagagem" name="peso_mala" aria-describedby="" placeholder="Qual o peso máximo da sua bagagem?">
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <p>Qual o tipo da sua bagagem rígida ou maleável?</p>
                <select class="form-select" name="tipo_mala" aria-label="Default select example">
                    <?php foreach($tipo_mala as $tipo){ ?>
                        <option value="<?=$tipo->id?>"><?=$tipo->nome?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <p>Qual o tipo da sua bagagem troller ou Esportiva?</p>
                <select class="form-select" name="estilo_mala" aria-label="Default select example">
                    <?php foreach($estilo_mala as $estilo){ ?>
                        <option value="<?=$estilo->id?>"><?=$estilo->nome?></option>
                    <?php } ?>
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
                <input type="file" id="input-file-now" name="foto_mala_fechada" class="file-upload" />
            </div>
        </div>
    </div> <br> <hr>
    <div class="row">
        <div class="col-lg-12">
            <h4>Conteúdo da bagagem </h4>
            <p>Para a soma automatica funcioanr perfeitamente, complete o campo abaixo nesse formato:</p>
            <p>NOME DO ITEM = VALOR ;</p>
            <p>1 camiseta = 24; perfume = 45; 2 tenis = 150; </p>
        </div>
    </div>  
    <div class="row">
        <div class="col-lg-12">
            <div class="file-upload-wrapper">
                <textarea class="form-control" name="conteudo_mala" id="conteudo" style="width: 100%" rows="10" placeholder="Digite aqui..."></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <p>Valor da bagagem</p>
                <input type="text" class="form-control" id="valor_total_da_bagagem" name="valor_mala" aria-describedby="" placeholder="Valor total da sua bagagem" readonly>
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
                <input type="file" id="input-file-now" name="foto_mala_pronta"  class="file-upload" />
            </div>
        </div>
    </div><br><br>
    <button type="submit" id="submit_mala" style="width:100%" class="btn btn-primary">Cadastrar</button>
</form>