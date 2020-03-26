<?php
require_once('model/user.php');
require_once('model/order.php');
require_once('model/book.php');

session_start();

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  if (isset($_GET['checkout_ISBN'])) {
    $isbn = str_replace('-', '', $_GET['checkout_ISBN']);
    if (is_numeric($isbn) && strlen($isbn) == 13) {
      $order = new Order(Book::fromISBN($isbn), $user, FALSE);
      if (!$order->exists()) {
        $order->submit();
      }
    }
  }
}
$PAGE_TITLE = 'Home';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Home - Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/home.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  </head>
  <body>
    <?php require_once('includes/top_app_bar.php'); ?>
    <div class="mdc-top-app-bar--fixed-adjust">
      <div class="card-container">
        <?php foreach(Book::getAllBooks() as $i => $book) { ?>
        <div class="mdc-card card">
          <div class="mdc-card__primary-action card__primary-action" tabindex="0">
            <div class="mdc-card__media mdc-card__media--16-9" style="background-image: url(http://placekitten.com/1280/720?image=<?php echo $i; ?>);"></div>
            <div class="card__primary">
            <h2 class="card__title mdc-typography mdc-typography--headline6"><?php echo $book->title; ?></h2>
              <h3 class="card__subtitle mdc-typography mdc-typography--subtitle2">by <?php echo $book->author->name; ?></h3>
            </div>
            <div class="card__secondary mdc-typography mdc-typography--body2"><?php echo $book->description; ?></div>
          </div>
          <div class="mdc-card__actions">
            <div class="mdc-card__action-buttons">
              <form>
                <button value="<?php echo $book->isbn; ?>" name="checkout_ISBN" class="mdc-button mdc-card__action mdc-card__action--button">
                  <span class="mdc-button__ripple"></span>
                  <i class="material-icons mdc-button__icon" aria-hidden="true">add_shopping_cart</i>
                  <span class="mdc-button__label">Add To Cart</span>
                </button>
              </form>
            </div>
          </div>
        </div>
        <?php } ?>
      </div>
    </div>
    <a href="add.php" class="mdc-fab fab--absolute" aria-label="Add">
      <div class="mdc-fab__ripple"></div>
      <span class="mdc-fab__icon material-icons">add</span>
    </a>
    <script>
      document.querySelectorAll("button").forEach(e => new mdc.ripple.MDCRipple(e).unbounded = true);
      document.querySelectorAll(".mdc-card__primary-action").forEach(e => new mdc.ripple.MDCRipple(e));
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
    </script>
  </body>
</html>
