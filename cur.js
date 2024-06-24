document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('#content');
    const div = document.querySelector('.cursos');
	const events = document.querySelectorAll('.curso');

	// Verificar o número de eventos
	if (events.length > 0) {
		div.style.marginTop = "320px"; // Novo valor para margin-top
	}

	if (events.length > 3) {
		div.style.marginTop = "235px"; // Novo valor para margin-top
	}

	if (events.length > 6) {
		div.style.marginTop = "120px"; // Novo valor para margin-top
	}

	if (events.length > 9) {
		div.style.marginTop = "35px"; // Novo valor para margin-top
	}

	button.onclick = function() {
		console.log('Button clicked');
		if (div.style.marginLeft === "260px") {
			div.style.marginLeft = "180px"; // Posição inicial
		} else {
			div.style.marginLeft = "260px"; // Posição deslocada
		}
	}
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