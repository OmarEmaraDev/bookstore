<?php
require_once('model/user.php');
require_once('model/book.php');

session_start();
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  exit;
}

if (!empty($_POST)) {
  if (Book::exists($_POST['isbn'])) {
    header('Location: add.php?invalid' .
      '&title=' . urlencode($_POST['title']) .
      '&description=' . urlencode($_POST['description']) .
      '&isbn=' . urlencode($_POST['isbn']) .
      '&price=' . urlencode($_POST['price']),
      TRUE, 303);
  } else {
    move_uploaded_file($_FILES['book']['tmp_name'],
      $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $_FILES['book']['name']);
    $bookArray = $_POST;
    $bookArray['path'] = $_FILES['book']['name'];
    $bookArray['author'] = $_SESSION['user']->email;
    $book = Book::fromArray($bookArray);
    $book->submit();
    header('Location: home.php');
    exit;
  }
}

$PAGE_TITLE = 'Add Book';
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Add Book - Bookstore</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css" rel="stylesheet">
    <link href="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="css/add.css" rel="stylesheet">
    <script src="https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js"></script>
  </head>
  <body>
    <?php require_once('includes/top_app_bar.php'); ?>
    <div class="mdc-top-app-bar--fixed-adjust">
      <form method="POST" enctype="multipart/form-data">
        <label class="mdc-text-field text-field">
          <div class="mdc-text-field__ripple"></div>
          <input class="mdc-text-field__input" type="text" aria-labelledby="title-input" name="title"
            value="<?php echo $_GET['title'] ?? '' ?>" required>
          <span class="mdc-floating-label" id="title-input">Title</span>
          <div class="mdc-line-ripple"></div>
        </label>
        <label class="mdc-text-field mdc-text-field--textarea text-field">
          <textarea class="mdc-text-field__input" aria-labelledby="description-input" rows="8" cols="40"
            name="description" value="<?php echo $_GET['description'] ?? '' ?>" required></textarea>
          <div class="mdc-notched-outline">
            <div class="mdc-notched-outline__leading"></div>
            <div class="mdc-notched-outline__notch">
              <label class="mdc-floating-label" id="description-input">Description</label>
            </div>
            <div class="mdc-notched-outline__trailing"></div>
          </div>
        </label>
        <label class="mdc-text-field text-field">
          <div class="mdc-text-field__ripple"></div>
          <input class="mdc-text-field__input" type="text" aria-labelledby="isbn-input" name="isbn"
            title="ISBN of the book. Example : 9783161484100."
            value="<?php echo $_GET['isbn'] ?? '' ?>" pattern="[0-9]{13}" required>
          <span class="mdc-floating-label" id="isbn-input">ISBN</span>
          <div class="mdc-line-ripple"></div>
        </label>
        <label class="mdc-text-field text-field">
          <div class="mdc-text-field__ripple"></div>
          <input class="mdc-text-field__input" type="number" aria-labelledby="price-input" name="price"
            value="<?php echo $_GET['price'] ?? '' ?>" pattern="[0-9]+" required>
          <span class="mdc-floating-label" id="price-input">Price</span>
          <div class="mdc-line-ripple"></div>
        </label>
        <label class="mdc-text-field mdc-text-field--no-label text-field">
          <div class="mdc-text-field__ripple"></div>
          <input id="book-selector" class="mdc-text-field__input" type="file" aria-label="book-input"
            name="book" accept="application/pdf" required>
          <div class="mdc-line-ripple"></div>
        </label>
       <div class="button-container">
          <button class="mdc-button mdc-button--raised">
            <div class="mdc-button__ripple"></div>
            <span class="mdc-button__label">
              Submit
            </span>
          </button>
        </div>
        <?php if (isset($_GET["invalid"])) { ?>
        <h6 class="mdc-typography mdc-typography--overline error">This book already exists.</h6>
        <?php } ?>
      </form>
    </div>
    <script>
      document.querySelectorAll("button").forEach(e => new mdc.ripple.MDCRipple(e).unbounded = true);
      document.querySelectorAll(".text-field").forEach(e => new mdc.textField.MDCTextField(e));
      new mdc.topAppBar.MDCTopAppBar(document.querySelector(".mdc-top-app-bar"))
    </script>
  </body>
</html>
