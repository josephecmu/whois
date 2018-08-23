

function checkPasswordMatch() {
    var password = $("#txtNewPassword").val();
    var confirmPassword = $("#txtConfirmPassword").val();

    if (password != confirmPassword) {
        $("#divCheckPasswordMatch").html("Passwords do not match!");
        return false;
    } else {
        $("#divCheckPasswordMatch").html("Passwords match.");
        return true;
    }

}

$(document).ready(function () {
   
    $("#txtConfirmPassword").keyup(checkPasswordMatch);

    $('#myForm').submit(function(e){ 
       var bool = checkPasswordMatch();
       if(!bool)
        e.preventDefault(); // will stop the form from submitting
       else
        return true; //continue to submit form
    });

});


//function deleteSubObj(className) {

//	$(className).attr('value', 'yes');

//}




