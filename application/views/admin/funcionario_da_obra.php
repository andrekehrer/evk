<?php include('header.php'); ?>
<style>.bg-gradient-info {
        background: -webkit-gradient(linear, left top, right top, from(#90caf9), color-stop(99%, #047edf)) !important;
        background: linear-gradient(to right, #4bc3be, #2d2f47 99%) !important;}
    .card_color_hover:hover{background: linear-gradient(to right, #4bc3be78, #2d2f47de 99%) !important;}        
    .card_color_hover{cursor: pointer;}    
    .btn_voltar{color: inherit;display: inline-block;font-size: 1.5rem;line-height: 1;vertical-align: middle;text-decoration: none;margin-top: 20px;}    
    .btn_voltar:hover{color:#2d2f4785}    
    .form-control {padding: 0.6rem 0.375rem !important}
    .btn {width: 100%;}
    .row_border{border: 1px #cbcbcb solid;padding: 20px 10px 0px 10px;margin-bottom: 10px;}
    .font-2rem{font-size: 2.125rem !important;}
    #foto_funcionario{width: 150px;height: 150px;border-radius: 50%;margin-bottom: 20px;border: 3px #4ac5bf solid;}
</style>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header" style="margin: 0px !important">
                    <p style="margin-bottom: 0px !important">Adicionar itens da Obra (<?=$obra[0]->numero_id?>) </p>
                </div>
                <div class="page-header">
                    <h2 class="page-title font-2rem">obras
                        <?=$obra[0]->nome?>
                    </h2>
                </div>
                <form class="forms-sample" action="<?=base_url()?>admin/obras/insere_funcionario_da_obra_gravar" method="POST">
                
                    <input type="hidden" class="form-control" id="id_obra" name="id_obra" placeholder="" value="<?=$obra[0]->id?>">
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="nome">Selecione o Funcionário</label>
                                    <select class="form-control" name="id_funcionario" id="funcionario">
                                        <option value="0">Selecione</option>
                                        <?php foreach($lista_funcionarios as $funcionario){
                                            if($funcionario->status == 1){?>
                                                <option value="<?= $funcionario->id ?>"><?= $funcionario->nome.' '.$funcionario->sobrenome ?></option>
                                            <?php }?>
                                        <?php }?>
                                    </select>  
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                <button type="submit" class="btn btn-gradient-primary me-2 mt-2">Adicionar</button>   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>

                <div class="row_border">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr style="height: 70px;">
                                        <th colspan="6" style="text-align: center;"><b>LISTA DE FUNCIONARIOS DESTA OBRA</b></th>
                                    </tr>
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Cargo</th>
                                        <th scope="col">Email</th>
                                        <th scope="col"><i class="mdi mdi-delete mdi-24px"></i></th>
                                    </tr>
                                </thead>
                                <?php foreach ($funcionarios as $funcionario){ ?>
                                <tr>
                                    <td><?=$funcionario->nome.' '.$funcionario->sobrenome?></td>                                            
                                    <td>
                                        <?= $funcionario->cargo == 0 ? 'Selecione' : ''?>
                                        <?= $funcionario->cargo == 1 ? 'Gestor' : ''?>
                                        <?= $funcionario->cargo == 2 ? 'Auxiliar de Escritório' : ''?>
                                        <?= $funcionario->cargo == 3 ? 'Coordenador Técnico' : ''?>
                                        <?= $funcionario->cargo == 4 ? 'Coordenador(a) Administrativo' : ''?>
                                        <?= $funcionario->cargo == 5 ? 'Estagiario (a)' : ''?>
                                        <?= $funcionario->cargo == 6 ? 'Gerente de Obra' : ''?>
                                        <?= $funcionario->cargo == 7 ? 'Gerente de Projetos e Serviços de Manutenção' : ''?>
                                        <?= $funcionario->cargo == 8 ? 'Meio Oficial de Pedreiro' : ''?>
                                        <?= $funcionario->cargo == 9 ? 'Mestre' : ''?>
                                        <?= $funcionario->cargo == 10 ? 'Operador de Máquina Perfuratriz' : ''?>
                                        <?= $funcionario->cargo == 11 ? 'Operador de Máquinas de Construção Civil' : ''?>
                                        <?= $funcionario->cargo == 12 ? 'Pedreiro' : ''?>
                                        <?= $funcionario->cargo == 13 ? 'Soldado' : ''?>
                                        <?= $funcionario->cargo == 14 ? 'Técnico(a) em Segurança do Trabalho' : ''?>
                                    </td>
                                    <td><?=$funcionario->email?></td>
                                    <td><i class="mdi mdi-close-circle-outline mdi-24px" onclick="altera_status(this)" data-id="<?=$funcionario->id?>" style="color:red;cursor: pointer;"></i></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                    <br>
                </div>

                <a href="<?=base_url()?>admin/obras/edit_obra/<?=$obra[0]->id?>" class="btn_voltar"><i class="mdi mdi-keyboard-return"></i> Voltar para a Obra</a>
            </div>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php require('form_add_bag.php'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="edit_mala" tabindex="-1" role="dialog" aria-labelledby="edit_malaLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php require('form_edit_bag.php'); ?>
                        </div>
                    </div>
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

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        function altera_status(elem) {
            var site_url = "<?=base_url()?>";
            var id       =  $(elem).attr("data-id");
            var id_obra  =  <?=$obra[0]->id?>;

            $.ajax({
                type: "POST",
                url: site_url + "admin/obras/excluir_funcionario_da_obra",
                data: {id: id, id_obra:id_obra},
                success: function(resp) {
                    console.log('deu');
                    location.reload();
                }
            });
        }
    </script>
    </body>
</html>