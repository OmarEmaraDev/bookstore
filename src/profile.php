<?php
require_once('model/user.php');
require_once('model/order.php');

session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  if ($user->isAdmin()) {
    header('Location: home.php');
    exit;
  }
} else {
  header('Location: login.php');
  exit;
}

$PAGE_TITLE = 'Profile';
?>
<!doctype html>
<html lang="en">
  <head>
    <?php require_once('includes/head.php'); ?>
    <style>
      <?php require_once('includes/css/administration.css'); ?>
    </style>
  </head>
  <body>
    <?php require_once('includes/top_app_bar.php'); ?>
    <div class="mdc-top-app-bar--fixed-adjust">
      <h4 class="mdc-typography--headline4">My Orders:</h4>
      <div class="mdc-data-table table">
        <table class="mdc-data-table__table" aria-label="Orders">
          <thead>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Book</th>
              <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Download</th>
            </tr>
          </thead>
          <tbody class="mdc-data-table__content">
            <?php foreach(Order::getAllOrders($_SESSION['user']) as $order) { ?>
            <tr class="mdc-data-table__row">
              <td class="mdc-data-table__cell"><?php echo $order->book->title;?></td>
              <td class="mdc-data-table__cell">
                <a download href="<?php echo $order->book->getDownloadLink();?>" class="mdc-icon-button material-icons">get_app</a>
            </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
      <h4 class="mdc-typography--headline4">My Sales:</h4>
      <div class="mdc-data-table table">
        <table class="mdc-data-table__table" aria-label="Sales">
          <thead>
            <tr class="mdc-data-table__header-row">
              <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Customer</th>
              <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Book</th>
                <th class="mdc-data-table__header-cell mdc-data-table__header-cell--numeric" role="columnheader" scope="col">Price</th>
            </tr>
          </thead>
          <tbody class="mdc-data-table__content">
            <?php foreach(Order::getAllSales($_SESSION['user']) as $order) { ?>
            <tr class="mdc-data-table__row">
            <td class="mdc-data-table__cell"><?php echo $order->customer->name; ?></td>
            <td class="mdc-data-table__cell"><?php echo $order->book->title; ?></td>
            <td class="mdc-data-table__cell mdc-data-table__cell--numeric"><?php echo $order->book->price; ?>$</td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <script>
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
      new mdc.dataTable.MDCDataTable(document.querySelector('.mdc-data-table'));
    </script>
  </body>
</html>
