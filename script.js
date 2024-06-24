document.addEventListener('DOMContentLoaded', function() {
    // Seletores de elementos
    const form = document.querySelector("form");
    var button = document.querySelector('.icone');
    var button2 = document.querySelector('.fotos');
    var button3 = document.querySelector('.fotos2');
    var apel = document.querySelector('.apel');
    var apelido = document.querySelector('.apelido');
    var input = document.getElementById('apelidoInput');
    var pIM = document.querySelector('.pIM');
    const animButton = document.querySelector('.aIM');
    const barral = document.querySelector('.barral');
    const acoes = document.querySelector('.button');
    const icon = document.querySelector('.icon');
    const p = document.querySelector('p');
    const user = document.querySelector('.user');

    // Funções para mudança de visibilidade e animações
    button.onclick = function() {
        button2.style.display = "flex";
        button3.style.display = "flex";
        animButton.style.display = "flex";
        apelido.style.display = "none";
        pIM.style.display = "none";
    }

    apel.onclick = function() {
        apelido.style.display = "block";
        button2.style.display = "none";
        button3.style.display = "none";
        animButton.style.display = "none";
        pIM.style.display = "flex";
    }

    input.addEventListener('input', function() {
        if (input.value.trim() !== '') {
            pIM.classList.remove('confR');
            pIM.classList.add('conf');
            apelido.classList.add('des');
            apelido.classList.remove('desR');
        } else {
            pIM.classList.remove('conf');
            pIM.classList.add('confR');
            apelido.classList.add('desR');
            apelido.classList.remove('des');
        }
    });

    button.addEventListener('click', function() {
        barral.classList.add('tra');
        barral.classList.remove('traR');
        acoes.classList.add('test');
        icon.classList.add('test2');
        p.classList.add('subiP');
        p.classList.remove('desceP');
        p.classList.remove('Pipo');
        user.classList.add('exUser');
    });

    apel.addEventListener('click', function() {
        p.classList.add('invi');
        barral.classList.add('traR');
        acoes.classList.remove('test');
        icon.classList.remove('test2');
        p.classList.add('desceP');
        user.classList.remove('exUser');
        animButton.classList.add('dosR');
    });

    document.querySelector('.lolo').onclick = function() { changeImage('img/cat1.png'); };
    document.querySelector('.lola').onclick = function() { changeImage('img/cat2.png'); };
    document.querySelector('.lole').onclick = function() { changeImage('img/cat3.png'); };
    document.querySelector('.loli').onclick = function() { changeImage('img/cat4.png'); };

    // Função para mudar a imagem
    function changeImage(imageSrc) {
        document.getElementById('userImage').src = imageSrc;
        document.getElementById('imgSrcInput').value = imageSrc;
    }

    // Envio do formulário com fetch API
    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        try {
            const response = await fetch("atualizar_perfil.php", {
                method: "POST",
                body: formData
            });

            if (!response.ok) {
                throw new Error('Erro de rede ou servidor.');
            }

            const data = await response.json();

            if (data.success) {
                const divSuccess = document.querySelector(".alert-success");
                divSuccess.innerHTML = data.message;
                divSuccess.style.display = "block";
                divSuccess.classList.add('desce');

                setTimeout(() => {
                    divSuccess.classList.remove('desce');
                    divSuccess.classList.add('sobe');
                }, 2000);

            } else {
                const divMessage = document.querySelector(".alert");
                divMessage.innerHTML = data.message;
                divMessage.style.display = "block";
                divMessage.classList.add('desce');

                setTimeout(() => {
                    divMessage.classList.remove('desce');
                    divMessage.classList.add('sobe');

                    setTimeout(() => {
                        divMessage.classList.remove('sobe');
                        divMessage.style.display = "none"; // Fecha a mensagem após um tempo
                    }, 1500);

                }, 2500);
            }
        } catch (error) {
            console.error('Erro:', error);
            const divMessage = document.querySelector(".alert");
            divMessage.innerHTML = "Ocorreu um erro. Tente novamente mais tarde.";
            divMessage.style.display = "block";
            divMessage.classList.add('desce');

            setTimeout(() => {
                divMessage.classList.remove('desce');
                divMessage.style.display = "none"; // Fecha a mensagem após um tempo
            }, 1500);
        }
    });
});