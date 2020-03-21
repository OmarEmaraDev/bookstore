<?php
class User {
  public string $name;
  public string $email;
  public string $password;

  function __construct(string $name, string $email, string $password) {
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  static public function exists(string $email) : bool {
    $connection = pg_connect('dbname=bookstore');
    $exists = !empty(pg_select($connection, 'users', array('email' => $email)));
    pg_close($connection);
    return $exists;
  }

  public static function fromEmail(string $email) : User {
    $connection = pg_connect('dbname=bookstore');
    $result = pg_select($connection, 'users', array('email' => $email));
    pg_close($connection);
    return User::fromArray($result[0]);
  }

  public static function fromArray(array $data) : User {
    return new User($data['name'], $data['email'], $data['password']);
  }

  public function asArray() : array {
    return (array)$this;
  }

  public function register() : void {
    $connection = pg_connect('dbname=bookstore');
    $result = pg_insert($connection, 'users', $this->asArray());
    pg_close($connection);
  }

  public function passwordMatch(string $password) : bool {
    return !strcmp($this->password, $password);
  }
}
?>
