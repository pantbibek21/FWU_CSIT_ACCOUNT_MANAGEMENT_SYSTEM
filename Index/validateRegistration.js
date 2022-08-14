//code for executing validation for registration form in the client side itself
function validate() {
    //getting the form controls 
    let userName = document.forms['registrationForm']['name'];
    let address = document.forms['registrationForm']['address'];
    let phoneNumber = document.forms['registrationForm']['phoneNumber'];
    let semester = document.forms['registrationForm']['semester'];
    let joinYear = document.forms['registrationForm']['rollNo'];
    let password = document.forms['registrationForm']['password'];
    let cpassword = document.forms['registrationForm']['cpassword'];
    let userType = document.forms['registrationForm']['userType'];
    let errorMsg = document.getElementById("errorMsg");
    //setting the error message to be initially empty 
    errorMsg.innerHTML = "";
    errorMsg.style.cssText = "display: block;";

    //trying different validation for different form field
    if (userName.value == "" || userName.value == " ") {
        errorMsg.innerHTML = "Name cannot be empty !";
        return false;
    }
    if (address.value == "" || userName.value == " ") {
        errorMsg.innerHTML = "Address cannot be empty !";
        return false;
    }
    if (phoneNumber.value == "" || phoneNumber == " ") {
        errorMsg.innerHTML = "PhoneNumber cannot be empty";
        return false;
    }
    if (phoneNumber.value.length != 10) {
        errorMsg.innerHTML = "Number invalid, enter 10 digits !";
        return false;
    }
    if (semester.value == "" && userType.value == "student") {
        errorMsg.innerHTML = "Select semester";
        return false;
    }
    if(userType == "student"){
        if (joinYear.value == "" || joinYear.value == " ") {
            errorMsg.innerHTML = "Enter the join Year ! ";
            return false;
        }
    }
    
    if (password.value.length < 6) {
        errorMsg.innerHTML = "Password cannot be less than 6 characters";
        return false;
    }
    if (password.value != cpassword.value) {
        errorMsg.innerHTML = "Password does not match!";
        return false;
    }
    if (userType.value == "") {
        errorMsg.innerHTML = "Select the type of user";
        return false;
    }
    if (userType.value != "student") {
        if (semester.value != "") {
            errorMsg.innerHTML = "You cannot select semester. Unselect semester !";
            return false;
        }
    }
    //only when this function returns true, then only action link of form will be directed
    return true;

}
//function for hiding the error message
function clearErrorMsg() {
    let errorMsg = document.getElementById("errorMsg");
    errorMsg.style.cssText = "display: none;";
}