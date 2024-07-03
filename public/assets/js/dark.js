// Dark Mode
document.getElementById('dark-mode-toggle').onclick=function() {
	document.body.classList.add('darkmode');
	this.classList.remove('active');
	document.getElementById('light-mode-toggle').classList.add('active');
	localStorage.setItem('darkMode', 'enabled');
	
}
document.getElementById('light-mode-toggle').onclick=function() {
	document.body.classList.remove('darkmode');
	this.classList.remove('active');
	document.getElementById('dark-mode-toggle').classList.add('active');
	localStorage.setItem('darkMode', null);
}

document.addEventListener("DOMContentLoaded", function(event) {
	let darkMode = localStorage.getItem('darkMode'); 
	if (darkMode == 'enabled') {
		document.body.classList.add('darkmode');
		document.getElementById('dark-mode-toggle').classList.remove('active');
		document.getElementById('light-mode-toggle').classList.add('active');
		localStorage.setItem('darkMode', 'enabled');
	} else {  
		document.body.classList.remove('darkmode');
		document.getElementById('light-mode-toggle').classList.remove('active');
		document.getElementById('dark-mode-toggle').classList.add('active');
		localStorage.setItem('darkMode', null);
	}
});
	