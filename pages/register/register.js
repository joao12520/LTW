/* var form = document.getElementById("registerForm");
function handleForm(event) {
  event.preventDefault();
}

form.addEventListener("submit", handleForm); */

function handleSignupFormSubmit() {
  // prevent default browser behaviour
  const regForm = document.getElementById("registerForm");
  const formDataEntries = new FormData(regForm);
  const { username, password, password2, contact, nif } =
    Object.fromEntries(formDataEntries);

  // submit email and password to an API

  const usernameErrorMessage = validateUserName(username, 8);
  const passwordErrorMessage = validatePassword(password, 10);
  const secondPassWordCheck = validate2ndPassword(password, password2);
  const mobilePhoneErrorMessage = validateMobilePhone(contact);
  const nifErrorMessage = validateNif(nif);

  if (usernameErrorMessage) {
    const usernameErrorMessageElement = document.querySelector(
      ".usernameReg .regErrorMessages"
    );
    // show password error message to user

    usernameErrorMessageElement.innerHTML = usernameErrorMessage;
    return false;
  } else if (passwordErrorMessage) {
    // select the email form field message element
    const passwordErrorMessageElement = document.querySelector(
      ".passwordReg .regErrorMessages"
    );
    // show password error message to user

    passwordErrorMessageElement.innerHTML = passwordErrorMessage;

    return false;
  } else if (secondPassWordCheck) {
    // select the email form field message element
    const password2ErrorMessageElement = document.querySelector(
      ".password2Reg .regErrorMessages"
    );
    password2ErrorMessageElement.innerHTML = secondPassWordCheck;
    return false;
  } else if (mobilePhoneErrorMessage) {
    // select the email form field message element
    const contactoErrorMessageElement = document.querySelector(
      ".contactoReg .regErrorMessages"
    );
    contactoErrorMessageElement.innerHTML = mobilePhoneErrorMessage;
    return false;
  } else if (nifErrorMessage) {
    // select the email form field message element
    const nifErrorMessageElement = document.querySelector(
      ".nifReg .regErrorMessages"
    );
    nifErrorMessageElement.innerHTML = nifErrorMessage;
    return false;
  } else return true;
}

function validateUserName(uname, minlength) {
  if (!uname) return "Username is required";

  if (uname.length < minlength) {
    return `Please enter a username that's at least ${minlength} characters long`;
  }

  const hasCapitalLetter = /[A-Z]/g;
  if (!hasCapitalLetter.test(uname)) {
    return "Please use at least one capital letter.";
  }

  const hasNumber = /\d/g;
  if (!hasNumber.test(uname)) {
    return "Please use at least one number.";
  }

  return "";
}

function validatePassword(password, minlength) {
  if (!password) return "Password is required";

  if (password.length < minlength) {
    return `Please enter a password that's at least ${minlength} characters long`;
  }

  const hasCapitalLetter = /[A-Z]/g;
  if (!hasCapitalLetter.test(password)) {
    return "Please use at least one capital letter.";
  }

  const hasNumber = /\d/g;
  if (!hasNumber.test(password)) {
    return "Please use at least one number.";
  }

  const hasSpecialChar =
    /[\!\@\#\$\%\^\&\*\)\(\+\=\.\<\>\{\}\[\]\:\;\'\"\|\~\`\_\-]/g;
  if (!hasSpecialChar.test(password)) {
    return "Please use atleast one special character.";
  }

  return "";
}

function validate2ndPassword(password, password2) {
  if (password !== password2) return "The passwords you inserted do not match!";

  return "";
}

function validateMobilePhone(phone) {
  const correctPhone = /[9][1236]\d{7}/g;
  if (!correctPhone.test(phone)) {
    return "Invalid phone number!";
  }
  return "";
}

function validateNif(nif) {
  const correctNif = /\d{9}/g;
  if (!correctNif.test(nif)) {
    return "Invalid NIF!";
  }
  return "";
}

document.addEventListener("DOMContentLoaded", function () {
  document
    .querySelector("#registerForm")
    .addEventListener("submit", function (e) {
      e.preventDefault();
      e.stopImmediatePropagation();

      let formTeste = e.target;
      let data = new FormData(formTeste);
      let res;

      if (handleSignupFormSubmit()) {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function () {
          document.getElementById("result").innerText = request.responseText;
        };

        request.open(formTeste.method, formTeste.action);
        request.send(data);

        console.log(request.responseText);

        if (request.responseText == "") {
          alert("Registration was sucessful");
          document.location.href = "../login/index.php";
        }
      }
    });
});
