<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home - Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@v4.0.0/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@v4.0.0/dist/material-components-web.min.js"></script>
  </head>
  <body>
    <header class="mdc-top-app-bar mdc-top-app-bar--fixed">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <button class="mdc-icon-button material-icons mdc-top-app-bar__navigation-icon--unbounded">menu</button>
          <span class="mdc-top-app-bar__title">Bookstore</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
          <button class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Checkout">shopping_cart</button>
        </section>
      </div>
    </header>
    <div class="mdc-top-app-bar--fixed-adjust">
      <div class="card-container">
        <?php for ($i = 0; $i < 16; $i++): ?>
        <div class="mdc-card card">
          <div class="mdc-card__primary-action card__primary-action" tabindex="0">
            <div class="mdc-card__media mdc-card__media--16-9" style="background-image: url(http://placekitten.com/1280/720?image=<?php echo $i ?>);"></div>
            <div class="card__primary">
              <h2 class="card__title mdc-typography mdc-typography--headline6">Kitty Cat</h2>
              <h3 class="card__subtitle mdc-typography mdc-typography--subtitle2">by Professor Cat</h3>
            </div>
            <div class="card__secondary mdc-typography mdc-typography--body2">Kitty cats are cute kittens. Kittens are cute kitty cats.</div>
          </div>
          <div class="mdc-card__actions">
            <div class="mdc-card__action-buttons">
              <button class="mdc-button mdc-card__action mdc-card__action--button">  <span class="mdc-button__ripple"></span>Add To Cart</button>
            </div>
          </div>
        </div>
        <?php endfor; ?>
      </div>
    </div>
    <script>
      document.querySelectorAll("button").forEach(e => new mdc.ripple.MDCRipple(e).unbounded = true);
      document.querySelectorAll(".mdc-card__primary-action").forEach(e => new mdc.ripple.MDCRipple(e));
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
    </script>
  </body>
</html>
