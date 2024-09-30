<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id. ') '; ?><?=date('d/m/Y',$rdfs[0]->data)?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://getbootstrap.com/docs/5.0/examples/grid/grid.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
    }
    p {
        margin-top: 0;
        margin-bottom: 0.2rem !important;
    }
    @media (max-width: 900px) {
        .col-xs-3 {
            flex: 0 0 auto !important;
            width: 25% !important;
        }
        .col-xs-6 {
            flex: 0 0 auto;
            width: 50%  !important;
        }
        .col-xs-4 {
            flex: 0 0 auto;
            width: 33.33333333% !important;
        }
        .col-xs-8 {
            flex: 0 0 auto;
            width: 66.66666667% !important;
        }
    }
      .row_border{border: 1px #cbcbcb solid;padding: 5px;margin-bottom: -1px;}
      label{font-weight: 700;}
      .h3, h3 {font-size: 12px !important;}
      hr {margin: 0.2rem 0 !important;}
      body {font-size: 0.6rem !important;}
    </style>
</head>
<body>

<script type="text/javascript" src="<?=base_url(); ?>dash/assinatura/jquery/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>dash/assinatura/core.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>dash/assinatura/components.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>dash/assinatura/jquery/jquery-plugins.js"></script>
    <script type="text/javascript" src="<?=base_url(); ?>dash/assinatura/sig.js"></script>

<script>
    var dc = window.DinarteCoelho;   
</script>

<div class="container-scroller" style="padding:20px;max-width: 1000px;margin: 0 auto;">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
            <div class="content-wrapper">
                <div style="text-align: center;">
                    <img src="https://evk.andrekehrer.com/assets/img/logo.png"  width="60">
                    <h1 class="page-title mb-1 mt-1" style="font-size: 14px !important;">
                        RELATÓRIO DIÁRIO DE FURO (RDF) - <b><?=date('d/m/Y',$rdfs[0]->data)?></b>
                    </h1>
                    <p><b>[ <?php echo $rdfs[0]->nome.' '.$rdfs[0]->sobrenome; ?> ]</b></p>
                </div>
                <div class="page-header" style="margin: 20px 0px 0px 0px !important;">
                    <h3 class="page-title">
                        <?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id.') [<b>'.$tipo.'</b>]'; ?>
                        
                    </h3>
                </div>
                <div class="row_border">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="data">Data</label>
                                    <p><?= $rdfs[0]->data != '' ? date("d/m/Y h:i:sa", $rdfs[0]->data) : '--'?></p>            
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="tu">TU: </label>
                                    <p><?=$rdfs[0]->tu?></p>         
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="data_furo_piloto">Data furo piloto:</label>
                                    <p><?= $rdfs[0]->data_furo_piloto != '' ? date("d/m/Y", $rdfs[0]->data_furo_piloto) : '--'?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="data_puxe">Data Puxe:</label>
                                    <p><?= $rdfs[0]->data_puxe != '' ? date("d/m/Y", $rdfs[0]->data_puxe) : '--'?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label>
                                    <p type="text"><?=$detalhes_bra[0]->cliente_nome?></p>            
                                </div>
                            </div>
                        </div>
                    </div>
                         
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-xs-8">
                                <div class="form-group">
                                    <label for="endereco">Endereco</label>
                                    <p><?=$rdfs[0]->endereco == '' ? $detalhes_bra[0]->endereco: $rdfs[0]->endereco?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="numero">Número</label>
                                    <p><?=$rdfs[0]->numero == '' ? $detalhes_bra[0]->numero: $rdfs[0]->numero?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label>
                                    <p><?=$rdfs[0]->bairro == '' ? $detalhes_bra[0]->bairro: $rdfs[0]->bairro?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label>
                                    <p><?=$rdfs[0]->cidade == '' ? $detalhes_bra[0]->cidade: $rdfs[0]->cidade?></p>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                       <?= $detalhes_bra[0]->estado == ""   ?  '<p></p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AC" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AL" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AP" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AM" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "BA" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "CE" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "DF" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "ES" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "GO" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MA" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MT" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MS" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MG" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PA" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PB" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PR" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PE" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PI" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RJ" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RN" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RS" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RO" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RR" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SC" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SP" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SE" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "TO" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "EX" ?  '<p>'.$detalhes_bra[0]->estado.'</p>' : '' ?>
                                    </select> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="furo_n">Furo Nº:</label>
                                    <p><?=$rdfs[0]->furo_numero?></p>      
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="aparelho_rastreamento">Estaca Inicial PV</label><br>
                                    <p style="width: 45%;float: left;"><?=$rdfs[0]->estaca_inicial_a?></po>
                                    <p style="width: 45%;float: left;margin-left: 10px;"> <?=$rdfs[0]->estaca_inicial_b?></p>      
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="aparelho_rastreamento">Estaca Final PV</label><br>
                                    <p style="width: 45%;float: left;"><?=$rdfs[0]->estaca_final_a?></p>
                                    <p style="width: 45%;float: left;margin-left: 10px;"><?=$rdfs[0]->estaca_final_b?></p>      
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="aparelho_rastreamento">Metros</label><br>
                                    <p><?=$valor_certo_furos?></p>    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="perfuratriz">Perfuratriz:</label>
                                        <?= $rdfs[0]->perfuratriz == "0" ? '-' : '' ?>
                                        <?php foreach($perfuratriz as $perf){  ?>
                                            <?= $perf->id == $rdfs[0]->perfuratriz ? '<p>'.$perf->nome.'</p>' : '' ?>
                                        <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="aparelho_rastreamento">Rastreador de navegação:</label>
                                    <?= $rdfs[0]->aparelho_rastreamento == "0" ? '-' : '' ?>
                                    <?= $rdfs[0]->aparelho_rastreamento == "1" ? '<p>Rodovia</p>' : '' ?>


                                    <?php foreach($rastreador as $rastre){  ?>
                                        <?php if($rastre->id == 0){ ?>
                                            <p>NA</p>
                                        <?php } ?>
                                        <p><?= $rastre->id == $rdfs[0]->aparelho_rastreamento ? $rastre->fabricante.' '.$rastre->nome : '' ?></p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="qtd_solda">Quantidade de Solda: </label>
                                    <p> <?=$rdfs[0]->qtd_solda?></p>         
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <p>Tubulação Instalada</p>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="n_dutos">Nº de dutos:</label>
                                    <p><?=$rdfs[0]->n_dutos?></p>            
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="diametro">Diâmetro: </label>
                                    <p><?=$rdfs[0]->diametro?></p>            
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="material">Material:</label>
                                    <p><?=$rdfs[0]->material?></p>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-xs-3">
                                <div class="form-group">
                                    <label for="fornecedor">Fornecedor:</label>
                                    <p><?=$rdfs[0]->fornecedor?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <?php if(count($produtos)>0){ ?>
                        <div class="row_border">
                            <label for="produtos" style="font-weight: 800;">Produtos</label>
                            <div class="row">
                            <?php foreach($produtos as $row){

                                if($row->unidade == 1){
                                    $unidade = "Litros";
                                }
                                if($row->unidade == 2){
                                    $unidade = "Kg";
                                }    
                                $value = 0;
                                $data = $this->db->get_where('produtos_rdf', array('produto_id' => $row->id, 'rdf_id' => $rdf_id));
                                if($data->num_rows() > 0){
                                    $resultado = $data->result();
                                    $value = $resultado[0]->qtd;
                                }
                                ?>
                                <div class="col-lg-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="produtos"><?=$row->nome?>  (<?=$unidade?>)</label>
                                        <?=$value?>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="solo">Solo:</label>
                                        <p><?= $rdfs[0]->solo == "0" ? 'NA' : '' ?></p>
                                        <p><?= $rdfs[0]->solo == "1" ? 'Rocha' : '' ?></p>
                                        <p><?= $rdfs[0]->solo == "2" ? 'Argila' : '' ?></p>
                                        <p><?= $rdfs[0]->solo == "3" ? 'Areia' : '' ?></p>
                                        <p><?= $rdfs[0]->solo == "4" ? 'Misto' : '' ?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="travessia">Travessia: <?=$rdfs[0]->travessia?></label>
                                        <p> <?= $rdfs[0]->travessia == 0 ? 'NA' : '' ?></p>
                                        <p> <?= $rdfs[0]->travessia == 1 ? 'Rodovia' : '' ?> </p>
                                        <p> <?= $rdfs[0]->travessia == 2 ? 'Ferrovia' : '' ?> </p>
                                        <p> <?= $rdfs[0]->travessia == 3 ? 'Avenida' : '' ?> </p>
                                        <p> <?= $rdfs[0]->travessia == 4 ? 'Rua' : '' ?> </p>
                                        <p> <?= $rdfs[0]->travessia == 5 ? 'Rio' : '' ?> </p>
                                        <p> <?= $rdfs[0]->travessia == 6 ? 'Area aberta' : '' ?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="aplicacao">Aplicação: </label>
                                        <p> <?= $rdfs[0]->aplicacao == 0 ? 'NA' : '' ?> </p>
                                        <p> <?= $rdfs[0]->aplicacao == 1 ? 'Água' : '' ?> </p>
                                        <p> <?= $rdfs[0]->aplicacao == 2 ? 'Esgoto' : '' ?> </p>
                                        <p> <?= $rdfs[0]->aplicacao == 3 ? 'Eletricidade' : '' ?> </p>
                                        <p> <?= $rdfs[0]->aplicacao == 4 ? 'Gás' : '' ?> </p>
                                        <p> <?= $rdfs[0]->aplicacao == 5 ? 'Telefonia' : '' ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <p>Riscos Ambientais</p>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="vazamento_oleo">Vaz. de óleo:</label>
                                        <p><?= ($rdfs[0]->vazamento_oleo == 2 or $rdfs[0]->vazamento_oleo == 0) ? 'Não' : '' ?></p>
                                        <p><?= $rdfs[0]->vazamento_oleo == 1 ? 'SIM' : '' ?> </p>  
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="descricao_medidas_vazamento_oleo">Descrição das medidas: </label>  
                                    <p><?=$rdfs[0]->qtd_solda?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="comentario_cliente_vazamento_oleo">Comentários do cliente: </label>  
                                    <p><?=$rdfs[0]->qtd_solda?></p>       
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="solo">Vaz. de gás:</label>
                                        <p><?= ($rdfs[0]->vazamento_gas == 2 or $rdfs[0]->vazamento_gas == 0) ? 'Não' : '' ?></p>
                                        <p><?= $rdfs[0]->vazamento_gas == 1 ? 'SIM' : '' ?> </p> 
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="descricao_medidas_vazamento_gas">Descrição das medidas: </label>  
                                    <p><?=$rdfs[0]->descricao_medidas_vazamento_gas?></p>          
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="comentario_cliente_vazamento_gas">Comentários do cliente: </label>  
                                    <p><?=$rdfs[0]->comentario_cliente_vazamento_gas?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="riscos_desmatamento">Desmatamento:</label>
                                    <p><?= ($rdfs[0]->riscos_desmatamento == 2 or $rdfs[0]->riscos_desmatamento == 0) ? 'Não' : '' ?></p>
                                    <p><?= $rdfs[0]->riscos_desmatamento == 1 ? 'SIM' : '' ?> </p>     
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="descricao_medidas_desmatamento">Descrição das medidas: </label>  
                                    <p><?=$rdfs[0]->descricao_medidas_desmatamento?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="comentario_cliente_desmatamento">Comentários do cliente: </label>  
                                    <p><?=$rdfs[0]->comentario_cliente_desmatamento?></p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="riscos_outros">Outros:</label>
                                        <p><?= ($rdfs[0]->riscos_outros == 2 or $rdfs[0]->riscos_outros == 0) ? 'Não' : '' ?></p>
                                        <p><?= $rdfs[0]->riscos_outros == 1 ? 'SIM' : '' ?> </p>     
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="descricao_medidas_outros">Descrição das medidas: </label>  
                                    <p><?=$rdfs[0]->descricao_medidas_outros?></p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="comentario_cliente_outros">Comentários do cliente: </label>  
                                    <p><?=$rdfs[0]->comentario_cliente_outros?></p>     
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <p>Sequência de alargamento:</p>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="1_pre_0">1º pré 0 :</label>
                                    <p><?=$rdfs[0]->_1_pre_0?></p>           
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="2_pre_0">2º pré 0 :</label>
                                    <p><?=$rdfs[0]->_2_pre_0?></p>            
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <label for="3_pre_0">3º pré 0 :</label>
                                    <p><?=$rdfs[0]->_3_pre_0?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="info" style="font-weight: 800;">INFORMAÇÕES GERAIS:</label><br>
                                    <?=$rdfs[0]->info != "" ?  '<p>'.$rdfs[0]->info.'</p>' : 'NA' ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                    if(count($assinaturas_rdf)>0){  ?>
                        <div class="row_border">
                            <div class="row">
                                <?php foreach($assinaturas_rdf as $assinatura){ ?>
                                    <div class="col-lg-6 col-md-6 col-sm-6 ">
                                        <div id="output" class="ui-outputpanel ui-widget" style="text-align:center">
                                            <div id="assinaturaOutput<?=$assinatura->funcionario_id?>" style="width:300px;height:180px;" class="ui-widget ui-widget-content ui-corner-all">
                                                <input id="assinaturaOutput<?=$assinatura->funcionario_id?>_value" name="assinaturaOutput_value_1" type="hidden" autocomplete="off" aria-hidden="true" value='<?=$assinatura->assinatura?>' /></div>
                                                <span class="p-d-block p-mb-2" style="font-size:12px"><?=$assinatura->nome.' '.$assinatura->sobrenome?></span>
                                            <script id="assinaturaOutput_s" type="text/javascript">
                                                dc.cw("Signature", "widget_assinaturaOutput", {
                                                    id: "assinaturaOutput<?=$assinatura->funcionario_id?>",
                                                    background: "#f4f4f4",
                                                    color: "#000",
                                                    readonly: true
                                                });
                                            </script>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } 
                    // p($lista_de_furos);
                    ?>
                        
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                            <label for="info" style="font-weight: 800;">LISTA DE FUROS</label><br>
                                <?php if(count($lista_de_furos)>0){ ?>
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">Barra/Metros</th>
                                                <th scope="col">Prof</th>
                                                <th scope="col">Pith (%)</th>
                                                <th scope="col">AM/LAT</th>
                                                <th scope="col">PV</th>
                                            </tr>
                                        </thead>
                                        <?php
                                        foreach ($lista_de_furos as $key => $rdf){  ?>
                                        <tr>
                                            <td><?=$rdf->numeracao?></td>     
                                            <td><?=$rdf->prof?></td>                                            
                                            <td><?=$rdf->pith?></td>                                            
                                            <td><?=$rdf->amlat?></td>  
                                            <td>
                                                <?php 
                                                    if(isset($lista_de_furos[$key-1]->pv) and ($lista_de_furos[$key-1]->pv == $rdf->pv)){
                                                        echo '--';
                                                    }else{
                                                        echo $rdf->pv;
                                                    }
                                                ?>
                                            </td>                                            
                                        </tr>
                                        <?php } ?>
                                    </table>
                                <?php }else{?>
                                    <p>Nenhum furo registrado</p>
                                <?php }?>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                            <p>Valor Sugerido</p>
                            <br>
                            <?php 
                                $soma_dos_pvs = 0;
                                $i = 1;
                                foreach($soma_final as $key => $soma){
                                    if($i < count($soma_final)){
                                        $soma_dos_pvs += $soma['total'];
                                    }
                                ?>
                                    <span style="border: 1px #3a3c53 solid;padding: 7px 5px;font-size: 10px;"><?=$key?></span>
                                    <?php  if($i < count($soma_final)){ ?>
                                        <span style="padding: 1px 10px;border-bottom: 1px #3a3c53 solid;font-size: 10px;"><?=$soma['total']?></span>
                                     <?php  } ?>

                                <?php $i++; } ?>

                                <br><br>
                                <p><span style="font-weight: 700;">Valor Sugerido: </span><?=$soma_dos_pvs?></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
      </div>
    </div>





<!-- <div class="container mt-4">

    <?php foreach($assinaturas_rdf as $assinatura){ ?>

        <div id="output" class="ui-outputpanel ui-widget"><span class="p-d-block p-mb-2" style="font-size:1rem"><?=$assinatura->nome.' '.$assinatura->sobrenome?></span>
            <div id="assinaturaOutput<?=$assinatura->funcionario_id?>" style="width:400px;height:200px;" class="ui-widget ui-widget-content ui-corner-all">
            <input id="assinaturaOutput<?=$assinatura->funcionario_id?>_value" name="assinaturaOutput_value_1" type="hidden" autocomplete="off" aria-hidden="true" value='<?=$assinatura->assinatura?>' /></div>
            <script id="assinaturaOutput_s" type="text/javascript">
                dc.cw("Signature", "widget_assinaturaOutput", {
                    id: "assinaturaOutput<?=$assinatura->funcionario_id?>",
                    background: "#eaeaea",
                    color: "#03a9f4",
                    readonly: true
                });
            </script>
        </div>

    <?php } ?>
   


</div> -->

</body>
</html>