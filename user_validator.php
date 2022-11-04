<?php

// creates a class to handle user validation
class UserValidator
{
    // POST form data (will be gathered from $post_data array)
    private $data;
    // errors
    private $errors = [];
    // required fields, validates from this class itself
    private static $fields = ['username', 'email'];

    // takes in POST form data (formValidation.php) as an array
    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        // checks if any field doesn't exist as a key in the $data array
        foreach (self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field is not present in data");
                return;
            }
        }
        $this->validateUsername();
        $this->validateEmail();
        return $this->errors;
    }

    // adds errors if username validation fails
    private function validateUsername()
    {
        // trims whitespace from username
        $val = trim($this->data['username']);
        // checks if field is empty
        if (empty($val)) {
            $this->addError('username', 'username cannot be empty');
        } else {
            // checks if field doesn't match regex
            if (!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)) {
                $this->addError('username', 'username must be 6-12 alphanumeric chars');
            }
        }
    }

    private function validateEmail()
    {
        // trims whitespace from email
        $val = trim($this->data['email']);
        // checks if field is empty
        if (empty($val)) {
            $this->addError('email', 'email cannot be empty');
        } else {
            // checks if field doesn't pass email filter
            if (!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'invalid email address');
            }
        }
    }

    // adds any errors from above functions to $errors array 
    private function addError($key, $val)
    {
        $this->errors[$key] = $val;
    }
} // end UserValidator