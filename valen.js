document.addEventListener('DOMContentLoaded', function() {
    const button = document.querySelector('#content');
    const div = document.querySelector('table');

button.onclick = function() {
    console.log('Button clicked');
    if (div.style.marginLeft === "260px") {
        div.style.marginLeft = "160px"; // Posição inicial
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