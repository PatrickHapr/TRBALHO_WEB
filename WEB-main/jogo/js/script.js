$(document).ready(function () {
    document.body.style.zoom = "90%"
    const words = ["tecnologia", "programação", "inovação", "desenvolvimento", "cibernética", "combate", "algoritmo", "criptografia", "futurismo", "robótica", "segurança", "inteligência", "máquina", "virtual", "realidade", "cyberpunk"];
    // Pegando os ids
    const targetWord = $('.target-word');
    const HeroImage = $('#hero-image');
    const userInput = $('#user-input');
    const userInput2 = $('#user-input2');
    const scoreDisplay = $('#score');
    const modal = document.getElementById('myModal');
    const item1 = $('.item1');
    const item2 = $('.item2');
    const item3 = $('.item3');
    // Serve para centralizar as Palavras
    var larguraJanela = $(window).width();
    var inputEscolha = document.getElementById('escolha');
    // Tentativa de só permitir letras nos inputs
    var regex = /^[a-zA-Z]+$/;
    var score = 0;
    // Defini a etapa que cada ação é executada
    let a = 0;
    var turno = "heroi";
    // Começa em menos um para não bugar quando chama a primeira palavra aparece
    let golpes = -1;
    let vidaV1 = 20;
    let vidaV2 = 20;
    let vidaV3 = 20;
    let dano = 0;
    let cansaco;
    let estamina = 20;
    let vida = 20;
    let currentIndex = 0;
    // Para o Som
    var effect;
    // Serve para o Buff
    var ad = 1;
    // Número de Itens
    var qtdPocao = 1;
    var qtdBuff = 1;
    var qtdEnergia = 1;
    // A forca é usada para controlar quantas palavras vão aparecer na tela.
    var forca = 10;
    var inimigo = 0;
    //Iniciar a música
    var musica = 1;
    // Para calcular a Pontuação
    var startTime, endTime;
    var som = [
        "../songs/fala.mp3",
        "../songs/atack1.mp3",
        "../songs/atack2.mp3",
        "../songs/atack3.mp3",
        "../songs/atack_i1.mp3",
        "../songs/atack_i2.mp3",
        "../songs/atack_i3.mp3",
        "../songs/fala.mp3",
    ];
    //Nome dos vilões
    let idviloes = ["#ast", "#nil", "#go"];
    const HeroImages = ["../assets/heroina1.png", "../assets/heroina4.png", "../assets/heroina2.png", "../assets/heroina3.png"];
    const vilainsImages = ["../assets/vilao1ataque.png", "../assets/cachorroataque.png", "../assets/vilao2ataque.png"];
    const fistVilains = ["../assets/vilao1.png", "../assets/cachorro.png", "../assets/vilao2.png"];
    let currentImageIndex = 0;

    //  Todas as Letras em Minúsculo
    function setupGame() {
                const userInput = $('#user-input2').val().toLowerCase();
    }

    //  Faz aparecer a próxima palavra no centro e inicialmente invisível
    function displayNextWord() {
        let randomIndex = Math.floor(Math.random() * words.length);
        targetWord.text(words[randomIndex]);
        var larguraElemento = $('.target-word').width();
        var novaPosicao = (larguraJanela - larguraElemento) / 2;
        $('.target-word').css({
            'color': 'yellow',
            'font-size': '10vh',
            'position': 'fixed',
            'left': novaPosicao + 30 +'px',
            'top': '45%'
        });
        userInput.val('');
        golpes++;
    }

    // Movimentação do Herói
    function showHeroImage() {
        HeroImage.attr("src", HeroImages[currentImageIndex]).show();
    }

    //Imagem de ataque de cada inimigo
    function showImage(mostrar) {
        $(idviloes[mostrar]).attr("src", vilainsImages[mostrar]).show();
    }
    // A primeira posição de cada inimigo
    function showFirstVilain(identificacao) {
        $(idviloes[identificacao]).attr("src", fistVilains[identificacao]).show();
    }

    //Posição inicial do herói
    function showFirstHeroImage() {
        currentImageIndex = 0;
        showHeroImage();
    }

    //Atualiza a vida
    function updateLifeBars() {
        const vidaV1Bar = $('#vidaV1-bar');
        const vidaV2Bar = $('#vidaV2-bar');
        const vidaV3Bar = $('#vidaV3-bar');
        const estaminaBar = $('#estaminaHeroi');
        const vidaHeroi = $('#vidaHeroi');
        vidaHeroi.css('width', `${vida}vh`);
        estaminaBar.css('width', `${estamina}vh`);
        vidaV1Bar.css('width', `${vidaV1}vh`);
        vidaV2Bar.css('width', `${vidaV2}vh`);
        vidaV3Bar.css('width', `${vidaV3}vh`);
    }

    //Ataque de cada um
    var somAtaque = som.map(function (efeito) {
        return new Audio(efeito);
    });

    //Quando o inimigo ataca
    function ataqueInimigo(dano) {
        vida -= dano;
        updateLifeBars();
        // Atualiza a animação de vida da personagem
        if (vida <= 12) {
            $('.perfil').css('border', '10px solid orange');
            $('#vidaHeroi').removeClass('btn btn-success').addClass('btn btn-warning');
        }
        if (vida <= 6) {
            $('.perfil').css('border', '10px solid red');
            $('#vidaHeroi').removeClass('btn btn-success').addClass('btn btn-danger');
        }
        if (vida <= 0) {
            HeroImage.remove();
            $('#estaminaHeroi').remove();
            $('#vidaHeroi').remove();
            $('#nomeHeroi').remove();
            window.location.href = 'derrota.php';
        }
    }
    //POST para o pontuação
    function vitoria() {
        $.post('../database/pontuacao.php', { score: score })
            .done(function () {
                console.log("Pontuação atualizada com sucesso!");
                console.log(response)
            })
            .fail(function (xhr, status, error) {
                console.error("Erro ao atualizar a pontuação: ");
            });
        //Chama a tela de vitória
        window.location.href = 'vitoria.php';
    }

    //Cada ação quando o inimigo ataca
    function inimigoATQ() {
        a = 0;
        if (vidaV1 > 0) {
            setTimeout(() => {
                showImage(0);
                somAtaque[4].play();
                setTimeout(() => {
                    showFirstVilain(0);
                }, 2000);
                setTimeout(() => {
                    ataqueInimigo(1);
                }, 1000);
            }, 2000);
        }
        if (vidaV2 > 0) {
            setTimeout(() => {
                showImage(1);
                somAtaque[5].play();
                setTimeout(() => {
                    showFirstVilain(1);
                }, 2500);
                setTimeout(() => {
                    ataqueInimigo(2);
                }, 1000);
            }, 2500);
        }
        if (vidaV3 > 0) {
            setTimeout(() => {
                showImage(2);
                somAtaque[6].play();
                setTimeout(() => {
                    showFirstVilain(2);
                }, 3000);
                setTimeout(() => {
                    ataqueInimigo(3);
                }, 1000);
            }, 3000);
        }
        setTimeout(function () {
            turno = "heroi";
        }, 4000);
    }

    setupGame();
    displayNextWord();

    // Evento é acionado quando um tecla é pressionada no documento
    $(document).keydown((event) => {
        //Inicia a música apenas uma vez
        if (musica === 1) {
            var somTema = new Audio('../songs/tema.mp3');
            somTema.volume = 0.1;
            somTema.play();
            musica = 0;
        }
        if (turno === "heroi") {
            //Pegar cada letra
            var input = event.key.toLowerCase();
            // Pega o que ta no Input2, no caso o que ta aparendo na tela
            var userVal2 = userInput2.val();
            if (!regex.test(input) || input === "dead" || input === "tab" || input === "alt" || input === "control" || input === "shift") {
                input = "";
            }
            if (!regex.test(userInput2.val()) || userInput2.val() === "dead" || userInput2.val() === "tab" || userInput2.val() === "alt") {
                userInput2.val("");
            }
            if (a == 0) {
                //Apaga tudo
                if (input === 'backspace') {
                    userVal2 = "";
                    input = "";
                }
                // Formar a palavra
                userInput2.val(userVal2 + input);
                if (userInput2.val() === 'fraco') {
                    a = 1;
                    userInput.val("");
                    currentImageIndex = 1;
                    dano = 4 * ad;
                    cansaco = 3;
                    b = 0;
                    $('#weak-attack').removeClass('btn btn-warning').addClass('btn btn-success');
                    setTimeout(function () {
                        $('#weak-attack').removeClass('btn btn-success').addClass('btn btn-primary');
                    }, 1000);
                    userVal2 = "";
                    input = "";
                    // Para o som
                    effect = 1;
                    // A forca é usada para controlar quantas palavras vão aparecer na tela
                    forca = 1;
                }
                if (userInput2.val() === 'forte') {
                    a = 1;
                    userInput.val("");
                    currentImageIndex = 2;
                    dano = 6 * ad;
                    cansaco = 5;
                    b = 1;
                    $('#medium-attack').removeClass('btn btn-warning').addClass('btn btn-success');
                    setTimeout(function () {
                        $('#medium-attack').removeClass('btn btn-success').addClass('btn btn-primary');
                    }, 1000);
                    userVal2 = "";
                    input = "";
                    // Para o som
                    effect = 2;
                    // A forca é usada para controlar quantas palavras vão aparecer na tela
                    forca = 2;
                }
                if (userInput2.val() === 'duplo') {
                    a = 1;
                    userInput.val("");
                    currentImageIndex = 3;
                    dano = 10 * ad;
                    cansaco = 8;
                    b = 2;
                    $('#strong-attack').removeClass('btn btn-warning').addClass('btn btn-success');
                    setTimeout(function () {
                        $('#strong-attack').removeClass('btn btn-success').addClass('btn btn-primary');
                    }, 1000);
                    userVal2 = "";
                    input = "";
                    // Para o som
                    effect = 3;
                    // A forca é usada para controlar quantas palavras vão aparecer na tela
                    forca = 3;
                }
                if (userInput2.val() === 'itens' && (qtdPocao > 0 || qtdBuff > 0 || qtdEnergia > 0)) {
                    userInput2.val("");
                    $('.modal').fadeIn(800);
                    $('.container').addClass('opacidade-reduzida')
                    a = 4;
                    document.getElementById('escolha').focus();
                    document.getElementById('escolha').value = "";
                    function limparCampo(event) {
                        document.getElementById('escolha').value = "";
                        inputEscolha.removeEventListener('input', limparCampo);
                    }
                    
                    inputEscolha.addEventListener('input', limparCampo);
                    inputEscolha.addEventListener('input', function (event) {
                        var textoAtual = event.target.value;
                            if (textoAtual.toLowerCase() === 'poção' && qtdPocao > 0) {
                                qtdPocao -= 1;
                                vida = vida + 10;
                                if (vida > 20)
                                    vida = 20;
                                updateLifeBars();
                                modal.style.display = 'none';
                                $('.container').removeClass('opacidade-reduzida');
                                inimigoATQ();
                            }
                            if (textoAtual.toLowerCase() == 'energia' && qtdEnergia > 0) {
                                qtdEnergia -= 1;
                                estamina = estamina + 2;
                                if (estamina > 20)
                                    estamina = 20;
                                updateLifeBars();
                                modal.style.display = 'none';
                                $('.container').removeClass('opacidade-reduzida');
                                inimigoATQ();
                            }
                            if (textoAtual.toLowerCase() == 'buff' && qtdBuff > 0) {
                                qtdBuff -= 1;
                                ad = 2;
                                modal.style.display = 'none';
                                $('.container').removeClass('opacidade-reduzida');
                                inimigoATQ();
                            }
                            item1.text(`Poção   ${qtdPocao}`);
                            item2.text(`Energia ${qtdEnergia}`);
                            item3.text(`Buff   ${qtdBuff}`);
                    })
                }
            }
            if (a == 1) {
                if (input === 'backspace') {
                    userVal2 = "";
                    input = "";
                }
                $('.opcao').removeClass('btn btn-warning').addClass('btn btn-primary');
                {
                    userInput2.val(userVal2 + input);
                    $('.name').removeClass('btn btn-primary').addClass('btn btn-warning');
                    if (userInput2.val() == 'astarion') {
                        $('#nome1').removeClass('btn btn-warning').addClass('btn btn-success');
                        a = a + 1;
                        inimigo = 1;
                    }
                    if (userInput2.val() == 'nil') {
                        $('#nome2').removeClass('btn btn-warning').addClass('btn btn-success');
                        a = a + 1;
                        inimigo = 2;
                    }
                    if (userInput2.val() == 'gohaa') {
                        $('#nome3').removeClass('btn btn-warning').addClass('btn btn-success');
                        a = a + 1;
                        inimigo = 3;
                    }
                }
            }
            if (a == 2) {
                if (!startTime) {
                    startTime = new Date();
                }
                userInput.val('');
                userInput2.val('');
                $('.opcao').removeClass('btn btn-success').addClass('btn btn-primary');
                $('.name').removeClass('btn btn-warning').addClass('btn btn-primary');
                var larguraElemento = $('.target-word').width();
                var novaPosicao = (larguraJanela - larguraElemento) / 2;
                $('.target-word').removeClass('invisible').addClass('visible').css({
                    'color': 'yellow',
                    'font-size': '10vh',
                    'position': 'fixed',
                    'left': novaPosicao + 30 +'px',
                    'top': '45%'
                });

                const input = event.key.toLowerCase();
                //Pega a palavra que precisa ser digitada
                const currentWord = targetWord.text().toLowerCase();
                //A próxima letra, começando no índice zero
                const currentLetter = currentWord[currentIndex].toLowerCase();

                if (input === currentLetter) {
                    //Divide a palavra em um array de letras
                    const letras = currentWord.split('');
                    let newText = '';
                    //Itera por todas as letras
                    for (let i = 0; i < letras.length; i++) {
                        //currentIndex vai ser igual a quatidade de letras acertadas, ou seja, a quantidade de letras verdes
                        // Será a quantidade de currentIndex e o resto ele preencherá com as letras na cor padrão.
                        if (i <= currentIndex) {
                            newText += '<span style="color: green;">' + letras[i] + '</span>';
                        } else {
                            newText += letras[i];
                        }
                    }
                    //Atualiza a palavra com a nova string "newText" que tem as letras corretas em verde
                    $('.target-word').html(newText);
                    currentIndex++;
                    if (currentIndex === currentWord.length) {
                        currentIndex = 0;
                        // Chama uma nova palavra
                        displayNextWord();
                    }
                }

            }
            if (golpes == forca) {
                endTime = new Date();
                var timeTaken = parseInt((endTime - startTime) / 1000);
                score += 50 - 2 * timeTaken;
                startTime = null;
                $('.name').removeClass('btn btn-success').addClass('btn btn-primary');
                if (inimigo == 1) {
                    vidaV1 = vidaV1 - dano;
                }
                if (inimigo == 2) {
                    vidaV2 = vidaV2 - dano;
                }
                if (inimigo == 3) {
                    vidaV3 = vidaV3 - dano;
                }
                if (vidaV1 <= 0) {
                    $('.vilain-image-1').remove();
                    $('#nome1').remove();
                    $('#vidaV1-bar').remove();
                    score += 100;
                }
                if (vidaV2 <= 0) {
                    $('.vilain-image-2').remove();
                    $('#nome2').remove();
                    $('#vidaV2-bar').remove();
                    score += 200;
                }
                if (vidaV3 <= 0) {
                    $('.vilain-image-3').remove();
                    $('#nome3').remove();
                    $('#vidaV3-bar').remove();
                    score += 300;
                }
                console.log(vidaV1);
                console.log(vidaV2);
                console.log(vidaV3);
                estamina = estamina - cansaco;
                somAtaque[0].play();
                // Som
                somAtaque[effect].play();
                updateLifeBars();
                scoreDisplay.text(`Pontuação ${score}`);
                userInput.val('');
                userInput2.val('');
                showHeroImage();
                setTimeout(showFirstHeroImage, 1000);
                // Para voltar para o começo
                a = 0;
                golpes = 0;
                $('.opcao').removeClass('btn btn-primary').addClass('btn btn-warning');
                //Palavra sai da tela novamente
                $('.target-word').addClass('invisible');
                turno = "inimigo";
            }
            if (turno == "inimigo") {
                inimigoATQ();
            }
            if (vidaV1 <= 0 && vidaV2 <= 0 && vidaV3 <= 0) {
                vitoria();
            }
        }

    });

});
