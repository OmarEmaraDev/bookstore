<?php
class Order {
  public string $isbn;
  public string $email;
  public bool $ordered;

  function __construct(int $isbn, string $email, bool $ordered) {
    $this->isbn = $isbn;
    $this->email = $email;
    $this->ordered = $ordered;
  }

  public function asArray() : array {
    return (array)$this;
  }

  public function exists() : bool {
    $connection = pg_connect('dbname=bookstore');
    $exists = !empty(pg_select($connection, 'orders', $this->asArray()));
    pg_close($connection);
    return $exists;
  }

  public function submit() : void {
    $connection = pg_connect('dbname=bookstore');
    $result = pg_insert($connection, 'orders', $this->asArray());
    pg_close($connection);
  }
}
?>
