$(document).ready(function(){
	// CHARACTER COUNTER
	document.getElementById('tarea').addEventListener('input', function() {
		var text = this.value;
		var count = text.trim().replace(/\s+/g, ' ').split(' ').length;
		if (text.length > 5) {
			alert('good');
		};
	});
})