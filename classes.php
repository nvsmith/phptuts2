<?php

class User
{
    // properties
    public $username; //  accessible outside class
    protected $email; // inaccessible outside class with getter/setter
    public $role = 'member';

    // methods
    // constructs user info outside class
    public function __construct($username, $email)
    {
        $this->username = $username;
        $this->email = $email;
    }

    public function __destruct()
    {
        echo "the user $this->username was removed <br>";
    }

    public function __clone()
    {
        $this->username = $this->username . '(cloned)<br>';
    }

    public function addFriend()
    {
        return "$this->email added a new friend";
    }

    public function message()
    {
        return "$this->email sent a new message";
    }

    // getters: gets a private property and returns it outside the function 
    public function getEmail()
    {
        return $this->email;
    }

    // setters: sets a private property outside the function
    public function setEmail($email)
    {
        if (strpos($email, '@') > -1) {
            $this->email = $email;
        }
    }
} // end User

// Creates a child class that inherits from User
class AdminUser extends User
{
    public $level;
    public $role = 'admin';

    public function __construct($username, $email, $level)
    {
        $this->level = $level;
        parent::__construct($username, $email);
    }

    public function message()
    {
        return "$this->email, an admin, sent a new message";
    }
}

$userOne = new User('mario', 'mario@example.com');
$userTwo = new User('luigi', 'luigi@example.com');
$userThree = new AdminUser('yoshi', 'yoshi@example.com', 5);

$userFour = clone $userOne;
echo $userFour->username;




// Print class properties and methods
// print_r(get_class_vars('User'));
// print_r(get_class_methods('User'));

?>

<html lang="en">

<head>
    <title>PHP OOP Tutorial</title>
</head>

<body>
</body>

</html>