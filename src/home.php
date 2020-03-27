<?php
require_once('model/user.php');
require_once('model/order.php');
require_once('model/book.php');
require_once('utils/isbn.php');

session_start();

if (isset($_SESSION['user'])) {
  $user = $_SESSION['user'];
  if (isset($_GET['checkout_ISBN'])) {
    $isbn = $_GET['checkout_ISBN'];
    if (isValidISBN13($isbn)) {
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
    <?php require_once('includes/head.php'); ?>
    <style>
      <?php require_once('includes/css/home.css'); ?>
    </style>
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
