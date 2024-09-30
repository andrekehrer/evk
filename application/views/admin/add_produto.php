<?php include('header.php'); ?>
<style>.bg-gradient-info {
        background: -webkit-gradient(linear, left top, right top, from(#90caf9), color-stop(99%, #047edf)) !important;
        background: linear-gradient(to right, #4bc3be, #2d2f47 99%) !important;}
    .card_color_hover:hover{background: linear-gradient(to right, #4bc3be78, #2d2f47de 99%) !important;}        
    .card_color_hover{cursor: pointer;}    
    .btn_voltar{color: inherit;display: inline-block;font-size: 0.875rem;line-height: 1;vertical-align: middle;text-decoration: none;margin-top: 20px;}    
    .btn_voltar:hover{color:#2d2f4785}    
    .form-control {padding: 0.6rem 0.375rem !important}
    .btn {width: 100%;}
    .row_border{border: 1px #cbcbcb solid;padding: 20px 10px 0px 10px;margin-bottom: 10px;}
    .panel {}
    .button_outer {background: #83ccd3; border-radius:30px; text-align: center; height: 30px; width: 160px; display: inline-block; transition: .2s; position: relative; overflow: hidden;}
    .btn_upload {padding: 7px 20px 12px; color: #fff; text-align: center; position: relative; display: inline-block; overflow: hidden; z-index: 3; white-space: nowrap;}
    .btn_upload input {position: absolute; width: 100%; left: 0; top: 0; width: 100%; height: 105%; cursor: pointer; opacity: 0;}
    .file_uploading {width: 100%; height: 10px; margin-top: 20px; background: #ccc;}
    .file_uploading .btn_upload {display: none;}
    .processing_bar {position: absolute; left: 0; top: 0; width: 0; height: 100%; border-radius: 30px; background:#83ccd3; transition: 3s;}
    .file_uploading .processing_bar {width: 100%;}
    .success_box {display: none;width: 40px;height: 10px;position: relative;}
    .success_box:before {content: '';display: block;width: 11px;height: 20px;border-bottom: 6px solid #fff;border-right: 6px solid #fff;-webkit-transform: rotate(45deg);-moz-transform: rotate(45deg);-ms-transform: rotate(45deg);transform: rotate(45deg);position: absolute;left: 15px;top: 10px;}
    .file_uploaded .success_box {display: inline-block;}
    .file_uploaded {margin-top: 0; width: 50px; background:#83ccd3; height: 50px;}
    .uploaded_file_view {max-width: 150px;margin: 15px auto;text-align: center;position: relative;transition: .2s;opacity: 0;;padding: 15px;}
    .file_remove{width: 30px; height: 30px; border-radius: 50%; display: block; position: absolute; background: #aaa; line-height: 30px; color: #fff; font-size: 12px; cursor: pointer; right: -15px; top: -15px;}
    .file_remove:hover {background: #222; transition: .2s;}
    .uploaded_file_view img {max-width: 100%;}
    .uploaded_file_view.show {opacity: 1;}
    .error_msg {text-align: center; color: #f00}
    select.form-control {color: #5a5a5a !important;}
    input[type=checkbox]{height: 0;width: 0;visibility: hidden;}
    #gooey {border-radius: 50px;cursor: pointer;text-indent: -9999px;width: 50px;height: 25px;display: block;position: relative;/* filter: url('#gooey'); */background: #FF4651;box-shadow: 0 8px 16px -1px rgba(255, 70, 81, 0.2);transition: .3s ease-in-out;transition-delay: .2s;}
    input:checked+#gooey:after {background:#fff;animation:expand-right .5s linear forwards;/* left: calc(100% - 5px); *//* transform: translateX(-100%); */}
    #gooey:after {content: '';position: absolute;top: 2px;left: 2px;width: 21px;height: 21px;background: #fff;border-radius: 21px;/* transition: 0.3s; */animation:expand-left .5s linear forwards;}
    input:checked+#gooey {background: #4ac4bf;box-shadow: 0 2px 5px -1px rgb(74 196 191 / 57%);}
    input:checked+#gooey:after {background:#fff;animation:expand-right .5s linear forwards;}
    @-webkit-keyframes expand-right
    {
        0%
        {
            left:2px;
            /* background:white; */
        }
        30%,50%    /* 50% 80% */
        {
            left:2px;
            width:46px;
            
        }
        
        60%
        {
            left:34px;
            width:14px;
        }
        80%
        {
            left:24px;
            width:24px;   
        }
        90%
        {
            left:29px;
            width:19px;  
        }
        100%
        {
            left:27px;
            width:21px;
        }
    }
    @keyframes expand-right
    {
        0%
        {
            left:2px;
            /* background:white; */
        }
        30%,50%    /* 50% 80% */
        {
            left:2px;
            width:46px;
            
        }
        
        60%
        {
            left:34px;
            width:14px;
        }
        80%
        {
            left:24px;
            width:24px;   
        }
        90%
        {
            left:29px;
            width:19px;  
        }
        100%
        {
            left:27px;
            width:21px;
        }
    }

    @-webkit-keyframes expand-left
    {
        0%
        {
            left:27px;
            /* background:white; */
        }
        30%,50%
        {
            left:2px;
            width:46px;
        }
        60%
        {
            right:34px;
            width:14px;
        }
        80%
        {
            right:24px;
            width:24px;   
        }
        90%
        {
            right:29px;
            width:19px;  
        }
        100%
        {
            left:2px;
            width:21px;
        }
    }
    @keyframes expand-left
    {
        0%
        {
            left:27px;
            /* background:white; */
        }
        30%,50%
        {
            left:2px;
            width:46px;
        }
        60%
        {
            right:34px;
            width:14px;
        }
        80%
        {
            right:24px;
            width:24px;   
        }
        90%
        {
            right:29px;
            width:19px;  
        }
        100%
        {
            left:2px;
            width:21px;
        }
    }
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
                        Novo Produto
                    </h3>
                </div>
                <form id="myform" class="forms-sample" action="<?=base_url()?>admin/produtos/add_produto_gravar" method="POST">
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-2">
                                <div class="form-group">
                                    <label for="nome">Status</label><br>
                                    <!-- <input class="form-check-input" type="checkbox" role="switch" name="status" id="status"> -->
                                    <div class="switch" style="margin-top: -14px;">
                                        <input type="checkbox" name="status" id="gooey-switch"/>
                                        <label id="gooey" for="gooey-switch">On/Off</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10">
                                <div class="form-group">
                                    <label for="nome">Nome</label>
                                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" value="" required>        
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row_border">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="fabricante">Fabricante</label>
                                    <select class="form-control" name="fabricante" id="fabricante">
                                        <option value="0">Selecione</option>
                                    <?php 
                                        $fabricantes = $this->db->get('fabricantes')->result();
                                        foreach($fabricantes as $each){
                                            echo '<option value="'.$each->id.'">'.$each->nome.'</option>';
                                        }
                                    ?>
                                    </select>      
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="unidade">Unidade de Medida</label>      
                                    <select class="form-control" name="unidade" id="unidade">
                                        <option value="0">Selecione</option>
                                        <option value="1">Litros</option>
                                        <option value="2">Kg</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submit" class="btn btn-gradient-primary me-2 mt-2">Salvar</button>
                </form>

                <a href="<?=base_url()?>admin/produtos" class="btn_voltar"><i class="mdi mdi-keyboard-return"></i> Voltar</a>
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
        $('#submit').click(function(event){
            data = $('#password').val();
            var len = data.length;
            if(len < 3) {
                alert("Senha tem que ter mais de 5 digitos");
                event.preventDefault();
            }
            if($('#password_again').val() != $('#password').val()) {
                alert("Senha de confirmacao nao sao iguais");
                event.preventDefault();
            }
        });
     
        var btnUpload = $("#upload_file"),
		btnOuter = $(".button_outer");
	btnUpload.on("change", function(e){
		var ext = btnUpload.val().split('.').pop().toLowerCase();
		if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
			$(".error_msg").text("Not an Image...");
		} else {
			$(".error_msg").text("");
			btnOuter.addClass("file_uploading");
			setTimeout(function(){
				btnOuter.addClass("file_uploaded");
			},3000);
			var uploadedFile = URL.createObjectURL(e.target.files[0]);
			setTimeout(function(){
				$("#uploaded_view").append('<img src="'+uploadedFile+'" />').addClass("show");
				$("#foto_produto").css('display', 'none');
                
			},3500);
		}
	});
	$(".file_remove").on("click", function(e){
		$("#uploaded_view").removeClass("show");
		$("#uploaded_view").find("img").remove();
		btnOuter.removeClass("file_uploading");
		btnOuter.removeClass("file_uploaded");
	});


    </script>
    </body>
</html>