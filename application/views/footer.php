<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright">
            &copy; Copyright <strong><span>EVK</span></strong>. All Rights Reserved
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

    <!-- Template Main JS File -->
    <script src="<?=base_url(); ?>assets/js/main.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-file-upload/4.0.11/jquery.uploadfile.min.js" integrity="sha512-uwNlWrX8+f31dKuSezJIHdwlROJWNkP6URRf+FSWkxSgrGRuiAreWzJLA2IpyRH9lN2H67IP5H4CxBcAshYGNw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-file-upload/4.0.11/uploadfile.min.css" integrity="sha512-MudWpfaBG6v3qaF+T8kMjKJ1Qg8ZMzoPsT5yWujVfvIgYo2xgT1CvZq+r3Ks2kiUKcpo6/EUMyIUhb3ay9lG7A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <script>
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
    </script>
</body>

</html>