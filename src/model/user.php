 
<?php 
    class user{
        public string $name;
        public string $email;
        public string $password;

        function __construct( string $name, string $email, string $password ){
            $this->name = $name;
            $this->email= $email;
            $this->password = $password;
        }

        public static function fromArray(array $data):user{

            return new user($data['name'], $data['email'], $data['password']);
        }
        public static function fromEmail(string $email) : user{
            $dbconn = pg_connect("dbname=bookstore");
            $result = pg_select($dbconn, 'users', array('email'=>$email));
            pg_close($dbconn);
            return fromArray[$result[0]];
        }
    }

?>