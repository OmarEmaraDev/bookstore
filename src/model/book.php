<?php
require_once('model/user.php');

class Book {
  public string $isb;
  public string $title;
  public string $description;
  public User $author;
  public int $price;

  function __construct(string $isbn, string $title, string $description, User $author, int $price, string $path) {
    $this->isbn = $isbn;
    $this->title = $title;
    $this->description = $description;
    $this->author = $author;
    $this->price = $price;
    $this->path = $path;
  }

  static public function exists(string $isbn) : bool {
    $connection = pg_connect('dbname=bookstore');
    $exists = !empty(pg_select($connection, 'books', array('isbn' => $isbn)));
    pg_close($connection);
    return $exists;
  }

  public static function fromISBN(string $isbn) : Book {
    $connection = pg_connect('dbname=bookstore');
    $result = pg_select($connection, 'books', array('isbn' => $isbn));
    pg_close($connection);
    return Book::fromArray($result[0]);
  }

  public static function fromArray(array $data) : Book {
    return new Book($data['isbn'], $data['title'], $data['description'],
      User::fromEmail($data['author']), $data['price'], $data['path']);
  }

  public function asArray() : array {
    $array = (array)$this;
    $array['author'] = $array['author']->email;
    return $array;
  }

  public function submit() : void {
    $connection = pg_connect('dbname=bookstore');
    $result = pg_insert($connection, 'books', $this->asArray());
    pg_close($connection);
  }

  public static function getAllBooks() : array {
    $connection = pg_connect('dbname=bookstore');
    $query = 'SELECT * FROM books;';
    $result = pg_query($connection, $query);
    $booksArray = pg_fetch_all($result);
    pg_close($connection);
    $books = array();
    foreach($booksArray as $book) {
      $books[] = Book::fromArray($book);
    }
    return $books;
  }

  public function getDownloadLink() : string {
    return $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $this->path;
  }
}
?>
