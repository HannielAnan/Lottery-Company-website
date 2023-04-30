window.onload = function() {
  render();
};

function render() {
  window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
  recaptchaVerifier.render();
}

var coderesult;

function phoneAuth() {
  // get the number
  var number = document.getElementById('number').value;
  console.log('number:', number);

  // check if the phone number exists in the database
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    console.log('readyState:', this.readyState);
    console.log('status:', this.status);
    console.log('response:', this.responseText);
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText == "exists") {
        // phone number exists, proceed with phone authentication
        firebase.auth().signInWithPhoneNumber(number, window.recaptchaVerifier)
          .then(function(confirmationResult) {
            window.confirmationResult = confirmationResult;
            window.coderesult = confirmationResult;
            console.log(coderesult);
            coderesult = confirmationResult;
            alert("OTP sent successfully");
          }).catch(function(error) {
            console.error(error);
            alert(error.message);
          });
      } else {
        // phone number does not exist, show error message
        alert("You are not registered.");
      }
    }
  };
  xhttp.open("GET", "check_number.php?number=" + number, true);
  xhttp.send();
}
function codeverify() {
  var code = document.getElementById('verificationCode').value;
  coderesult.confirm(code)
    .then(function(result) {
      // User signed in successfully
      var phone = document.getElementById('number').value;
      
      // make AJAX call to reset password
      $.ajax({
        type: "POST",
        url: "reset_password.php",
        data: { phone: phone },
        success: function(response) {
          if (response === "success") {
            alert("Password reset successful.");
            // redirect to create_new_password.php
            window.location.replace("create_new_password.php");

          } else {
            alert("Password reset failed.");
          }
        },
        error: function() {
          alert("An error occurred while resetting your password.");
        }
      });
    })
    .catch(function(error) {
      // User couldn't sign in (wrong OTP?)
      console.error(error);
      alert(error.message);
    });
}
