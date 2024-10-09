<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Obras</title>

    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/cards/card-1/assets/css/card-1.css">
    <style>
        .users{font-size: 8px !important;margin-top: 0  !important;margin-bottom: 0rem  !important;}
        @media (min-width: 1400px) {
            .col-xxl-7 {
                flex: 0 0 auto;
                width: 100% !important;
            }
        }
        .col-xxl-7 {
            flex: 0 0 auto;
            width: 100% !important;
        }
        .limpo{background-image: linear-gradient(#70add9, #d1e0eb);}
        .nublado{background-image: linear-gradient(#a2a2a2, #dcdcdc);}

        .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {max-width: 95% !important;}
        .h5, h5 {font-size: 1rem !important;}
        .h4, h4 {font-size: 0.8rem !important;}
        .card-title {margin-bottom: 0px !important;}
        .progress-bar {background-color: #3d7940 !important;}
        .progress, .progress-stacked {--bs-progress-bg: #ffffff !important;}
        hr {margin: 0.3rem 0 !important;}
        .pefura{border: 1px yellow solid;margin: 3px;padding: 2px;background: #e9e981;}
        .carro{border: 1px #365273 solid;margin: 3px;padding: 2px;background: #7553bb;color: white;}

        .hoje{background: #2b3d48;padding: 11px !important;text-align: center;color:white}
        .ontem{background: #ffcc00;padding: 11px !important;text-align: center;}

        .data_real_hoje{background: #387da7;width: 110px;padding: 5px 9px;color: white;border-radius: 4px;}
        .data_real_ontem{background: #a73838;width: 110px;padding: 5px 9px;color:white;border-radius: 4px;}
        .card {border-radius: 0px !important;border: none;}
    </style>
</head>
<body>
<input type="text" class="hidden" name="txtlatitude" value="">
<input type="text" class="hidden" name="txtlongitude" value="">
        <!-- Card 1 - Bootstrap Brain Component -->
<section class="py-3 py-md-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10 col-xl-8 col-xxl-7">
                
                <div class="row gy-4">
                    <?php foreach($obras as $obra){
                        if($obra['icone'] == '01d' || $obra['icone'] == '01n'){
                            $ceu = 'limpo';
                        }else{
                            $ceu = 'nublado';
                        }
                        if($obra['hoje'] == 1){
                            $real_time = 'hoje';
                            $data_real = 'data_real_hoje';
                        }else{
                            $real_time = 'ontem';
                            $data_real = 'data_real_ontem';
                        }
                        
                        ?>
                        <div class="col-12 col-sm-4">
                            <div class="card widget-card shadow-sm <?=$real_time?>">
                                <div class="card-body" style="padding:0px !important">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="card-title widget-card-title"><?=$obra['obra']?></h5>
                                            <h4 class="card-subtitle m-0"><?=$obra['cidade']?></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card widget-card shadow-sm <?=$ceu?>">
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-10">
                                            <h4 class="<?=$data_real?>"style="margin-top:5px"> <i class="bi bi-calendar-date"> </i><?=' '.$obra['data_criacao']?></h4>
                                            <h4 class="mb-3"style="margin-top:5px"><i class="bi bi-clock"> </i> 
                                            <?php  if($obra['h_inicio'] != ''){echo $obra['h_inicio'];}else{echo '--:--';} ?>
                                            </h4>
                                            <i class="bi bi-person"></i>
                                            <p class="users">
                                                <?php foreach($obra['funcionario'] as $key => $func){ 
                                                    if($key == 0 ){
                                                        echo $func['nome'];
                                                    }else{
                                                        echo ', '.$func['nome'];
                                                    }
                                                }?>  
                                            </p>  
                                            <hr>
                                            <i class="bi bi-car-front-fill"></i>
                                            <p class="users">
                                                <?php foreach($obra['veiculos'] as $key => $veic){ 
                                                    if($veic['perfuratriz'] == 1){
                                                        $per = 'pefura';
                                                    }else{
                                                        $per = 'carro';
                                                    }
                                                    echo '<span class="'.$per.'">'.$veic['nome'].'</span>';
                                                }?>  
                                            </p>  
                                        </div>
                                        <div class="col-2">
                                            <div class="d-flex justify-content-end">
                                                <!-- <div class="lh-1 text-white bg-info rounded-circle p-3 d-flex align-items-center justify-content-center"> -->
                                                <div class="lh-1 text-white rounded-circle d-flex align-items-center justify-content-center">
                                                    <img src="http://openweathermap.org/img/wn/<?=$obra['icone']?>.png" alt="">
                                                </div>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <span><?php
                                                    $temp = explode(".",$obra['temperatura']);
                                                    echo $temp[0].'&deg;C';
                                                ?></span>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <i class="bi bi-wind"></i></i> <?=$obra['vento']?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex align-items-center mt-3">
                                                <span class="lh-1 me-3 bg-danger-subtle text-danger rounded-circle p-1 d-flex align-items-center justify-content-center">
                                                    <!-- <i class="bi bi-arrow-right-short bsb-rotate-45"></i> -->
                                                </span>
                                            </div>
                                            <div class="progress mt-3">
                                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</section>

</body>
<script
  src="https://code.jquery.com/jquery-3.7.1.slim.js"
  integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
  crossorigin="anonymous"></script>

<script>
    $(document).ready(function(){

        function ObterPosicao(lat, long){
            $("input[name=txtlatitude]").val(lat);
            $("input[name=txtlongitude]").val(long);
        }
        function ExibirLocalizacao(){
        var latitude = 0;
        var longitude = 0;

                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                }
        }
        function showPosition(position) {
                ObterPosicao(position.coords.latitude, position.coords.longitude);
        }
        ExibirLocalizacao();

    });
</script>
</html>