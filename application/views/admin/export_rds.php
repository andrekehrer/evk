<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id. ') '; ?><?=date('d/m/Y',$rdos[0]->data)?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://getbootstrap.com/docs/5.0/examples/grid/grid.css" rel="stylesheet">
    <style>
        .title_p_center{text-align: center;background: #d8d8d8;padding: 5px;width: 98.5%;margin: 0 auto;}
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }
        .table>:not(caption)>*>* {padding: 0 !important;}

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
            font-size: 3.5rem;
            }
        }
        @media (max-width: 575px) {
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
        table{font-size: 9px !important;}
      .row_border{border: 1px #cbcbcb solid;padding: 0px 5px 0px 5px;margin-bottom: -1px;}
      label{font-weight: 700;}
      .h3, h3 {font-size: 14px !important;}
      hr {margin: 0.2rem 0 !important;}
      body {font-size: 0.7rem !important;}
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
                <div style="text-align: center;padding: 0px 5px 0px 5px; !important" class="row_border">
                    <img src="https://evk.andrekehrer.com/assets/img/logo.png"  width="60">
                    <span class="page-title mb-1 mt-1" style="font-size: 14px !important;">
                        RELATÓRIO DIÁRIO DE SOLDA
                    </span>
                </div>
                <div class="page-header" style="margin: 8px 0px 0px 0px !important;">
                    <h3 class="page-title">
                        <b>Local da Obra: </b> <?=$detalhes_bra[0]->obra_nome?> - <?=$detalhes_bra[0]->cidade?>/<?=$detalhes_bra[0]->estado?>
                    </h3>
                </div>
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                    <div class="row_border">
                        <div class="row">
                            <p class="title_p_center"><b>Tubo 1</b></p>
                            <div style="height: 10px;"></div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="tubo1_de">DE: </label> <?=$rdss[0]->tubo1_de?>     
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo1_tipo_material">Tipo Material: </label> <?=$rdss[0]->tubo1_tipo_material?>           
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo1_pn">PN: </label> <?=$rdss[0]->tubo1_pn?>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo1_sdr">SDR: </label> <?=$rdss[0]->tubo1_sdr?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo1_comprimento">Comprimento: </label> <?=$rdss[0]->tubo1_comprimento?>            
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo1_fabricante">Fabricante: </label> <?=$rdss[0]->tubo1_fabricante?>           
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo1_lote">No Lote: </label> <?=$rdss[0]->tubo1_lote?>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo1_data_fabricacao">Data Fabricação:</label> <?=$rdss[0]->tubo1_data_fabricacao?>            
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <label for="tubo1_obs">Observações: </label> <?=$rdss[0]->tubo1_obs?>           
                            </div>
                        </div>

                    </div>

                    <div class="row_border">
                        <div class="row">
                            <p class="title_p_center"><b>Tubo 2</b></p>
                            <div style="height: 10px;"></div>

                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <label for="tubo2_de">DE: </label> <?=$rdss[0]->tubo2_de?>     
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo2_tipo_material">Tipo Material: </label> <?=$rdss[0]->tubo2_tipo_material?>           
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo2_pn">PN: </label> <?=$rdss[0]->tubo2_pn?>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo2_sdr">SDR: </label> <?=$rdss[0]->tubo2_sdr?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo2_comprimento">Comprimento: </label> <?=$rdss[0]->tubo2_comprimento?>            
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo2_fabricante">Fabricante: </label> <?=$rdss[0]->tubo2_fabricante?>           
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <label for="tubo2_lote">No Lote: </label> <?=$rdss[0]->tubo2_lote?>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="tubo2_data_fabricacao">Data Fabricação:</label> <?=$rdss[0]->tubo2_data_fabricacao?>            
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <label for="tubo2_obs">Observações: </label> <?=$rdss[0]->tubo2_obs?>           
                            </div>
                        </div>

                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding: 7px;text-align: center;">
                                <label for="numero_solda" style="font-weight: 800;font-size: 12px;">Número da Solda:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding: 7px;text-align: center;font-size: 12px;">
                                <?=$rdss[0]->numero_solda?>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">

                        <div class="row">
                            <div class="col-lg-12">
                                <table class="table">
                                    <tr>
                                        <td>Parâmetros</td>
                                        <td>Resultados</td>
                                        <td>Unidade</td>
                                    </tr>
                                    <tr>
                                        <td>Horario de Inicio de Solda:</td>
                                        <td><?=$rdss[0]->p_hoario_inicio?></td>
                                        <td>hrs e min</td>
                                    </tr>
                                    <tr>
                                        <td>Temp. da placa de Solda:</td>
                                        <td><?=$rdss[0]->p_temp_placa_solda?></td>
                                        <td>oC</td>
                                    </tr>
                                    <tr>
                                        <td>Desaslinhamento Max Permitido:</td>
                                        <td><?=$rdss[0]->p_desalinhamento_max_perm?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Desaslinhamento Observado:</td>
                                        <td><?=$rdss[0]->p_desalinhamento_obs?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Fresta max Permitida:</td>
                                        <td><?=$rdss[0]->p_fresta_max_perm?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Fresta Observada:</td>
                                        <td><?=$rdss[0]->p_fresta_obs?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Pressão de Arraste:</td>
                                        <td><?=$rdss[0]->p_pressao_arraste?></td>
                                        <td>Kgf/cm2</td>
                                    </tr>
                                    <tr>
                                        <td>Pressão de Solda:</td>
                                        <td><?=$rdss[0]->p_pressao_solda?></td>
                                        <td>Kgf/cm2</td>
                                    </tr>
                                    <tr>
                                        <td>Pressão de Pré Aquecimento/junção:</td>
                                        <td><?=$rdss[0]->p_pressao_pre_aquecimento_juncao?></td>
                                        <td>Kgf/cm2</td>
                                    </tr>
                                    <tr>
                                        <td>Tempo de aquecimento:</td>
                                        <td><?=$rdss[0]->p_tempoo_aquecimento?></td>
                                        <td>Segundos</td>
                                    </tr>
                                    <tr>
                                        <td>Pressão de Aquecimento / Simples contato:</td>
                                        <td><?=$rdss[0]->p_pressao_aquecimento_simples_contato?></td>
                                        <td>Kgf/cm2</td>
                                    </tr>
                                    <tr>
                                        <td>Tempo para retirada da placa de aquecimento:</td>
                                        <td><?=$rdss[0]->p_tempo_retirada_placa_aquecimento?></td>
                                        <td>Segundos</td>
                                    </tr>
                                    <tr>
                                        <td>Tempo de Resfriamento:</td>
                                        <td><?=$rdss[0]->p_tempo_resfriamento?></td>
                                        <td>Seg ou min</td>
                                    </tr>
                                    <tr>
                                        <td>Largura inicial do cordão:</td>
                                        <td><?=$rdss[0]->p_largura_inical_cordao?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Largura final do cordão:</td>
                                        <td><?=$rdss[0]->p_largura_final_cordao?></td>
                                        <td>mm</td>
                                    </tr>
                                    <tr>
                                        <td>Término da solda:</td>
                                        <td><?=$rdss[0]->p_termino_solda?></td>
                                        <td>Horas e Min</td>
                                    </tr>
                                    <tr>
                                        <td>Previsão de horario de liberação da solda:</td>
                                        <td><?=$rdss[0]->p_previsao_horario_liberacao_solda?></td>
                                        <td>Horas e Min</td>
                                    </tr>


                                </table>
                            </div>
                        </div> 

                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="padding: 7px;text-align: center;">
                                <label for="numero_solda" style="font-weight: 800;font-size: 12px;">Resultado da Solda:</label>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="padding: 7px;text-align: center;font-size: 12px;">
                                <?= $rdss[0]->resultado_da_solda == "0" ? '---' : '' ?>
                                <?= $rdss[0]->resultado_da_solda == "1" ? 'Aprovado' : '' ?>
                                <?= $rdss[0]->resultado_da_solda == "2" ? 'Reprovado' : '' ?>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <p class="title_p_center" style="width: 100% !important;"><b>Descrição do equipamento de solda</b></p>
                        <div style="height: 10px;"></div>
                        <div class="row">
                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                <label for="fabricante">Fabricante </label> <?=$rdss[0]->fabricante?>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <label for="modelo_e_voltagem">Modelo e voltagem</label> <?=$rdss[0]->modelo_e_voltagem?>
                            </div>
                            
                        </div>     

                    </div>
                    
                   
                    <div class="row_border">
                        <div class="row">
                            <?php foreach($assinaturas_rds as $assinatura){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div id="output" class="ui-outputpanel ui-widget" style="text-align:center">
                                        <div id="assinaturaOutput<?=$assinatura->funcionario_id?>" style="width:300px;height:180px;" class="ui-widget ui-widget-content ui-corner-all">
                                            <input id="assinaturaOutput<?=$assinatura->funcionario_id?>_value" name="assinaturaOutput_value_1" type="hidden" autocomplete="off" aria-hidden="true" value='<?=$assinatura->assinatura?>' /></div>
                                            <span class="p-d-block p-mb-2" style="font-size:12px">
                                            <?php 
                                                if($assinatura->funcionario_id == 99){
                                                    echo 'ENGENHEIRO EVK';
                                                }
                                                if($assinatura->funcionario_id == 88){
                                                    echo 'SOLDADOR RESP';
                                                }
                                            ?>
                                            <?=$assinatura->nome.' '.$assinatura->sobrenome?>
                                        
                                        </span>
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
            </div>
        </div>
      </div>
    </div>


</body>
</html>