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

  public static function getAllUsers(){
    $connection = pg_connect( 'dbname=bookstore' );
    $query = 'SELECT * FROM users';
    $result = pg_query($connection, $query);
    $result = pg_fetch_all( $result );
    pg_close($connection);
    $array = array();
    foreach( $result as $value ){
      $array[] = User::fromArray( $value );
    }
    return $array;
  }
}
?>
