<?php include('header.php'); ?>
    <style>
        .btn{padding: 0.6rem 1rem;}
        .p_obra{font-size: 0.9em;text-decoration: none;text-transform: none;color: #3a3b53;padding: 0;margin: 0;}
        .p_cidade{font-size: 0.7em;text-decoration: none;text-transform: none;color: #3a3b53;padding: 0;margin: 0;}
        .p_clientes{font-size: 0.8em;text-decoration: none;text-transform: none;color: #317f7c;padding: 0;margin: 0;}
        a{text-decoration: none;text-transform: none;}
        .checkin-btn{background: green;color: white;padding: 6px 26px;}
        .checkin-feito-btn{background: #a4c0cb;color: white;padding: 6px 26px;}
    </style>
    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
                <h3 class="page-title">
                    Suas Obras
                </h3>
            </div>
            <div class="row">
                
                <?php if(count($obras)<=0){ ?>
                    <p class="card-description"> Nenhuma Obra</code><br></p>
                <?php }else { ?>

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
                        <div class="col-lg-4">
                        <?php if($_SESSION['backend']['permissao'] != 3){?>
                            <a href="<?=base_url()?>admin/rdo/lista_rdo/<?=$row->id?>">
                        <?php } ?>
                                <div class="card">
                                    <div class="card-body" style="text-align: center;cursor:pointer;border: 3px #4ac4bf solid;border-radius: 8px;">
                                        <p class="p_obra"><b><?=$row->obra_nome?></b></p>
                                        <p class="p_cidade">(<?=$row->numero_id?>)</p>
                                        <p class="p_cidade"><?=$row->cidade?> - <?=$row->estado?></p>
                                        <hr style="margin: 6px;color: #adadad;">
                                        <p class="p_clientes"><?=$row->cliente_nome?></p>
                                        <?php 
                                            if(count($checkin) == 0){
                                                echo '<br>';
                                                echo '<a href="'.base_url().'admin/rdo/checkin_funcionario/'.$row->id.'/'.$id_usuario.'"><span class="checkin-btn">CHECKIN</span></a>';
                                                echo '<br>';
                                                echo '<br>';
                                            }else{
                                                echo '<br>';
                                                echo '<span class="checkin-feito-btn">CHECKIN <i class="mdi mdi-checkbox-marked-outline"></i></span>';
                                                echo '<br>';
                                                echo '<br>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </a>
                            <?php if($_SESSION['backend']['permissao'] != 3){
                                echo '</a>';
                            } ?>

                        </div>
                    <?php } ?>

                <?php } ?>
                        
            </div>



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