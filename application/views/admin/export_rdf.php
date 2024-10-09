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
    .table>:not(caption)>*>* {
        padding: 0.1rem .1rem !important;
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
                         RDF - RELATÓRIO DIÁRIO DE FURO 
                    </h1>
                </div>
                <div class="page-header" style="margin: 20px 0px 0px 0px !important;">
                    <h3 class="page-title">
                        
                        
                    </h3>
                </div>
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <p><b>Cliente: </b><?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id.') [<b>'.$tipo.'</b>]'; ?></p>
                                <p><b>Responsável da obra: </b><?php echo $rdfs[0]->nome.' '.$rdfs[0]->sobrenome; ?></p>
                                <p><b>Data do Relatório: </b><?= $rdfs[0]->data != '' ? date("d/m/Y h:i:sa", $rdfs[0]->data) : '--'?></p>
                            </div>
                        </div>
                    </div>
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <p><b>Estado: </b>
                                    <?= $detalhes_bra[0]->estado == ""   ?  '' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AC" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AL" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AP" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "AM" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "BA" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "CE" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "DF" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "ES" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "GO" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MA" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MT" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MS" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "MG" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PA" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PB" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PR" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PE" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "PI" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RJ" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RN" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RS" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RO" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "RR" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SC" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SP" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "SE" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "TO" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                       <?= $detalhes_bra[0]->estado == "EX" ?  ''.$detalhes_bra[0]->estado.'' : '' ?>
                                    </p>
                                    <p><b>Cidade: </b><?=$rdfs[0]->cidade == '' ? $detalhes_bra[0]->cidade: $rdfs[0]->cidade?></p>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8 col-xs-8">
                                <div class="form-group">
                                    <p><b>Bairro: </b><?=$rdfs[0]->bairro == '' ? $detalhes_bra[0]->bairro: $rdfs[0]->bairro?></p>
                                    <p><b>Endereco: </b><?=$rdfs[0]->endereco == '' ? $detalhes_bra[0]->endereco: $rdfs[0]->endereco?>, <?=$rdfs[0]->numero == '' ? $detalhes_bra[0]->numero: $rdfs[0]->numero?></p>
                                </div>
                            </div>
                           
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <p><b>Data Furo Piloto: </b><?= $rdfs[0]->data_furo_piloto != '' ? date("d/m/Y", $rdfs[0]->data_furo_piloto) : '--'?></p>               
                                    <p><b>Data Puxe: </b><?= $rdfs[0]->data_puxe != '' ? date("d/m/Y", $rdfs[0]->data_puxe) : '--'?></p>   
                                    <br>
                                    <p><b>No de dutos instalados: </b><?=$rdfs[0]->n_dutos?></p>   
                                    <p><b>Diâmetros: </b><?=$rdfs[0]->diametro?></p>   
                                    <p><b>Material: </b><?=$rdfs[0]->Material?></p>   
                                    <p><b>Fornecedor: </b><?=$rdfs[0]->fornecedor?></p>   

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <p><b>Estaca Inicial PV: </b><?=$rdfs[0]->estaca_inicial_a?></p>
                                    <p><b>Estaca Final PV: </b><?=$rdfs[0]->estaca_inicial_b?></p>
                                    <br>
                                    <p><b>Sequência de alargamento:</b></p>
                                    <p><b>1º pré 0 : </b><?=$rdfs[0]->_1_pre_0?></p>
                                    <p><b>2º pré 0 : </b><?=$rdfs[0]->_2_pre_0?></p>
                                    <p><b>3º pré 0 : </b><?=$rdfs[0]->_3_pre_0?></p>

                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-xs-4">
                                <div class="form-group">
                                    <p><b>Furo No: </b><?=$rdfs[0]->furo_numero?></p>
                                    <p><b>Metros: </b><?=$valor_certo_furos?></p>
                                    <br>
                                    <br>  
                                    <p><b>Solo: </b>
                                        <?= $rdfs[0]->solo == "0" ? 'NA' : '' ?>
                                        <?= $rdfs[0]->solo == "1" ? 'Rocha' : '' ?>
                                        <?= $rdfs[0]->solo == "2" ? 'Argila' : '' ?>
                                        <?= $rdfs[0]->solo == "3" ? 'Areia' : '' ?>
                                        <?= $rdfs[0]->solo == "4" ? 'Misto' : '' ?>
                                    </p>
                                    <p><b>Travessia: </b>
                                        <?= $rdfs[0]->travessia == 0 ? 'NA' : '' ?>
                                        <?= $rdfs[0]->travessia == 1 ? 'Rodovia' : '' ?> 
                                        <?= $rdfs[0]->travessia == 2 ? 'Ferrovia' : '' ?> 
                                        <?= $rdfs[0]->travessia == 3 ? 'Avenida' : '' ?> 
                                        <?= $rdfs[0]->travessia == 4 ? 'Rua' : '' ?> 
                                        <?= $rdfs[0]->travessia == 5 ? 'Rio' : '' ?> 
                                        <?= $rdfs[0]->travessia == 6 ? 'Area aberta' : '' ?>
                                    </p>
                                    <p><b>Aplicação: </b>
                                        <?= $rdfs[0]->aplicacao == 0 ? 'NA' : '' ?>
                                        <?= $rdfs[0]->aplicacao == 1 ? 'Água' : '' ?>
                                        <?= $rdfs[0]->aplicacao == 2 ? 'Esgoto' : '' ?>
                                        <?= $rdfs[0]->aplicacao == 3 ? 'Eletricidade' : '' ?>
                                        <?= $rdfs[0]->aplicacao == 4 ? 'Gás' : '' ?>
                                        <?= $rdfs[0]->aplicacao == 5 ? 'Telefonia' : '' ?>
                                    </p>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                    <?php if(count($produtos)>0){ ?>
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td><b>Produto</b></td>
                                                    <td><b>Unid. Medida</b></td>
                                                    <td><b>Qtd.</b></td>
                                                </tr>
                                            </thead>
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
                                                    
                                                    <tr>
                                                        <td><?=$row->nome?></td>
                                                        <td><?=$unidade?></td>
                                                        <td><?=$value?></td>
                                                    </tr>
                                            
                                            <?php } ?>
                                        </table>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-xs-12">
                                <div class="form-group">
                                <p><b>INFORMAÇÕES GERAIS: </b><br><?=$rdfs[0]->info != "" ?  '<p>'.$rdfs[0]->info.'</p>' : 'NA' ?></p>
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
                    <?php } ?>
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                                <br>
                                <label for="info" style="font-weight: 800;">LISTA DE FUROS</label><br>
                                <br>
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