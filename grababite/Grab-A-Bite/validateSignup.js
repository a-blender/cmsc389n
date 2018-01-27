<!-- Signup Form Javascript Validation -->
<!-- by Anna Blendermann-->

/* Set the function to call validateForm when selected */
var submit = document.getElementById("submit");
submit.onclick = validateForm;

function validateForm() {

    var firstName = document.getElementById("firstName").value;
    var lastName = document.getElementById("lastName").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var phone = document.getElementById("phone").value;
    var invalidMessages = "";

    /* validate first and last name */
    if (!isNaN(firstName) ) {
        invalidMessages += "Invalid first name.\n";
    }
    if (!isNaN(lastName) ) {
        invalidMessages += "Invalid last name.\n";
    }

    /* validate email */
    var regex = /\S+@\S+\.\S+/;
    if (!regex.test(email)) {
        invalidMessages += "Invalid email address.\n";
    }

    /* validate password */
    if (password.length < 8) {
        invalidMessages += "Password must be at least 8 characters.\n";
    }

    /* validate phone number */
    if (isNaN(phone) || phone.length != 10) {
        invalidMessages += "Invalid phone number.\n";
    }

    /* display error messages or submit data */
    if (invalidMessages !== "") {
        alert(invalidMessages);
        return false;
    }
    else {
        var submitMessage = "Do you want to sign up for Grab A Bite?\n";
        window.confirm(submitMessage);
    }
}