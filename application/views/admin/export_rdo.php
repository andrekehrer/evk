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
      .row_border{border: 1px #cbcbcb solid;padding: 5px;margin-bottom: -1px;}
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
                <div style="text-align: center;">
                    <img src="https://evk.andrekehrer.com/assets/img/logo.png"  width="60">
                    <h1 class="page-title mb-1 mt-1" style="font-size: 14px !important;">
                        RELATÓRIO DIÁRIO DE OBRA (RDO) - <b><?=date('d/m/Y',$rdos[0]->data)?></b>
                    </h1>
                </div>
                <div class="page-header" style="margin: 20px 0px 0px 0px !important;">
                    <h3 class="page-title">
                        <?php echo $detalhes_bra[0]->obra_nome.' ('.$detalhes_bra[0]->numero_id.') [<b>'.$tipo.'</b>]'; ?>
                    </h3>
                </div>
                    <?php date_default_timezone_set('America/Sao_Paulo'); ?>
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label for="data">Data</label><br>
                                    <?=date("d/m/Y h:i:sa", $rdos[0]->data)?>           
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                <div class="form-group">
                                    <label for="data">Data alterada</label><br>
                                    <?=date("d/m/Y", $rdos[0]->data_alterada)?>           
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="form-group">
                                    <label for="hora_inicio">Início do exp: </label> <br>
                                    <?=$rdos[0]->horario_inicio_exp?>          
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="form-group">
                                    <label for="hora_inicio_obra">Início da obra:</label> <br>
                                    <?=$rdos[0]->horario_inicio_obra?>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                <div class="form-group">
                                    <label for="hora_termino_obra">Término da obra:</label> <br>
                                    <?=$rdos[0]->horario_termino_exp?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="hora_inicio">Número de soldas: </label> <br>
                                    <?=$rdos[0]->numero_soldas?>          
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="hora_inicio_obra">Diâmetro da tubulação:</label> <br>
                                    <?=$rdos[0]->diametro_t?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="hora_termino_obra">Metragem do furo:</label> <br>
                                    <?=$rdos[0]->distancia_t?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="cliente">Cliente</label> <br>
                                    <?=$detalhes_bra[0]->cliente_nome?>         
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label for="veiculos">Veiculos</label>
                                    <div id="sel-cont">
                                            <?php foreach($frota_array as $carro){?>
                                                <?=$carro->nome?>
                                            <?php } ?>
                                        <br/>
                                    </div>        
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="form-group">
                                    <label for="motoristas">Motoristas</label>
                                    <div id="sel-cont">
                                            <?php foreach($funcionarios as $row){?>
                                               <?=in_array($row->id, $motoristas_array) ? $row->nome.' '.$row->sobrenome : "" ?>
                                            <?php } ?>
                                        <br/>
                                    </div>           
                                </div>
                            </div>
                        </div>
                    </div>
                         
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                <div class="form-group">
                                    <label for="endereco">Endereco</label> <br>
                                        <?=$rdos[0]->endereco == '' ? $detalhes_bra[0]->endereco: $rdos[0]->endereco?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="numero">Número</label> <br>
                                        <?=$rdos[0]->numero == '' ? $detalhes_bra[0]->numero: $rdos[0]->numero?>
                                </div>
                            </div>
                            
                        </div>   
                        <hr>  
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="bairro">Bairro</label> <br>
                                        <?=$rdos[0]->bairro == '' ? $detalhes_bra[0]->bairro: $rdos[0]->bairro?>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="cidade">Cidade</label> <br>
                                        <?=$rdos[0]->cidade == '' ? $detalhes_bra[0]->cidade: $rdos[0]->cidade?>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <label for="estado">Estado</label> <br>
                                        <?= $detalhes_bra[0]->estado == "AC" ? 'Acre' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "AL" ? 'Alagoas' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "AP" ? 'Amapá' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "AM" ? 'Amazonas' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "BA" ? 'Bahia' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "CE" ? 'Ceará' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "DF" ? 'Distrito Federal' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "ES" ? 'Espírito Santo' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "GO" ? 'Goiás' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "MA" ? 'Maranhão' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "MT" ? 'Mato Grosso' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "MS" ? 'Mato Grosso do Sul' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "MG" ? 'Minas Gerais' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "PA" ? 'Pará' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "PB" ? 'Paraíba' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "PR" ? 'Paraná' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "PE" ? 'Pernambuco' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "PI" ? 'Piauí' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "RJ" ? 'Rio de Janeiro' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "RN" ? 'Rio Grande do Norte' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "RS" ? 'Rio Grande do Sul' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "RO" ? 'Rondônia' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "RR" ? 'Roraima' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "SC" ? 'Santa Catarina' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "SP" ? 'São Paulo' : '' ?>  
                                        <?= $detalhes_bra[0]->estado == "SE" ? 'Sergipe' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "TO" ? 'Tocantins' : '' ?> 
                                        <?= $detalhes_bra[0]->estado == "EX" ? 'Estrangeiro' : '' ?> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group ">
                                    <label for="endereco" style="font-weight: 800;">Observações e ocorrências dos serviços executados:</label><br>
                                    <div class="mb-3 mt-3">
                                        <?=$rdos[0]->obs?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row_border">
                        <div class="row">
                        <?php foreach($produtos as $row){

                            if($row->unidade == 1){
                                $unidade = "Litros";
                            }
                            if($row->unidade == 2){
                                $unidade = "Kg";
                            }    
                            ?>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group">
                                    <b><?=$row->nome?> [<?=$row->qtd?> <?=$unidade?>]</b>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <?php  if(count($func_array)>0){?>
                        <div class="row_border">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div class="form-group">
                                        <label for="funcionarios">Funcionários do dia</label>
                                        <div id="sel-cont">
                                                <?php foreach($funcionarios as $row){?>
                                                <?=in_array($row->id, $func_array) ? $row->nome.' '.$row->sobrenome.' | ' : "" ?> 
                                                <?php } ?>
                                            <br/>
                                        </div>           
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row_border">
                        <div class="row">
                            <?php foreach($assinaturas_rdo as $assinatura){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-6 ">
                                    <div id="output" class="ui-outputpanel ui-widget" style="text-align:center">
                                        <div id="assinaturaOutput<?=$assinatura->funcionario_id?>" style="width:300px;height:180px;" class="ui-widget ui-widget-content ui-corner-all">
                                            <input id="assinaturaOutput<?=$assinatura->funcionario_id?>_value" name="assinaturaOutput_value_1" type="hidden" autocomplete="off" aria-hidden="true" value='<?=$assinatura->assinatura?>' /></div>
                                            <span class="p-d-block p-mb-2" style="font-size:12px">
                                            <?php 
                                                if($assinatura->funcionario_id == 99){
                                                    echo 'Assinatura do líder da equipe';
                                                }
                                                if($assinatura->funcionario_id == 88){
                                                    echo 'Assinatura do cliente';
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





<!-- <div class="container mt-4">

    <?php foreach($assinaturas_rdo as $assinatura){ ?>

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