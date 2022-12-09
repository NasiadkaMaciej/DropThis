document.onload = function () {
	document.getElementById("passwordInput").autofocus;
	document.getElementById("passwordInput").focus();
	document.getElementById("passwordInput").click();
};
var timeoutTime = 0;

var password = "";
var lastTimeout = 0;

window.onkeydown = function onKeyPress(event) {
	switch (event.keyCode) {
		case 8:
			if (password.length > 0)
				password = password.slice(0, password.length - 1);
			else {
				returnColor();
				return;
			}
			break;
		case 13:
			document.getElementById("passwordInput").value = password;
			document.getElementById("loginInput").submit();
			break;
		default:
			if (event.keyCode > 31 && event.keyCode < 127)
				password += String.fromCharCode(event.keyCode);
			else {
				returnColor();
				return;
			}
	}
	var randomColor = "#" + Math.floor(Math.random() * 16777215).toString(16);
	document.getElementById("dot").style.borderColor = randomColor;
	document.getElementById("dot").style.opacity = 0.8;
	clearTimeout(lastTimeout);
	lastTimeout = setTimeout("returnColor()", 1500);
};
function returnColor() {
	document.getElementById("dot").style.borderColor = "#000";
	document.getElementById("dot").style.opacity = 0;
}
setTimeout("removeError()", 5000);
function removeError() {
	if (document.getElementById("error") != null)
		document
			.getElementById("error")
			.parentNode.removeChild(document.getElementById("error"));
}