function loadFiles() {
	//Get JSON list of files from ajax.php
	//Entry contains name and ID
	var form_data = new FormData();
	form_data.append("getData", true);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ajax.php", true);
	xhttp.onload = function (event) {
		if (xhttp.status == 200)
			for ($i = 0; $i < JSON.parse(this.response).length; $i++)
				generateOutput(JSON.parse(this.response)[$i]);
		else
			document.querySelector("#response").innerHTML =
				"Error " + xhttp.status + " occurred when trying to load your files.";
	};
	xhttp.send(form_data);
}

function upload_file(e) {
	//Send each file to ajax.php
	e.preventDefault();
	for ($i = 0; $i < e.dataTransfer.files.length; $i++)
		ajax_file_upload(e.dataTransfer.files[$i]);
}

function file_explorer() {
	//Get choosen files from explorer and send them to ajax.php
	document.getElementById("selectfile").click();
	document.getElementById("selectfile").onchange = function () {
		const files = document.querySelector("[type = file]").files;
		for (i = 0; i < files.length; i++) {
			fileobj = document.getElementById("selectfile").files[i];
			ajax_file_upload(fileobj);
		}
	};
}

function ajax_file_upload(file_obj) {
	//Send files to ajax.php and generate output ater successfull upload
	if (file_obj != undefined) {
		var form_data = new FormData();
		form_data.append("uploadFile", file_obj);
		var xhttp = new XMLHttpRequest();
		xhttp.open("POST", "ajax.php", true);
		xhttp.onload = function (event) {
			if (xhttp.status == 200) generateOutput(JSON.parse(this.response));
			else
				document.querySelector("#response").innerHTML =
					"Error " +
					xhttp.status +
					" occurred when trying to upload your file.";
		};
		xhttp.send(form_data);
	}
}

function generateOutput(res) {
	//Generate links and removal buttons for each file in database
	fileName = res[0];
	fileLink = res[1];
	responseBlock = document.querySelector("#response");
	div = document.createElement("div");
	div.setAttribute("id", fileLink);
	responseBlock.prepend(div);

	a = document.createElement("a");
	a.innerHTML = fileName;
	a.setAttribute("href", "#");
	a.setAttribute("onclick", 'copyToClipboard("' + fileLink + '")');
	div.appendChild(a);

	rm = document.createElement("a");
	rm.innerHTML = "[-]";
	rm.setAttribute("href", "#");
	rm.setAttribute("onclick", 'removeFile("' + fileLink + '")');
	div.appendChild(rm);
	div.appendChild(document.createElement("br"));
}

function copyToClipboard(item) {
	navigator.clipboard.writeText("https://drop.nasiadka.pl/f" + item);
}

function removeFile(item) {
	//Send file ID to ajax.php and remove file from website
	var form_data = new FormData();
	form_data.append("deleteItem", item);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "ajax.php", true);
	xhttp.onload = function (event) {
		if (xhttp.status == 200) document.getElementById(item).remove(item);
		else
			document.querySelector("#response").innerHTML =
				"Error " + xhttp.status + " occurred when trying to remove your file.";
	};
	xhttp.send(form_data);
}
function logout() {
	//Send logout request to ajax.php
	var form_data = new FormData();
	form_data.append("logout", true);
	var xhttp = new XMLHttpRequest();
	xhttp.open("POST", "index.php", true);
	xhttp.onload = function (event) {
		if (xhttp.status == 200) window.location = window.location;
		else
			document.querySelector("#response").innerHTML =
				"Error " + xhttp.status + " occurred when trying to log out.";
	};
	xhttp.send(form_data);
}
