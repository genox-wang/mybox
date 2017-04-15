<?php
 
class user {
    private $name="anonymous";
    private $email="anonymous@nonexists.com";
 
    public function set_email($email) {
        $this->email=$email;
    }
    public function set_name($name) {
        $this->name=$name;
    }
    public function introduce() {
        echo "My name is $this->name and my email address is $this->email.\n";
    }
 
}