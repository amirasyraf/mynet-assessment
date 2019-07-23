function openAddModal() {
	var element = document.getElementById("addmodal");
  	element.classList.add("active");
}

function openUpdateModal(userId) {
	var element = document.getElementById("updatemodal");
  	element.classList.add("active");

 //  	var xhr = new XMLHttpRequest();
	// xhr.open('POST', 'fetch.php', true);
	// xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	// xhr.onload = function () {
	//     //console.log(this.responseText);
	//     var jsonObj = JSON.parse(this.responseText);

	//     document.getElementById("update-id").value = jsonObj[0]['id'];
	//     document.getElementById("change-pass-id").value = jsonObj[0]['id'];
	//     document.getElementById("update-fullname").value = jsonObj[0]['fullname'];
	//     document.getElementById("update-username").value = jsonObj[0]['username'];
	// 	document.getElementById("update-mykad").value = jsonObj[0]['mykad'];
	// 	document.getElementById("update-email").value = jsonObj[0]['email'];
	// 	document.getElementById("update-date_registered").value = jsonObj[0]['date_registered'];
	// };
	// xhr.send('userId=' + userId);

	fetch('fetch.php', {
		method: 'post',
		headers: {
	      "Content-type": "application/x-www-form-urlencoded; charset=UTF-8"
	    },
	    body: 'userId=' +userId
	})
	.then(
		function(response) {
			response.json().then(function(data) {

			    document.getElementById("update-id").value = data[0]['id'];
			    document.getElementById("change-pass-id").value = data[0]['id'];
			    document.getElementById("update-fullname").value = data[0]['fullname'];
			    document.getElementById("update-username").value = data[0]['username'];
				document.getElementById("update-mykad").value = data[0]['mykad'];
				document.getElementById("update-email").value = data[0]['email'];
				document.getElementById("update-date_registered").value = data[0]['date_registered'];
			});
	})
	.catch(function(err) {
	    console.log('Fetch Error :-S', err);
	});
}
function openChangePassModal() {
	var element = document.getElementById("changepassmodal");
  	element.classList.add("active");
}

function closeAddModal() {
	var element = document.getElementById("addmodal");
  	element.classList.remove("active");
}

function closeUpdateModal() {
	var element = document.getElementById("updatemodal");
  	element.classList.remove("active");
}

function closeChangePassModal() {
	var element = document.getElementById("changepassmodal");
  	element.classList.remove("active");
}

function logout() {
	window.location.replace("logout.php");
}
