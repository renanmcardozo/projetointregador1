document.addEventListener("DOMContentLoaded", function() {
    const tabela = document.querySelector(".tabela");

    tabela.addEventListener("click", async (e) => {
        if (e.target && e.target.matches("a.excluir-link")) {
            e.preventDefault();

            const url = e.target.href;
            try {
                const response = await fetch(url, {
                    method: "GET"
                });

                const data = await response.json();

                if (data.success) {
                    const divSuccess = document.querySelector(".alert-success");
                    if (divSuccess) {
                        divSuccess.innerHTML = `Excluído!`;
                        divSuccess.classList.add('desce');

                        setTimeout(() => {
                            divSuccess.classList.add('sobe');
                            divSuccess.classList.remove('desce');
                        }, 1500);
                    } else {
                        console.error("Elemento '.alert-success' não encontrado.");
                    }
                } else {
                    const divMessage = document.querySelector(".alert");
                    if (divMessage) {
                        divMessage.innerHTML = data.message;
                        divMessage.classList.add('desce');

                        setTimeout(() => {
                            divMessage.classList.remove('desce');
                            divMessage.classList.add('sobe');
                        }, 2500);
                    } else {
                        console.error("Elemento '.alert' não encontrado.");
                    }
                }
            } catch (error) {
                console.error("Erro ao processar a solicitação:", error);
            }
        }
    });
});


(function() {
	var $body = document.body
	, $menu_trigger = $body.getElementsByClassName('menu-trigger')[0];

	if ( typeof $menu_trigger !== 'undefined' ) {
		$menu_trigger.addEventListener('click', function() {
			$body.className = ( $body.className == 'menu-active' )? '' : 'menu-active';
		});
	}

}).call(this);