var user = document.querySelector(".user");
var teste = document.querySelector(".testss");

// Obtém o nome do arquivo da src da imagem user
var userSrc = user.src.split('/').pop(); // Obtém apenas o nome do arquivo da src

if (userSrc === 'cat1.png') {
    teste.src = 'img/ban_cat1.png';
} else if (userSrc === 'cat2.png') {
    teste.src = 'img/ban_cat2.png';
} else if (userSrc === 'cat3.png') {
    teste.src = 'img/ban_cat3.png';
} else {
    teste.src = 'img/ban_cat4.png';
}
