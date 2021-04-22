  var  y = document.getElementById("email");
  const  btn = document.getElementById('inputBtn');
  var check = document.getElementById('checkbox');
  var x = document.getElementById("email").value;
  var form = document.getElementById('myForm');
  var text;
  var message = document.getElementById("errorMessage");
 
y.addEventListener("keyup", (e) => {
  message.style.display = "none";
  btn.disabled = false;
  checkEmail();
   
});

//THIS CODE WOULD SHOW SUCCESS MESSAGE WITHOUT PHP
form.addEventListener("submit", (e) =>{ 
  submitted();
  e.preventDefault()
});