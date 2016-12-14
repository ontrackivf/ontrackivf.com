function showModal(div, blackoutcolor) {
    "use strict";
    if (typeof blackoutcolor !== 'undefined') {
		document.getElementById('blackout').style.backgroundColor = blackoutcolor;
    }
    document.getElementById('blackout').style.display = 'block';
    document.getElementById(div).style.display = 'block';
    $('body').addClass('stop-scroll');
    document.openModal = div;
}
function hideModal(div) {
    "use strict";
    document.getElementById('blackout').style.display = 'none';
    document.getElementById('blackout').style.backgroundColor = 'black';
	document.getElementById(div).style.display = 'none';
    $('body').removeClass('stop-scroll');
    document.openModal = '';
}
