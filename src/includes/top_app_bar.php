<header class="mdc-top-app-bar mdc-top-app-bar--fixed">
  <div class="mdc-top-app-bar__row">
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <span class="mdc-top-app-bar__title"><?php echo $PAGE_TITLE ?? 'Bookstore'; ?></span>
    </section>
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
      <a href="home.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Home">home</a>
      <?php if (isset($_SESSION['user'])) { ?>
        <?php if ($_SESSION['user']->isAdmin()) { ?>
        <a href="administration.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Administration">assessment</a>
        <?php } else { ?>
        <a href="profile.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Profile">library_books</a>
        <a href="checkout.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Checkout">shopping_cart</a>
        <?php } ?>
      <a href="logout.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Logout">exit_to_app</a>
      <?php } else { ?>
      <a href="login.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Login">account_circle</a>
      <?php } ?>
    </section>
  </div>
</header>

