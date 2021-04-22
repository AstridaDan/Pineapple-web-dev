document.getElementById('inputBtn').disabled = true;
function checkEmail() {
    var x, text, btn, message, lastChar, last2, email, check;
    x = document.getElementById("email").value;
    check = document.getElementById('checkbox');
    btn = document.getElementById('inputBtn');

    message = document.getElementById("errorMessage")
    lastChar = x.charAt(x.length-1);
    last2 = x.slice(-2);
    email = x.split('@').pop().split('.')[0]; // check letters between @ and .

    if (x === "") {
        text = "Email address is required";
        btn.disabled = true;
    }  
    else if(!x.includes("@") || !x.includes(".") || x.length < 5 || x.indexOf(' ') >= 0) {
        text =  "Please provide a valid e-mail address";
        btn.disabled = true;
    }
    else if (email.length <= 1 || email.search(/[^a-zA-Z]+/) !== -1){
        text =  "Please provide a valid e-mail address";
        btn.disabled = true;
    }
    else if (x.charAt(0) === "@" || lastChar.search(/[^a-zA-Z]+/) !== -1){
        text =  "Please provide a valid e-mail address";
        btn.disabled = true;
    }
    else if (last2 === "co"){
        text =  "We are not accepting subscriptions from Colombia emails";
        btn.disabled = true;
    }
     else if (!check.checked) {
        text   = "You must accept the terms and conditions";
        btn.disabled = true;

        check.addEventListener('change', function() {
            text =  "";
            btn.disabled = false;
        });
     }
    else{
        text =  "";
        btn.disabled = false;
        console.log("viss super")
    }
    message.style.display = "block";
    message.innerHTML = text;
    //hide error message if there is no error
    if(text === ""){
        message.style.display = "none";
        btn.disabled = false;
    }
}

//SUCCESS MESSAGE FUNCTION
function submitted(){
    var form = document.getElementById("myForm");
    var title = document.getElementById("title");
    var text = document.getElementById("paragraph");
    var img = document.getElementById("success-logo");
    var nav = document.getElementById("nav");

    form.style.display = "none";

    img.style.display = "block";
    title.innerHTML = "Thanks for subscribing!";
    title.style.marginBottom = "20px";
    text.innerHTML = "You have successfully subscribed to our email listing. Check your email for the discount code.";
    text.style.marginBottom = "57px";
    nav.style.marginBottom = "126px";
}