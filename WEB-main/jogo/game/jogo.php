<?php

require "../database/authenticate.php";

if (!$login) {
    die("Você não tem permissão para acessar essa página.");
}

?>
<!DOCTYPE html>
<html lang="br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="../js/script.js"></script>
</head>

<body>
    <div class="container">
        <div id="score" class="btn btn-light"> Pontuação </div>
        <div class="hero-container">
            <img id="hero-image" src="../assets/heroina1.png" alt="Hero Image">
            <div id="estaminaHeroi" class="btn btn-info"> </div>
            <div id="vidaHeroi" class="btn btn-success"></div>
            <div id="nomeHeroi" class="btn btn-dark"> Hel </div>
            <img class="perfil" src="../assets/perfil.png" alt="foto de perfil">
        </div>
        <div class="vilain-container">
            <div id="vidaV1-bar" class="btn btn-success"></div>
            <div id="vidaV2-bar" class="btn btn-success"></div>
            <div id="vidaV3-bar" class="btn btn-success"></div>
            <img class="vilain-image-1" id="ast" src="../assets/vilao1.png" alt="Vilao 1">
            <img class="vilain-image-2" id="nil" src="../assets/cachorro.png" alt="Cachorro">
            <img class="vilain-image-3" id="go" src="../assets/vilao2.png" alt="Vilao 2">
            <div class="name btn btn-primary" id="nome1">Astarion</div>
            <div class="name btn btn-primary" id="nome2">Nil</div>
            <div class="name btn btn-primary" id="nome3">Gohaa</div>
        </div>
        <div class="attack-options">
            <button class="opcao btn btn-warning" id="weak-attack" data-attack="Ataque Fraco">Fraco</button>
            <button class="opcao btn btn-warning" id="medium-attack" data-attack="Ataque Médio">Forte</button>
            <button class="opcao btn btn-warning" id="strong-attack" data-attack="Ataque Forte">Duplo</button>
            <button class="opcao btn btn-warning" id="itens">Itens</button>
        </div>
        <div class="target-word invisible"></div>
        <input type="text" id="user-input" style="display: none">
        <input type="text" id="user-input2" style="display: inline;">
    </div>
    <div class="modal" id="myModal"
        style="display: none; width: 60%; height: 100% ;top: 60%; left: 50%; transform: translate(-50%, -50%); background-image: url('assets/inventario.jpg')">

        <div class="modal-content" style="background-color: white; text-align: center;">
            <span class="close">&times;</span>
            <h2>Selecione seu item</h2>
        </div>
        <div class="item-section" style="font-size: 24px;">
            <div class="item1">Poção</div>
            <img class="vida" src="../assets/vida.png" alt="vida">
            <div class="item2">Energia</div>
            <img class="energia" src="../assets/energia.png" alt="energia">
            <div class="item3">Buff</div>
            <img class="buff" src="../assets/buff.png" alt="buff">
            <input type="text" id="escolha">
        </div>
    </div>

    <a href="inicio.php" class="btn btn-danger mt-3" style="position: fixed; left: 99vw; font-size: 5vh;">Sair</a>

</body>

</html>