<header class="mdc-top-app-bar mdc-top-app-bar--fixed">
  <div class="mdc-top-app-bar__row">
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-start">
      <span class="mdc-top-app-bar__title"><?php echo $PAGE_TITLE ?? 'Bookstore'; ?></span>
    </section>
    <section class="mdc-top-app-bar__section mdc-top-app-bar__section--align-end">
      <a href="home.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Home">home</a>
      <a href="checkout.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Checkout">shopping_cart</a>
      <?php if (isset($_SESSION['user'])) { ?>
      <a href="logout.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Logout">exit_to_app</a>
      <?php } else { ?>
      <a href="login.php" class="mdc-icon-button material-icons mdc-top-app-bar__action-item--unbounded" aria-label="Login">account_circle</a>
      <?php } ?>
    </section>
  </div>
</header>

