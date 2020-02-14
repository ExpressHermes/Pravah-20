function enableHome() {
	document.getElementById('home').style.display = "";
	document.getElementById('lihome').style.color = "#F2B33F";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('lipassword').style.color = "white";
	document.getElementById('accomodation').style.display = "none";
	document.getElementById('liaccomodation').style.color = "#FFFFFF";
	document.getElementById('teams').style.display = "none";
	document.getElementById('liteams').style.color = "#FFFFFF";
}

function enablePassword() {
	document.getElementById('home').style.display = "none";
	document.getElementById('lihome').style.color = "#FFFFFF";
	document.getElementById('changepassword').style.display = "";
	document.getElementById('lipassword').style.color = "#F2B33F";
	document.getElementById('accomodation').style.display = "none";
	document.getElementById('liaccomodation').style.color = "#FFFFFF";
	document.getElementById('teams').style.display = "none";
	document.getElementById('liteams').style.color = "#FFFFFF";
}

function enableAccomodation() {
	document.getElementById('home').style.display = "none";
	document.getElementById('lihome').style.color = "#FFFFFF";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('lipassword').style.color = "#FFF";
	document.getElementById('accomodation').style.display = "";
	document.getElementById('liaccomodation').style.color = "#F2B33F";
	document.getElementById('teams').style.display = "none";
	document.getElementById('liteams').style.color = "#FFFFFF";
}

function enableTeams() {
	document.getElementById('home').style.display = "none";
	document.getElementById('lihome').style.color = "white";
	document.getElementById('changepassword').style.display = "none";
	document.getElementById('lipassword').style.color = "white";
	document.getElementById('accomodation').style.display = "none";
	document.getElementById('liaccomodation').style.color = "#FFFFFF";
	document.getElementById('teams').style.display = "";
	document.getElementById('liteams').style.color = "#F2B33F";
}

function enableCheckbox() {
	document.getElementById("askAccommodation").style.display = "";
}

function enableOthers() {
	var bool = document.getElementById("valueAcc").value;
	if (bool === "1") {
		enableField();
	} else {
		disabledField();
	}
}

function enableField() {
	document.getElementById("UPI").style.display = "";
	document.getElementById("askID").style.display = "";
	document.getElementById("TID").style.display = "";
	document.getElementById("Sbutton").style.display = "";
}

function disabledField() {
	document.getElementById("UPI").style.display = "none";
	document.getElementById("askID").style.display = "none";
	document.getElementById("TID").style.display = "none";
	document.getElementById("Sbutton").style.display = "none";
}

function pendingPayment() {
	document.getElementById("pending").style.display = "";
}

function confirmPayment() {
	document.getElementById("pending").style.display = "none";
	document.getElementById("confirm").style.display = "";
	document.getElementById("askAccommodation").style.display = "none";
	disabledField();
}
