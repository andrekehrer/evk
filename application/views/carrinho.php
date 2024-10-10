<?php require('header.php'); ?>
<?php require('menu.php'); ?>
  <style>
    .bota0_comprar{background: #2d2e47;padding: 6px 30px;width: 100%;color: white !important;}
    li {font-size: 12px;}
    .wt_btn{background: #25D366;color: white;padding: 20px 40px;width: 300px;cursor:pointer}
    .wt_btn:hover{color: white;}
    .wt_img{width: 30px;margin-top: -7px;margin-left: 10px;}
    @media (min-width: 992px){
      .col-lg-2 {
          flex: 0 0 auto;
          width: 20%;
      }
    }
    .total_cart{width: 100%;padding: 20px 40px;height: 60px;background: #49c4bf21;font-weight: 700;border-top: 1px #d6d6d6 solid;}
    .float_ri{float:right}
    .btn_m_m{padding: 0;transition: .2s all;background: #ffffff;color: #6e6e6e;font-size: 1.5rem;font-weight: 400;height: 2.5rem;width: 2.5rem;border: 1px solid #eeeeee;}
    .btn_m_m:hover{background: #000000;color: #fff;}
    .product-quantity {margin-top: 1rem;width: auto;display: flex;text-align: center;justify-content: center;}
    .middle_field{color: #000;opacity: 1;-webkit-text-fill-color: #000000;background: #ffffff;border: 1px solid #eeeeee;width: 2.5rem;height: 2.5rem;text-align: center;}
    #qtd_cart{background: #4cc5c0;color: white;border-radius: 50%;width: 20px;height: 20px;padding: 1px 7px;margin-top: 7px;margin-left: -1px;float:left}
    .btn_login_carrinho{background: #4CC5C0;padding: 8px 20px;margin-left: 30px;border-radius: 4px;float: right;color: #fff;}
    .btn_login_carrinho{background: #4CC5C0;padding: 8px 20px;margin-left: 30px;border-radius: 4px;float: right;color: #fff;}
    .btn_login_carrinho:hover{color: #fff;background: #2D2E47;}
  </style>
  <!-- ======= Hero Section ======= -->
  <br><br><br><br>

  <main id="main">
    
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>---</h2>
          <p>Carrinho</p>
        </header>

        <div class="row gy-4" style="text-align: center;">

          <div class="col-lg-12">
            <div class="content">
                <?php if(count($coisas_carrinho)>0){ ?>
                    <table style="width:100%">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Nome</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach($coisas_carrinho as $row){ ?>
                        <?php 
                            echo '<tr>';
                                echo '<td>';
                                    if($row->product_id == 1){
                                        echo '<img src="'.base_url().'assets/img/register.png" class="img-fluid" alt="" width="80">';
                                    }
                                    if($row->product_id == 2){
                                        echo '<img src="'.base_url().'assets/img/trace_product.png" class="img-fluid" alt="" width="80">';
                                    }
                                    if($row->product_id == 3){
                                        echo '<img src="'.base_url().'assets/img/vip_250.png" class="img-fluid" alt="" width="80">';
                                    }
                                    if($row->product_id == 4){
                                        echo '<img src="'.base_url().'assets/img/vip_500.png" class="img-fluid" alt="" width="80">';
                                    }
                                    if($row->product_id == 5){
                                        echo '<img src="'.base_url().'assets/img/vip_1000.png" class="img-fluid" alt="" width="80">';
                                    }
                                echo '</td>';
                                echo '<td>';
                                    echo $row->nome;
                                echo '</td>';
                               echo '<td>';
                                    echo 'R$ '.$row->preco;
                                echo '</td>';
                                echo '<td>'; ?>
                                <div class="product-quantity">
                                        <input type="button" class="btn_m_m" value="-" class="qtyminus" onclick="edit_carrinho(this)" data-id="<?=$row->product_id?>"  data-tipo="tirar">
                                        <input type="number" name="updates" class="quantity middle_field" value="<?=$row->qtd?>" min="1" max="672" disabled="" pattern="[0-9]*" data-key="1" >
                                        <input type="button" class="btn_m_m" value="+" class="qtyplus" onclick="edit_carrinho(this)" data-id="<?=$row->product_id?>" data-tipo="adicionar">
                                    </div>
                                <?php 
                                echo '</td>';
                                echo '<td>';
                                    echo 'R$ '.$row->preco_final;
                                echo '</td>';
                            echo '</tr>';
                        ?>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php }else{?>
                    Seu carrinho está vazio.
                <?php }?>
                <br>
                <?php if(count($coisas_carrinho)>0){ ?>
                    <div class="total_cart">
                        <div class="float_ri">Total <span>R$ <?=$total_carrinho?>,00</span></div>
                    </div>
                    <br>
                    <hr>
                    <?php if(!isset($_SESSION['backend']['id'])){?>
					    <a class="btn_login_carrinho" href="customers_carrinho">Faça o Login</a>
                    <?php }else{ ?>
                        <div id="paypal-button-container"></div>
                    <?php } ?>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>

    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>TAG</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/TAG-bootstrap-startup-template/ -->
        Designed by Andre Kehrer</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?=base_url(); ?>assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/aos/aos.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="<?=base_url(); ?>assets/vendor/php-email-form/validate.js"></script>
   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <!-- Template Main JS File -->
  <script src="<?=base_url(); ?>assets/js/main.js"></script>
  <script>
    function edit_carrinho(elem) {
        var site_url = "<?=base_url()?>";
        var id =  $(elem).attr("data-id");
        var tipo =  $(elem).attr("data-tipo");
        $.ajax({
            type: "POST",
            url: site_url + "edit_carrinho",
            data: "id=" + id + "&tipo=" + tipo,
            success: function(resp) {
                var jsonData = JSON.parse(resp);
                location.reload();
            }
        });
    }
</script>
<script src="https://www.paypal.com/sdk/js?client-id=AcszgUwTk0Ik-UkLu8E1_aWS6MVTG-L1ZVNkf3kCEPg0u4WM-dBEVCTuCk5y-9WB18_ASOyNbZICoRfQ&currency=GBP&intent=capture&enable-funding=venmo" data-sdk-integration-source="integrationbuilder"></script>
        <script>
            const paypalButtonsComponent = paypal.Buttons({
                style: {
                    color: "gold",
                    shape: "rect",
                    layout: "vertical"
                },
                createOrder: (data, actions) => {
                    const createOrderPayload = {
                        purchase_units: [
                            {
                                amount: {
                                    value: "<?=$total_carrinho?>"
                                }
                            }
                        ]
                    };

                    return actions.order.create(createOrderPayload);
                },
                onApprove: (data, actions) => {
                    const captureOrderHandler = (details) => {
                            const payerName = details.payer.name.given_name;
                            console.log('Transaction completed');

                            if(details.status == 'COMPLETED'){
                                var site_url = "<?=base_url()?>";
                                $.ajax({
                                    type: "POST",
                                    url: site_url + "salva_compra",
                                    data: "id_transaction=" + details.id,
                                    success: function(resp) {
                                        window.location.replace(site_url+"retorno_pedido");
                                    }
                                });
                            }
                    };
                    return actions.order.capture().then(captureOrderHandler);
                    
                },
                
                onError: (err) => {
                    console.error('An error prevented the buyer from checking out with PayPal');
                }
                
            });
          paypalButtonsComponent
              .render("#paypal-button-container")
              .catch((err) => {
                  console.error('PayPal Buttons failed to render');
              });
        </script>

</body>

</html>