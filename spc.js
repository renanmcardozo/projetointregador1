document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector("form");

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        const response = await fetch("logar.php", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            const divSuccess = document.querySelector(".alert-success");
            divSuccess.innerHTML = `Login feito com sucesso!`;
            divSuccess.classList.add('desce');

            setTimeout(() => {
                divSuccess.classList.remove('desce');
                window.location.href = 'home.php';
            }, 1500);

        } else {
            const divMessage = document.querySelector(".alert");
            divMessage.innerHTML = data.message;
            divMessage.classList.add('desce');
        
            setTimeout(() => {
                divMessage.classList.remove('desce');
                divMessage.classList.add('sobe');
            }, 2500);
        }
    });
});
