<!-- Utility Superclass -->
<!-- By Anna Blendermann -->

/* Utility constructor */
function Utility (utilityName, utilityDescription) {
    this.utilityName = utilityName;
    this.utilityDescription = utilityDescription;
}

/* prototype for the Utility constructor */
Utility.prototype = {
    constructor: Utility, /* Utility is the constructor that creates the prototype */
    info: function () {
        document.writeln("Utility Name: " + this.utilityName);
        document.writeln(", Utility Description: " + this.utilityDescription);
    }
};