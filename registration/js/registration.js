function vanishField() {
	var tass = document.getElementById("youare").value;
	if (tass === '2' || tass === '3') {
		document.getElementById("qevents").style.display = "none";
		document.getElementById("1event").style.display = "none";
		document.getElementById("event1").value = "-;";
		document.getElementById("2event").style.display = "none";
		document.getElementById("event2").value = "-;";
		document.getElementById("3event").style.display = "none";
		document.getElementById("event3").value = "-;";
	} else {
		document.getElementById("qevents").style.display = "";
		enableRequired();
	}
}

function enableRequired() {
	var noEvents = document.getElementById("qualievents").value;
	if (noEvents === '1') {
		document.getElementById("1event").style.display = "";
		document.getElementById("2event").style.display = "none";
		document.getElementById("event2").value = "-;";
		document.getElementById("3event").style.display = "none";
		document.getElementById("event3").value = "-;";
	} else if (noEvents === '2') {
		document.getElementById("1event").style.display = "";
		document.getElementById("2event").style.display = "";
		document.getElementById("3event").style.display = "none";
		document.getElementById("event3").value = "-;";
	} else {
		document.getElementById("1event").style.display = "";
		document.getElementById("2event").style.display = "";
		document.getElementById("3event").style.display = "";
	}


}

function validateEvent() {
	var v1 = document.getElementById("event1").value;
	var v2 = document.getElementById("event2").value;
	var v3 = document.getElementById("event3").value;
	if (v1 === v2 && v2!='-;')
	{
		document.getElementById("event2").setCustomValidity("Enter different Event");
	}
	else if ((v1 === v3 || v2 === v3) && v3!='-;')
		document.getElementById("event3").setCustomValidity("Enter different Event");
	else {
		document.getElementById("event2").setCustomValidity("");
		document.getElementById("event3").setCustomValidity("");
	}
}


