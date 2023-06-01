function handleSignupFormSubmit(e) {
  // prevent default browser behaviour
  e.preventDefault();

  const formDataEntries = new FormData(signupForm).entries();
  const { email, password } = Object.fromEntries(formDataEntries);

  // submit email and password to an API

  const passowrdErrorMessage = validatePassword(password);

  if (passowrdErrorMessage) {
    // select the email form field message element
    const passwordErrorMessageElement = document.querySelector(
      ".password .dkh-form-field__messages"
    );
    // show password error message to user
    passwordErrorMessageElement.innerText = passowrdErrorMessage;
  }
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

  return "";
}



