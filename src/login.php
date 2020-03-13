<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@v4.0.0/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@v4.0.0/dist/material-components-web.min.js"></script>
  </head>
  <body>
    <header>
      <i class="material-icons">menu_book</i>
      <h1>Bookstore</h1>
    </header>
    <form action="home.html">
      <div class="mdc-text-field text-field">
        <input type="email" class="mdc-text-field__input" id="email-input" name="email" required>
        <label class="mdc-floating-label" for="email-input">Email</label>
        <div class="mdc-line-ripple"></div>
      </div>
      <div class="mdc-text-field text-field">
        <input type="password" class="mdc-text-field__input" id="password-input" name="password" required minlength="8">
        <label class="mdc-floating-label" for="password-input">Password</label>
        <div class="mdc-line-ripple"></div>
      </div>
      <div class="button-container">
        <button type="button" class="mdc-button">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">
            Register
          </span>
        </button>
        <button class="mdc-button mdc-button--raised">
          <div class="mdc-button__ripple"></div>
          <span class="mdc-button__label">
            Login
          </span>
        </button>
      </div>
      <script>
        document.querySelectorAll(".text-field").forEach(e => new mdc.textField.MDCTextField(e));
        document.querySelectorAll("button").forEach(e => new mdc.ripple.MDCRipple(e));
      </script>
    </form>
  </body>
</html>
