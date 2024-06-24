document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('form');
    const email = document.querySelector('.email');
    const pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

    email.addEventListener('input', () => {
        // Avalia se corresponde aos valores do padrão
        if (email.value.match(pattern)) {
            form.classList.add('valid');
            form.classList.remove('invalid');
        } else {
            form.classList.add('invalid');
            form.classList.remove('valid');
        }

        // Se o campo de entrada estiver vazio, remove as classes
        if (email.value === '') {
            form.classList.remove('invalid');
            form.classList.remove('valid');
        }
    });

    form.addEventListener('submit', (event) => {
        if (!email.value.match(pattern)) {
            event.preventDefault();
            alert('Por favor, insira um e-mail válido.');
        }
    });
});
