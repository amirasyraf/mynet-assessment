function openAddModal() {
	var element = document.getElementById("addmodal");
  	element.classList.add("active");
}

function openUpdateModal(userId) {
	var element = document.getElementById("updatemodal");
  	element.classList.add("active");

  	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'fetch.php', true);
	xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	xhr.onload = function () {
	    console.log(this.responseText);
	    var jsonObj = JSON.parse(this.responseText);

	    console.log(jsonObj[0]['fullname']);

	    document.getElementById("update-id").value = jsonObj[0]['id'];
	    document.getElementById("update-fullname").value = jsonObj[0]['fullname'];
		document.getElementById("update-mykad").value = jsonObj[0]['mykad'];
		document.getElementById("update-email").value = jsonObj[0]['email'];
		document.getElementById("update-date_registered").value = jsonObj[0]['date_registered'];
	};
	xhr.send('userId=' + userId);
}
function closeAddModal() {
	var element = document.getElementById("addmodal");
  	element.classList.remove("active");
}

function closeUpdateModal() {
	var element = document.getElementById("updatemodal");
  	element.classList.remove("active");
}

function logout() {
	window.location.replace("logout.php");
}