<?php
require_once('model/user.php');
require_once('model/order.php');

session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Checkout - Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/checkout.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  </head>
  <body>
    <header class="mdc-top-app-bar mdc-top-app-bar--fixed">
      <div class="mdc-top-app-bar__row">
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
          <button class="mdc-icon-button material-icons mdc-top-app-bar__navigation-icon--unbounded">menu</button>
          <span class="mdc-top-app-bar__title">Bookstore</span>
        </section>
        <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
        <a href="home.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Home">home</a>
        </section>
      </div>
    </header>
    <div class="mdc-top-app-bar--fixed-adjust">
      <div class="checkout-container">
        <div class="mdc-data-table table">
          <table class="mdc-data-table__table" aria-label="Dessert calories">
            <thead>
              <tr class="mdc-data-table__header-row">
                <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Book</th>
                <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric" role="columnheader" scope="col">Price</th>
              </tr>
            </thead>
            <tbody class="mdc-data-table__content">
              <?php $totalPrice = 0; ?>
              <?php foreach(Order::getAllOrdersByCustomer($_SESSION['user'], FALSE) as $order) { ?>
              <tr class="mdc-data-table__row">
              <td class="mdc-data-table__cell"><?php echo $order->book->title; ?></td>
                <td class="mdc-data-table__cell mdc-data-table__cell--numeric"><?php echo $order->book->price; ?>$</td>
              </tr>
              <?php $totalPrice += $order->book->price; ?>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb"></script>
    <script>
      paypal.Buttons({
          createOrder: function(data, actions) {
            return actions.order.create({
              purchase_units: [{
                amount: {
                value: '<?php echo $totalPrice; ?>'
                }
              }]
            });
          },
          onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
              alert('Transaction completed by ' + details.payer.name.given_name);
            });
          }
        }).render('#paypal-button-container');
      document.querySelectorAll("button").forEach(e => new mdc.ripple.MDCRipple(e).unbounded = true);
      document.querySelectorAll(".mdc-card__primary-action").forEach(e => new mdc.ripple.MDCRipple(e));
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
      new mdc.dataTable.MDCDataTable(document.querySelector('.mdc-data-table'));
    </script>
  </body>
</html>
