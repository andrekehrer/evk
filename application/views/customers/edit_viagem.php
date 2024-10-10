<?php include('header.php'); ?>
<style>.bg-gradient-info {
        background: -webkit-gradient(linear, left top, right top, from(#90caf9), color-stop(99%, #047edf)) !important;
        background: linear-gradient(to right, #4bc3be, #2d2f47 99%) !important;}
    .card_color_hover:hover{background: linear-gradient(to right, #4bc3be78, #2d2f47de 99%) !important;}        
    .card_color_hover{cursor: pointer;}    
    .btn_voltar{color: inherit;display: inline-block;font-size: 0.875rem;line-height: 1;vertical-align: middle;text-decoration: none;margin-top: 20px;}    
    .btn_voltar:hover{color:#2d2f4785}    
</style>
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <div class="container-scroller">
      <?php include('nav.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php include('menu.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary2 text-white me-2">
                        <i class="mdi mdi-airplane-takeoff"></i>
                        </span> <?=$viagem[0]->origem?>
                        <span class="page-title-icon bg-gradient-primary2 text-white me-2">
                        <i class="mdi mdi-airplane-landing"></i>
                        </span> <?=$viagem[0]->destino?>
                    </h3>
                <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page">
                        <!-- <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                    </li>
                    </ul>
                </nav>
                </div>
                <div class="row">
                    <div class="col-lg-12 stretch-card">
                        <div class="card">
                            <div class="card-body" style="padding: 0px;">
                                <div id="accordion">
                                    <div class="card">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="mb-0">
                                                <button class="btn" style="padding-left: 0px;" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                Detalhes da sua viagem
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body" style="padding: 1.5rem 1.5rem;">
                                                <form class="forms-sample" action="<?=base_url()?>customers/edit_viagem_gravar" method="POST">
                                                    <div class="form-group">
                                                        <label for="origem">Origem</label>
                                                        <input type="text" class="form-control" id="origem" name="origem" placeholder="Origem" value="<?=$viagem[0]->origem?>">
                                                        <input type="hidden" class="form-control" id="id" name="id" placeholder="" value="<?=$viagem[0]->id?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="destino">Destino</label>
                                                        <input type="text" class="form-control" id="destino" name="destino" placeholder="Destino" value="<?=$viagem[0]->destino?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="data">Data</label>
                                                        <input type="date" class="form-control" id="data" name="data" value="<?=date('Y-m-d', $viagem[0]->data)?>">
                                                    </div>
                                                    <button type="submit" class="btn btn-gradient-primary me-2">Salvar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="mb-0">
                                                <button class="btn collapsed" style="padding-left: 0px;" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                Bagagens
                                                </button>
                                            </h5>
                                        </div>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                            <div class="card-body" style="padding: 1.5rem 1.5rem;">
                                                <a type="button" href="#" data-toggle="modal" data-target="#exampleModal" class="btn btn-gradient-info btn-icon-text" style="padding: 6px 15px;background: white;color: #2d2f47;border: 2px #2d2f47 solid;font-size: 12px;">
                                                    <i class="mdi mdi-plus-box btn-icon-prepend"></i> Adicionar nova mala 
                                                </a><br><br>
                                                <div class="row">
                                                    <?php foreach($malas as $mala){ ?>
                                                        <div class="col-md-4 stretch-card grid-margin" onclick="edit_mala(this)" data-id="<?=$mala->id?>">
                                                            <div class="card bg-gradient-info card-img-holder text-white card_color_hover">
                                                                <div class="card-body" style="padding: 1.5rem 1.5rem;text-align: center;">
                                                                    <img src="<?=base_url()?>dash/assets/images/mala.png" width="20" style="margin-bottom:5px">
                                                                    <h4 class="mb-5" style="margin-bottom: 1rem !important;"><?=$mala->marca_mala?></h4>
                                                                    <h6 class="card-text">R$ <?=$mala->valor_mala?>,00</h6>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="btn_voltar"><i class="mdi mdi-keyboard-return"></i> Voltar</a>
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

        function edit_mala(elem) {
            var site_url = "<?=base_url()?>";
            var viagem_id = "<?=$id_viagem?>";
            var id =  $(elem).attr("data-id");
            $.ajax({
                type: "POST",
                url: site_url + "customers/edit_bag",
                data: "id_mala=" + id,
                success: function(resp) {
                    var jsonData = JSON.parse(resp);
                    var img_fechada = site_url+'assets/malas/'+jsonData.foto_mala_fechada;
                    var foto_fiscal = site_url+'assets/malas/'+jsonData.foto_fiscal;
                    var foto_mala_pronta = site_url+'assets/malas/'+jsonData.foto_mala_pronta;

                    $('#edit_marca_mala').val(jsonData.marca_mala);
                    $('#conteudo_mala').val(jsonData.conteudo_mala);
                    $('#cor_mala').val(jsonData.cor_mala);
                    $('#peso_mala').val(jsonData.peso_mala);
                    $('#valor_mala').val(jsonData.valor_mala);
                    $('#id_mala').val(jsonData.id);

                    $("#tipo_mala option[value="+jsonData.tipo_mala+"]").prop('selected', true);
                    $("#estilo_mala option[value="+jsonData.estilo_mala+"]").prop('selected', true);
                    $("#tamanho_mala option[value="+jsonData.tamanho_mala+"]").prop('selected', true);

                    $("#imagem_fechada").attr("src",img_fechada);
                    $("#foto_mala_pronta").attr("src",foto_mala_pronta);
                    $("#foto_fiscal").attr("src",foto_fiscal);

                    $("#link_gerar_pdf").attr("href",site_url+'customers/gerar_pdf/'+viagem_id+'/'+jsonData.id);


                    // $('#edit_marca_mala').val(jsonData.marca_mala);
                    // $('#edit_marca_mala').val(jsonData.marca_mala);

                    console.log(jsonData);
                    // if (resp == 'Your class has been booked successfully.') {
                    //     jQuery(".booking_message").html($('.class_name_head').html()+' | '+$('.class_time').html()+' | '+formatted_date);
                    //     jQuery(".booking_message").css("color", "white");
                    //     jQuery("#booking_message_modal").modal('show');
                    //     jQuery(".booking_message").show();
                    // } else {
                    //     jQuery(".booking_message_error").html(resp);
                    //     jQuery(".booking_message_error").show();
                    //     jQuery("#waitlist_message_modal").modal('show');
                    // }
                    // jQuery('html, body').animate({
                    //     // scrollTop: jQuery(".timetable_wrapper").offset().top
                    // }, 2000);
                }
            });
            $('#edit_mala').modal('show');

        }
        // $('#mala').on('click', function() {
        //     var id =  $(this).attr("data-id");
        //     alert(id);
        
        // });   

        $('#conteudo').on('input', function() {
            var conteudo = $('#conteudo').val();
            const Array1 = conteudo.split(";");
            var total = 0;
            $.each(Array1, function(key, value) {
                const Array2 = value.split("=");
                $.each(Array2, function(key, value) {
                    if(key == 1){
                        total = total + parseInt(value.trim());
                        console.log(total);
                        if(!isNaN(total)){
                            $('#valor_total_da_bagagem').val(total);
                        }
                    }
                });
            });
            // console.log(conteudo);
        });
        $('#conteudo_mala').on('input', function() {
            var conteudo = $('#conteudo_mala').val();
            const Array1 = conteudo.split(";");
            var total = 0;
            $.each(Array1, function(key, value) {
                const Array2 = value.split("=");
                $.each(Array2, function(key, value) {
                    if(key == 1){
                        total = total + parseInt(value.trim());
                        console.log(total);
                        if(!isNaN(total)){
                            $('#valor_mala').val(total);
                        }
                    }
                });
            });
            // console.log(conteudo);
        });
    </script>
    </body>
</html>