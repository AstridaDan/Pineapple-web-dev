  var  y = document.getElementById("email");
  const  btn = document.getElementById('inputBtn');
  var check = document.getElementById('checkbox');
  valid = true;

 
y.addEventListener("keyup", (e) => {
   btn.disabled = false;
   checkEmail();
});
