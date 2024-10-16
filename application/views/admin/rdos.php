<?php include('header.php'); ?>
    <style>
        .btn{padding: 0.6rem 1rem;}
        .p_obra{font-size: 0.9em;text-decoration: none;text-transform: none;color: #3a3b53;padding: 0;margin: 0;}
        .p_cidade{font-size: 0.7em;text-decoration: none;text-transform: none;color: #3a3b53;padding: 0;margin: 0;}
        .p_clientes{font-size: 0.8em;text-decoration: none;text-transform: none;color: #317f7c;padding: 0;margin: 0;}
        a{text-decoration: none;text-transform: none;}
        .checkin-btn{background: green;color: white;padding: 6px 26px;}
        .checkin-feito-btn{background: #a4c0cb;color: white;padding: 6px 26px;}
        /* .row_border{border: 1px #cbcbcb solid;padding: 20px 10px 0px 10px;margin-bottom: 10px;} */
        .caixa_ck{border: 1px gray solid;width: 90%;padding: 15px;margin-bottom: 40px;background: #e0ebd8;box-shadow: 0px 3px 10px #3a3c53cc;}
        .p_data{font-size: 12px !important;font-weight: 600 !important;margin-bottom: 0px !important;text-align: center;}
        .mdi-check-all{font-size: 30px;color: green;margin-top: -20px;}
        .span_close{padding: 4px 8px;border-radius: 47px;background: #c01010;color: white;float:right}
        .checkout_btn{display: block;background: #215e42;color: white;width: 100%;padding: 14px;text-align: center;margin-top: 15px;}
        .checkout_btn_done{display: block;background: #66706b;color: white;width: 100%;padding: 14px;text-align: center;margin-top: 40px;}
        a:hover {color: white !important;}
        .checkout_css{background: #cacaca;color: #636363;}
        .row1{background: white;padding: 50px 15px;margin-top: -15px;border-bottom: 3px black solid;}
        #subButton{width: 100%;height: 45px;}
        select.form-control {padding: 8px 8px !important;border: 1px gray solid !important;color: #000000 !important}
        .page-header {margin-top: 10px !important}
        p {line-height: 1 !important}
        .card .card-body {padding: 1.5rem 0.5rem !important;}
    </style>
    <div class="container-scroller">
        <?php include('nav.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('menu.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                <div class="row row1">
                    <div class="page-header">
                        <h3 class="page-title">
                            Faça seu Checkin
                        </h3>
                    </div>
                    <?php 
                        $today_dia  = date("d-m-Y");
                        $this->db->select('*');
                        $this->db->from('rdos');
                        $this->db->where('dia_criada', $today_dia);
                        $this->db->order_by('rdos.id', 'DESC');
                        $data = $this->db->get()->result();

                        $obra_array = array();
                        $viculos_reservados = array();

                        if($data){
                            foreach($data as $d){
                                array_push($obra_array, $d->id);
                            }
                            $this->db->select('*');
                            $this->db->from('veiculos_rdo');
                            $this->db->where_in('rdo_id', $obra_array);
                            $veic = $this->db->get()->result();

                            foreach($veic as $v){
                                array_push($viculos_reservados, $v->frota_id);
                            }
                        }
                    

                    ?>  
                    <?php //if($_SESSION['backend']['permissao'] == 3){ ?>
                    <form id="" class="forms-sample" action="<?=base_url()?>admin/rdo/checkin_funcionario_motorista/" method="POST" enctype="multipart/form-data" style="max-width: 450px;">
                        <input type="hidden" class="hidden" name="lat" value="">
                        <input type="hidden" class="hidden" name="longe" value="">
                            <div class="row_border">
                                <div class="row">
                                    <div class="col-lg-12"> 
                                        <div class="form-group">
                                            <label for="admissao">Obra</label>
                                            <select class="form-control" id="obra" name="obra">
                                                <?php foreach($obras as $row){  
                                                    $today_dia  = date("d-m-Y");
                                                    $this->db->select('*');
                                                    $this->db->from('rdos');
                                                    $this->db->where('id_obra', $row->id);
                                                    $this->db->where('dia_criada', $today_dia);
                                                    $this->db->order_by('rdos.id', 'DESC');
                                                    $this->db->limit(1);
                                                    $data = $this->db->get()->result();
                                                    $checkin = $this->db->get_where('funcionarios_rdo', array('funcionario_id' => $id_usuario, 'rdo_id' => $data[0]->id))->result();
                                                ?>
                                                    <option <?= ($checkin) ? 'disabled' : '' ?> value="<?=$row->id?>"><?=$row->obra_nome?></option>
                                                <?php }?>
                                            </select> 
                                        </div>
                                    </div>
                                    <?php if($_SESSION['backend']['motorista'] == 1){ ?>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="registro">Veículo</label>
                                            <select class="form-control" id="veiculo" name="veiculo">
                                                <option  value="0">Nenhum veículo</option>
                                                <?php foreach($veiculos as $row){ ?>
                                                    <option <?= (in_array($row->id, $viculos_reservados)) ? 'disabled' : '' ?> value="<?=$row->id?>"><?=$row->nome?></option>
                                                <?php }?>
                                            
                                            </select>      
                                        </div>
                                    </div>
                                    <?php //} ?>
                                </div>
                            </div>
                        <button type="submit" id="subButton" class="btn btn-gradient-primary me-2 mt-2" disabled>Fazer o Checkin</button>
                    </form>


                </div>

                <div class="row" style="padding-top: 30px;justify-content: center;">   
                    <div class="page-header">
                        <h3 class="page-title">
                            Seus Checkins
                        </h3>
                    </div>
                    <?php 
                    
                        foreach($obras as $row){ 
                            
                            $today_dia  = date("d-m-Y");
                            $this->db->select('*');
                            $this->db->from('rdos');
                            $this->db->where('id_obra', $row->id);
                            $this->db->where('dia_criada', $today_dia);
                            $this->db->order_by('rdos.id', 'DESC');
                            $this->db->limit(1);
                            $data = $this->db->get()->result();
                            $checkin = $this->db->get_where('funcionarios_rdo', array('funcionario_id' => $id_usuario, 'rdo_id' => $data[0]->id))->result();
                            
                            $this->db->select('frotas.nome, frotas.placa');
                            $this->db->from('veiculos_rdo');
                            $this->db->join('frotas', 'veiculos_rdo.frota_id = frotas.id');
                            $this->db->where('veiculos_rdo.rdo_id', $data[0]->id);
                            $this->db->where('veiculos_rdo.funcionario_id', $id_usuario);
                            $carro = $this->db->get()->result();

                            $placa = 0;
                            if($carro[0]->nome){
                                $placa = 1;
                            }
                            $tem_checkout = 0;
                            $tem_checkout_css = '';
                            if($checkin){ 
                                if($checkin[0]->checkout){$tem_checkout = $checkin[0]->checkout;$tem_checkout_css = 'checkout_css';}
                                ?> 
                                <div class="caixa_ck <?=$tem_checkout_css?>">
                                    <?php if($tem_checkout == 0) {?>
                                        <a href="<?=base_url()?>admin/rdo/remover_checkin/<?=$data[0]->id?>/<?=$id_usuario?>/<?=$placa?>"><span class="span_close">X</span></a>
                                    <?php }?>
                                    <p class="p_data"><?=$data[0]->dia_criada?></p>
                                    <p style="text-align: center;font-size: 16px;font-weight: 800;"><?=$row->obra_nome?></p>
                                    <p style="text-align: center;margin-bottom: 4px;color: green !important;"><i class="mdi mdi-arrow-right-bold-circle-outline"></i> <?=date('h:i:sa', $checkin[0]->checkin);?> </p>
                                    <?php if($tem_checkout != 0) {?>
                                        <p style="text-align: center;margin-bottom: 4px;color: #631b1b !important;"><i class="mdi mdi-arrow-left-bold-circle-outline"></i> <?=date('h:i:sa', $tem_checkout);?> </p>
                                    <?php }?>
                                    <hr>
                                    <?php if($placa > 0){?>
                                        <p style="margin-bottom: 0px;"><i class="mdi mdi-car" style="margin-right:10px"></i><?=$carro[0]->nome?> [<?=$carro[0]->placa?>]</p>
                                    <?php } ?>
                                        
                                    <?php if($tem_checkout == 0) {?>
                                        <a class="checkout_btn" href="<?=base_url()?>admin/rdo/checkout_funcionario/<?=$data[0]->id?>/<?=$id_usuario?>/<?=$placa?>">Checkout</a>
                                    <?php }?>
                                </div>
                            <?php }
                        }
                    ?>
                    <?php }?>

                    <hr>  

                    <div class="page-header">
                        <h3 class="page-title">
                            Suas Obras
                        </h3>
                    </div>

                    <?php if(count($obras)<=0 ){ ?>
                        <p class="card-description"> Nenhuma Obra</code><br></p>
                    <?php }elseif($_SESSION['backend']['permissao'] != 3) { ?>

                        <?php foreach($obras as $row){ ?>
                            <div class="col-lg-4" style="margin-bottom: 20px;">
                                <a href="<?=base_url()?>admin/rdo/lista_rdo/<?=$row->id?>">
                                    <div class="card">
                                        <div class="card-body" style="text-align: center;cursor:pointer;border: 3px #4ac4bf solid;border-radius: 8px;padding: 1.5rem 0.5rem !important;">
                                            <p class="p_obra"><b><?=$row->obra_nome?></b></p>
                                            <p class="p_cidade">(<?=$row->numero_id?>)</p>
                                            <p class="p_cidade"><?=$row->cidade?> - <?=$row->estado?></p>
                                            <hr style="margin: 6px;color: #adadad;">
                                            <p class="p_clientes"><?=$row->cliente_nome?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php } ?>
                    <?php } ?>            
                </div>

            <?php include('footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="<?=base_url(); ?>dash/assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="<?=base_url(); ?>dash/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/jquery.cookie.js" type="text/javascript"></script>

    <script src="<?=base_url(); ?>dash/assets/js/off-canvas.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/misc.js"></script>

    <script src="<?=base_url(); ?>dash/assets/js/dashboard.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/todolist.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.css"/>
    
    <script type="text/javascript" src="//cdn.datatables.net/plug-ins/1.13.1/i18n/pt-PT.json"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.13.1/datatables.min.js"></script>
    <script>
        $(document).ready( function () {
            
            function ObterPosicao(lat, long){
                $("input[name=lat]").val(lat);
                $("input[name=longe]").val(long);
            }

            function ExibirLocalizacao(){
            var latitude = 0;
            var longitude = 0;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
            }

            function showPosition(position) {
                    $('#subButton').prop('disabled', false);
                    ObterPosicao(position.coords.latitude, position.coords.longitude);
            }

            ExibirLocalizacao();
            
            $('#example').DataTable(
                {
                    order: [[2, 'desc']],
                    "language" : {
                        "emptyTable": "Não foi encontrado nenhum registo",
                        "loadingRecords": "A carregar...",
                        "processing": "A processar...",
                        "lengthMenu": "Mostrar _MENU_ registos",
                        "zeroRecords": "Não foram encontrados resultados",
                        "search": "Procurar:",
                        "paginate": {
                            "first": "Primeiro",
                            "previous": "Anterior",
                            "next": "Seguinte",
                            "last": "Último"
                        },
                        "aria": {
                            "sortAscending": ": Ordenar colunas de forma ascendente",
                            "sortDescending": ": Ordenar colunas de forma descendente"
                        },
                        "autoFill": {
                            "cancel": "cancelar",
                            "fill": "preencher",
                            "fillHorizontal": "preencher células na horizontal",
                            "fillVertical": "preencher células na vertical"
                        },
                        "buttons": {
                            "collection": "Coleção",
                            "colvis": "Visibilidade de colunas",
                            "colvisRestore": "Restaurar visibilidade",
                            "copy": "Copiar",
                            "copySuccess": {
                                "1": "Uma linha copiada para a área de transferência",
                                "_": "%ds linhas copiadas para a área de transferência"
                            },
                            "copyTitle": "Copiar para a área de transferência",
                            "csv": "CSV",
                            "excel": "Excel",
                            "pageLength": {
                                "-1": "Mostrar todas as linhas",
                                "_": "Mostrar %d linhas"
                            },
                            "pdf": "PDF",
                            "print": "Imprimir",
                            "copyKeys": "Pressionar CTRL ou u2318 + C para copiar a informação para a área de transferência. Para cancelar, clique nesta mensagem ou pressione ESC.",
                            "createState": "Criar",
                            "removeAllStates": "Remover Todos",
                            "removeState": "Remover",
                            "renameState": "Renomear",
                            "savedStates": "Gravados",
                            "stateRestore": "Estado %d",
                            "updateState": "Atualizar"
                        },
                        "decimal": ",",
                        "infoFiltered": "(filtrado num total de _MAX_ registos)",
                        "infoThousands": ".",
                        "searchBuilder": {
                            "add": "Adicionar condição",
                            "button": {
                                "0": "Construtor de pesquisa",
                                "_": "Construtor de pesquisa (%d)"
                            },
                            "clearAll": "Limpar tudo",
                            "condition": "Condição",
                            "conditions": {
                                "date": {
                                    "after": "Depois",
                                    "before": "Antes",
                                    "between": "Entre",
                                    "empty": "Vazio",
                                    "equals": "Igual",
                                    "not": "Diferente",
                                    "notBetween": "Não está entre",
                                    "notEmpty": "Não está vazio"
                                },
                                "number": {
                                    "between": "Entre",
                                    "empty": "Vazio",
                                    "equals": "Igual",
                                    "gt": "Maior que",
                                    "gte": "Maior ou igual a",
                                    "lt": "Menor que",
                                    "lte": "Menor ou igual a",
                                    "not": "Diferente",
                                    "notBetween": "Não está entre",
                                    "notEmpty": "Não está vazio"
                                },
                                "string": {
                                    "contains": "Contém",
                                    "empty": "Vazio",
                                    "endsWith": "Termina em",
                                    "equals": "Igual",
                                    "not": "Diferente",
                                    "notEmpty": "Não está vazio",
                                    "startsWith": "Começa em",
                                    "notContains": "Não contém",
                                    "notStartsWith": "Não começa com",
                                    "notEndsWith": "Não termina com"
                                },
                                "array": {
                                    "equals": "Igual",
                                    "empty": "Vazio",
                                    "contains": "Contém",
                                    "not": "Diferente",
                                    "notEmpty": "Não está vazio",
                                    "without": "Sem"
                                }
                            },
                            "data": "Dados",
                            "deleteTitle": "Excluir condição de filtragem",
                            "logicAnd": "E",
                            "logicOr": "Ou",
                            "title": {
                                "0": "Construtor de pesquisa",
                                "_": "Construtor de pesquisa (%d)"
                            },
                            "value": "Valor",
                            "leftTitle": "Excluir critério",
                            "rightTitle": "Incluir critério"
                        },
                        "searchPanes": {
                            "clearMessage": "Limpar tudo",
                            "collapse": {
                                "0": "Painéis de pesquisa",
                                "_": "Painéis de pesquisa (%d)"
                            },
                            "count": "{total}",
                            "countFiltered": "{shown} ({total})",
                            "emptyPanes": "Sem painéis de pesquisa",
                            "loadMessage": "A carregar painéis de pesquisa",
                            "title": "Filtros ativos",
                            "showMessage": "Mostrar todos",
                            "collapseMessage": "Ocultar Todos"
                        },
                        "select": {
                            "cells": {
                                "1": "1 célula seleccionada",
                                "_": "%d células seleccionadas"
                            },
                            "columns": {
                                "1": "1 coluna seleccionada",
                                "_": "%d colunas seleccionadas"
                            },
                            "rows": {
                                "1": "%d linha seleccionada",
                                "_": "%d linhas seleccionadas"
                            }
                        },
                        "thousands": ".",
                        "editor": {
                            "close": "Fechar",
                            "create": {
                                "button": "Novo",
                                "title": "Criar novo registro",
                                "submit": "Criar"
                            },
                            "edit": {
                                "button": "Editar",
                                "title": "Editar registro",
                                "submit": "Atualizar"
                            },
                            "remove": {
                                "button": "Remover",
                                "title": "Remover",
                                "submit": "Remover",
                                "confirm": {
                                    "_": "Tem certeza que quer apagar %d entradas?",
                                    "1": "Tem certeza que quer apagar esta entrada?"
                                }
                            },
                            "multi": {
                                "title": "Multiplos valores",
                                "restore": "Desfazer alterações",
                                "info": "Os itens selecionados contêm valores diferentes para esta entrada. Para editar e definir todos os itens nesta entrada com o mesmo valor, clique ou toque aqui, caso contrário, eles manterão os seus valores individuais.",
                                "noMulti": "Este campo pode ser editado individualmente mas não pode ser editado em grupo"
                            },
                            "error": {
                                "system": "Ocorreu um erro no sistema"
                            }
                        },
                        "info": "Mostrando os registos _START_ a _END_ num total de _TOTAL_",
                        "infoEmpty": "Mostrando 0 os registos num total de 0",
                        "datetime": {
                            "previous": "anterior",
                            "next": "próximo",
                            "hours": "horas",
                            "minutes": "minutos",
                            "seconds": "segundos",
                            "unknown": "desconhecido",
                            "amPm": [
                                "am",
                                "pm"
                            ],
                            "weekdays": [
                                "Seg",
                                "Ter",
                                "Qua",
                                "Qui",
                                "Sex",
                                "Sáb",
                                "Dom"
                            ],
                            "months": [
                                "Janeiro",
                                "Fevereiro",
                                "Março",
                                "Abril",
                                "Maio",
                                "Junho",
                                "Julho",
                                "Agosto",
                                "Setembro",
                                "Outubro",
                                "Novembro",
                                "Dezembro"
                            ]
                        },
                        "stateRestore": {
                            "creationModal": {
                                "button": "Criar",
                                "columns": {
                                    "search": "Pesquisa por Colunas",
                                    "visible": "Visibilidade das Colunas"
                                },
                                "name": "Nome:",
                                "order": "Ordenar",
                                "paging": "Paginação",
                                "scroller": "Posição da barra de Scroll",
                                "search": "Pesquisa",
                                "searchBuilder": "Pesquisa Avançada",
                                "select": "Selecionar",
                                "title": "Criar Novo Estado",
                                "toggleLabel": "Incluir:"
                            },
                            "duplicateError": "Já existe um estado com o mesmo nome",
                            "emptyError": "Não pode estar a vazio",
                            "emptyStates": "Não existem estados gravados",
                            "removeConfirm": "Deseja mesmo remover o estado %s?",
                            "removeError": "Erro ao remover o estado.",
                            "removeJoiner": " e ",
                            "removeSubmit": "Apagar",
                            "removeTitle": "Apagar Estado",
                            "renameButton": "Renomear",
                            "renameLabel": "Novo nome para %s:",
                            "renameTitle": "Renomear Estado"
                        }
                    }
                }
            );
        } );
    </script>
  </body>
</html>