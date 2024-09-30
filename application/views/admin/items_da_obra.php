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
                <form class="forms-sample" action="<?=base_url()?>admin/obras/insere_item_obra_gravar" method="POST">
                
                    <input type="hidden" class="form-control" id="id_obra" name="id_obra" placeholder="" value="<?=$obra[0]->id?>">
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" required>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="categoria">Categoria</label>
                                    <select class="form-control" name="categoria" id="categoria">
                                        <option value="0">Selecione</option>
                                        <option value="1">Serviço</option>
                                        <option value="2">Transporte</option>
                                        <option value="3">Material</option>
                                    </select> 
                                </div>
                            </div>
                        </div>    
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="qtd">QTD</label>
                                    <input type="text" class="form-control" id="qtd" name="qtd" placeholder="qtd" required>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="unidade">Unidade</label>
                                    <select class="form-control" name="unidade" id="unidade" required>
                                        <option value="0">Selecione</option>
                                        <option value="1">Travessia</option>
                                        <option value="2">Unidade</option>
                                        <option value="3">Verba</option>
                                        <option value="4">Metro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="valor">Valor</label>
                                    <input type="text" class="form-control" id="valor" name="valor" placeholder="valor">     
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label for="valor_com_imposto">Valor com imposto</label>
                                    <input type="text" class="form-control" id="valor_com_imposto" name="valor_com_imposto" placeholder="Valor com imposto">     
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
                                <?php if(count($itens1) > 0){ ?>
                                    <thead>
                                        <tr style="height: 70px;">
                                            <th colspan="6" style="text-align: center;"><b>SERVIÇOS</b></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Unidade</th>
                                            <th scope="col">Qtd</th>
                                            <th scope="col">valor</th>
                                            <th scope="col">valor com imposto</th>
                                            <th scope="col"><i class="mdi mdi-delete mdi-24px"></i></th>
                                        </tr>
                                    </thead>
                                    <?php foreach($itens1 as $item1){ ?>
                                        <tr>
                                            <td><?=$item1->nome?></td>                                            
                                            <td>
                                                <?=$item1->unidade == 1 ? 'Travessia' : ''?>
                                                <?=$item1->unidade == 2 ? 'Unidade' : ''?>
                                                <?=$item1->unidade == 3 ? 'Verba' : ''?>
                                                <?=$item1->unidade == 4 ? 'Metro' : ''?>
                                            </td>
                                            <td><?=$item1->qtd?></td>
                                            <td><?=$item1->valor?></td>
                                            <td><?=$item1->valor_com_imposto?></td>
                                            <td><i class="mdi mdi-close-circle-outline mdi-24px" onclick="altera_status(this)" data-id="<?=$item1->id?>" style="color:red;cursor: pointer;"></i></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(count($itens2) > 0){ ?>
                                    <thead>
                                        <tr style="height: 70px;">
                                            <th colspan="6" style="text-align: center;"><b>TRANSPORTE</b></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Unidade</th>
                                            <th scope="col">Qtd</th>
                                            <th scope="col">valor</th>
                                            <th scope="col">valor com imposto</th>
                                            <th scope="col"><i class="mdi mdi-delete mdi-24px"></i></th>
                                        </tr>
                                    </thead>
                                    <?php foreach($itens2 as $item2){ ?>
                                        <tr>
                                            <td><?=$item2->nome?></td>                                            
                                            <td>
                                                <?=$item2->unidade == 1 ? 'Travessia' : ''?>
                                                <?=$item2->unidade == 2 ? 'Unidade' : ''?>
                                                <?=$item2->unidade == 3 ? 'Verba' : ''?>
                                                <?=$item2->unidade == 4 ? 'Metro' : ''?>
                                            </td>
                                            <td><?=$item2->qtd?></td>
                                            <td><?=$item2->valor?></td>
                                            <td><?=$item2->valor_com_imposto?></td>
                                            <td><i class="mdi mdi-close-circle-outline mdi-24px" onclick="altera_status(this)" data-id="<?=$item2->id?>" style="color:red;cursor: pointer;"></i></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                                <?php if(count($itens3) > 0){ ?>
                                    <thead>
                                        <tr style="height: 70px;">
                                            <th colspan="6" style="text-align: center;"><b>MATERIAL</b></th>
                                        </tr>
                                        <tr>
                                            <th scope="col">Nome</th>
                                            <th scope="col">Unidade</th>
                                            <th scope="col">Qtd</th>
                                            <th scope="col">valor</th>
                                            <th scope="col">valor com imposto</th>
                                            <th scope="col"><i class="mdi mdi-delete mdi-24px"></i></th>
                                        </tr>
                                    </thead>
                                    <?php foreach($itens3 as $item3){ ?>
                                        <tr>
                                            <td><?=$item3->nome?></td>                                            
                                            <td>
                                                <?=$item3->unidade == 1 ? 'Travessia' : ''?>
                                                <?=$item3->unidade == 2 ? 'Unidade' : ''?>
                                                <?=$item3->unidade == 3 ? 'Verba' : ''?>
                                                <?=$item3->unidade == 4 ? 'Metro' : ''?>
                                            </td>
                                            <td><?=$item3->qtd?></td>
                                            <td><?=$item3->valor?></td>
                                            <td><?=$item3->valor_com_imposto?></td>
                                            <td><i class="mdi mdi-close-circle-outline mdi-24px" onclick="altera_status(this)" data-id="<?=$item3->id?>" style="color:red;cursor: pointer;"></i></td>
                                        </tr>
                                    <?php } ?>
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

            $.ajax({
                type: "POST",
                url: site_url + "admin/obras/excluir_item_da_obra",
                data: {id: id},
                success: function(resp) {
                    console.log('deu');
                    location.reload();
                }
            });
        }
    </script>
    </body>
</html>