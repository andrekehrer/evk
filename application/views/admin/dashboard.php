<?php include('header.php'); ?>
    <style>
      .mb-5 {margin-bottom: 0.5rem !important;}
      p {margin-bottom: 0rem !important}
      .row_border{border: 1px #cbcbcb solid;padding: 20px 10px 10px 10px;margin-bottom: 10px;border: 1px #4ac5bf solid;border-radius: 7px;background: #e9e7e7;}
    </style>
    <div class="container-scroller">
        <?php include('nav.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('menu.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                    <h3 class="page-title">
                        <span class="page-title-icon bg-gradient-primary2 text-white me-2">
                        <i class="mdi mdi-home"></i>
                        </span> Início
                    </h3>
                    <nav aria-label="breadcrumb">
                        <ul class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">
                            <!-- <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> -->
                        </li>
                        </ul>
                    </nav>
                </div>
                <?php 
                if($_SESSION['backend']['permissao'] == 2 or $_SESSION['backend']['permissao'] == 3){
                    if(isset($frase)){
                    ?>
                    <div class="row"style="margin:10px">
                        <div class="row_border" >
                            <div class="row">
                                <div class="col-lg-12" >
                                    <div class="form-group">
                                        <?=htmlspecialchars($frase)?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                <?php } } ?>
                <?php 
                if($_SESSION['backend']['permissao'] == 1 || $_SESSION['backend']['permissao'] == 99){
                    if(isset($frase)){
                    ?>
                    <div class="row">
                        <form class="forms-sample" action="dashboard/editar_frase" method="POST">
                            <div class="row_border">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <br>
                                            <label for="frase">Frase Motivacional</label>
                                            <textarea class="form-control" style="width:100%; height:80px;" cols="42" rows="5" name="frase">
                                            <?=htmlspecialchars($frase)?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2 mt-2">Salvar</button>
                            </div>
                        </form>
                    </div>   
                <?php } } ?>
                <?php if($_SESSION['trocar_senha'] == 1 ){?>
                    <div class="row">
                        <form class="forms-sample">
                            <div class="row_border">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <i class="mdi mdi-alert" style="color: #f2830f;font-size: 40px;"></i>
                                            <br>
                                            <label for="frase"><b>Sua senha é 123.<br>Por favor alterar a senha:</b></label>
                                            <input class="form-control" type="password" id="senha" placeholder="Nova Senha">
                                            <br>
                                            <input class="form-control" type="password" id="confirmar_senha" placeholder="Repetir Nova Senha">
                                        </div>
                                    </div>
                                </div>
                                <p id="msg_alert" style="font-size: 13px;color: red;font-weight: 600;display:none">As senhas não estão iguais!</p>
                                <button type="submit" id="submit" class="btn btn-gradient-primary me-2 mt-2">Alterar senha</button>
                            </div>
                        </form>
                    </div>   
                <?php } ?>    
            </div>
          <?php include('footer.php'); ?>
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

  </body>
  <script>
    $(document).ready(function() {

        $('#submit').click(function(event) {
            event.preventDefault();
            ajax_call();
        });

        function ajax_call() {
            var senha = $('#senha').val();
            var confirmar_senha = $('#confirmar_senha').val();

            $('#msg_alert').css('display', 'none');
            if(senha == confirmar_senha){
                $.ajax({
                    type: "POST",
                    data: {
                        senha: senha
                    },
                    url: "<?php echo base_url(); ?>admin/Login/save_new_pass",
                    dataType: "JSON",
                    beforeSend: function() {
                        // Show image container
                        $("#loader").show();
                    },
                    success: function(result) {
                        location.reload();
                    },
                    complete: function(data) {
                    }
                });
            }else{
                $('#msg_alert').css('display', 'block');
            }
        }
    });
  </script>
</html>