var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
		console.log(xhttp.responseText);
	}
};
xhttp.open("POST", "http://localhost/todoapp/user/getAllToDos/26", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhttp.send("Email=AA@gmail.com");
