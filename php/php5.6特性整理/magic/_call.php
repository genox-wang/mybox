<?php

class Member{

    protected $memberdata = array();

    public function __call($func, $arguments){
        list($type, $name) = explode('_', $func);
    
        if(!in_array($type, array('set','get')) || $name==''){
            return '';
        }

        switch($type){
            case 'set':
                $this->memberdata[$name] = $arguments[0];
                break;
            
            case 'get':
                return isset($this->memberdata[$name])? $this->memberdata[$name] : '';
                break;
            
            default:
        }

    }

}


class User extends Member{

    public function show(){
        if($this->memberdata){
            foreach($this->memberdata as $key=>$member){
                echo $key.':'.$member.'<br>';
            }
        }
    }

}


class Profession extends Member{

    public function show(){
        if($this->memberdata){
            foreach($this->memberdata as $key=>$member){
                echo $key.':'.$member.'<br>';
            }
        }
    }

}

$userobj = new User();
$userobj->set_name('fdipzone');
$userobj->set_age(29);
$userobj->show();

$probj = new Profession();
$probj->set_profession('IT SERVICE');
$probj->set_price(2500);
$probj->show();

/*输出
name:fdipzone
age:29
profession:IT SERVICE
price:2500*/

?>