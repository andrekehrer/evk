<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://getbootstrap.com/docs/5.0/examples/grid/grid.css" rel="stylesheet">
    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>
</head>
<body>
<?php
    if($funcionario[0]->foto == ''){
        $foto = 'https://cdn-icons-png.flaticon.com/512/149/149071.png';
    }else{
        $foto = base_url().'assets/funcionarios/'.$funcionario[0]->foto;
    }
?>
<div class="container mt-4">
    <img src="https://evk.andrekehrer.com/assets/img/logo.png"  width="100">
    <hr>
    <div style="background-image: url(<?=$foto?>);background-color: #cccccc;height: 150px;width: 150px;background-position: center;background-repeat: no-repeat;background-size: cover;position: relative;border-radius: 50%;margin-bottom: 8px;border: 3px #4ac5bf solid;"></div>
    <h1> <?=$funcionario[0]->nome?> <?=$funcionario[0]->sobrenome?></h1>
    
    <div class="row mb-3">
        <div class="col-sm-3 themed-grid-col">Permissão:</div>
        <div class="col-sm-9 themed-grid-col">
            <?= $funcionario[0]->permissao == 1 ? 'Gestor' : '' ?>
            <?= $funcionario[0]->permissao == 2 ? 'Administrador RDI/RDF' : '' ?>
            <?= $funcionario[0]->permissao == 3 ? 'Usuário comum' : '' ?> 
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-sm-3 themed-grid-col">Data de Admissão:</div>
        <div class="col-sm-9 themed-grid-col"><?=date('d/m/Y', $funcionario[0]->admissao)?></div>
    </div>

</div>
    
</body>
</html>