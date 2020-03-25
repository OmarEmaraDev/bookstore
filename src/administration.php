<?php
require_once('model/user.php');
require_once('model/order.php');

session_start();
if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
//  if (!$user->isAdmin) {
//    header('Location: home.php');
//    exit;
//  }
} else {
  header('Location: login.php');
  exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Administration - Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/administration.css" rel="stylesheet">
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
      <div class="administration-container">
        <div class="mdc-data-table table">
          <table class="mdc-data-table__table" aria-label="Users">
            <thead>
              <tr class="mdc-data-table__header-row">
                <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Name</th>
                <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Email</th>
              </tr>
            </thead>
            <tbody class="mdc-data-table__content">
              <?php foreach(User::getAllUsers() as $value){?>
              <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell"><?php echo $value->name;?></td>
                <td class="mdc-data-table__cell"><?php echo $value->email;?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
        <div class="mdc-data-table table">
          <table class="mdc-data-table__table" aria-label="Orders">
            <thead>
              <tr class="mdc-data-table__header-row">
                <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Book</th>
                <th class="mdc-data-table__header-cell" role="columnheader" scope="col">Customer</th>
              </tr>
            </thead>
            <tbody class="mdc-data-table__content">
              <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell">Clean Your Whiskers: A Guide</td>
                <td class="mdc-data-table__cell">Whiskers</td>
              </tr>
              <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell">Raising Kittens: A Story</td>
                <td class="mdc-data-table__cell">Kitty</td>
              </tr>
              <tr class="mdc-data-table__row">
                <td class="mdc-data-table__cell">End Of Humans: A Cat's Dream</td>
                <td class="mdc-data-table__cell">Mistry</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script>
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
      new mdc.dataTable.MDCDataTable(document.querySelector('.mdc-data-table'));
    </script>
  </body>
</html>
