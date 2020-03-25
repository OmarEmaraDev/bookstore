<?php
require_once('model/user.php');
require_once('model/book.php');

class Order {
  public Book $book;
  public User $customer;
  public bool $ordered;

  function __construct(Book $book, User $customer, bool $ordered) {
    $this->book = $book;
    $this->customer = $customer;
    $this->ordered = $ordered;
  }

  public function asArray() : array {
    $array = (array)$this;
    $array['book'] = $this->book->isbn;
    $array['customer'] = $this->customer->email;
    return $array;
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
