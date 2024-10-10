<?php include('header.php'); ?>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-6 mx-auto">
              <div class="auth-form-light text-center p-5">
                <div class="brand-logo">
                  <img src="<?=base_url(); ?>assets/img/logo.png">
                </div><br><br>
                <h4>Olá, faça seu login!</h4>
                <form class="pt-3">
                  <div class="form-group">
                    <input type="email" name="email" class="form-control form-control-lg" id="email" placeholder="Username">
                  </div>
                  <div class="form-group">
                    <input type="password" name="pass" class="form-control form-control-lg" id="pass" placeholder="Password">
                  </div>
                  <div class="mt-3">
                    <button class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" style="width: 100%;" id="submit">Entrar</button>
                  </div>
                  <div class="my-3 justify-content-between align-items-center">
                    <div style="display: none;margin-top: 20px;" class="alert alert-danger" id="msg_alert" role="alert">
                      E-mail ou senha estão errados!
                    </div>
                    <a href="#" class="auth-link text-black">Esqueceu a senha?</a>
                  </div>

                  <div class="text-center mt-4 font-weight-light"> Não tem conta ainda? <a href="<?php echo base_url().'cadastro'?>" class="text-primary">Cadastre-se</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="<?=base_url(); ?>dash/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/off-canvas.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/hoverable-collapse.js"></script>
    <script src="<?=base_url(); ?>dash/assets/js/misc.js"></script>
    <script>
    $(document).ready(function() {

      $('#submit').click(function() {
        event.preventDefault();
        ajax_call();
      });

      function ajax_call() {
        var email = $('#email').val();
        var pass = $('#pass').val();

        $.ajax({
          type: "POST",
          data: {
            email: email,
            pass: pass
          },
          url: "<?php echo base_url(); ?>Login/log",
          dataType: "JSON",
          beforeSend: function() {
            // Show image container
            $("#loader").show();
          },
          success: function(result) {
            console.log(result.data);
            $.each(result.data, function(i) {
              console.log(result.data[i].logado);
              if (result.data[i].logado === 'sim') {
                window.location.href = "<?php echo base_url() ?>";
              } else {
                $('#msg_alert').css('display', 'block');
              }
            })
          },
          complete: function(data) {
            // Hide image container
            $("#loader").hide();
          }
        });
      }
    });
  </script>
  </body>
</html>