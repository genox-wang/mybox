<?php
 
require_once "user.class.php";
 
function make_user($name,$email) {
    $u=new user();
    $u->set_name($name);
    $u->set_email($email);
    return $u;
}
 
function dump_user($u) {
    $u->introduce();
}