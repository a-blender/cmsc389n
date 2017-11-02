<!-- Research Form Javascript Validation -->
<!-- by Anna Blendermann-->

/* Set the function to call validateForm when selected */
window.onsubmit=validateForm;

function validateForm() {

    var phone1 = document.getElementById("phoneFirstPart").value;
    var phone2 = document.getElementById("phoneSecondPart").value;
    var phone3 = document.getElementById("phoneThirdPart").value;

    var highBP = document.getElementById("highBloodPressure");
    var diabetes = document.getElementById("diabetes");
    var glaucoma = document.getElementById("glaucoma");
    var asthma = document.getElementById("asthma");
    var none = document.getElementById("none");

    var id1 = document.getElementById("firstFourDigits").value;
    var id2 = document.getElementById("secondFourDigits").value;

    var invalidMessages = "";

    /* validate phone number values */
    if (phone1.length !== 3 || isNaN(phone1) || phone2.length !== 3 || isNaN(phone2) ||
        phone3.length !== 4 || isNaN(phone3)) {
        invalidMessages += "Invalid phone number.\n";

    }

    /* validate selected condition(s) */
    if (!highBP.checked && !diabetes.checked && !glaucoma.checked &&
        !asthma.checked && !none.checked) {
        invalidMessages += "No conditions selected.\n";
    }

    if ((highBP.checked || diabetes.checked || glaucoma.checked ||
            asthma.checked) && none.checked) {
        invalidMessages += "Invalid conditions selection.\n";
    }

    /* validate selected time period */
    var period = document.getElementsByName("period");
    var x, periodFound=false;

    for (x = 0; x < period.length; x++) {
        if (period[x].checked) {
            periodFound = true;
        }
    }

    if (!periodFound) {
        invalidMessages += "No time period selected.\n";
    }

    /* validate assigned study id */
    if (id1.length != 4 || id1.charAt(0) != 'A' || isNaN(id1.substring(1)) ||
        id2.length != 4 || id2.charAt(0) != 'B' || isNaN(id2.substring(1))) {
        invalidMessages += "Invalid study id.\n";
    }

    /* display error messages or submit data */
    if (invalidMessages !== "") {
        alert(invalidMessages);
        return false;
    }
    else {
        var submitMessage = "Do you want to submit the form data?\n";
        window.confirm(submitMessage);
    }
}