<?php

class Person {
    public $name;
    public $emailed;

    function __construct($name, $emailed = FALSE){
        $this->name = $name;
        $this->emailed = $emailed;
    }

    public function sayHello(){
        return "Hello " . $this->name;
    }
}

//$dictionary = array("a@a.com" => False, "b" => False, "c" => False);


function base64url_encode($data) {
    return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
}

function generateId(){
    $length = 15;
    return base64url_encode(openssl_random_pseudo_bytes(3 * ($length >> 2)));
}


$c = array(generateId() => new Person("Charlie"), generateId() => new Person("james", TRUE));
//$c[1]->emailed = FALSE;


$json = json_encode($c);

file_put_contents("addresses.json", $json);


$s = file_get_contents("addresses.json");

$object = json_decode($s);

var_dump($object);

/*
foreach($object as $key => $value){
    $a = (object)$value;
    echo $a->name . "\n";
}
*/

//$item = (fn($item):Person=>$item)($object[0]);

//echo $item->sayHello() . "\n";


echo "\n" . md5("james.hocking@gastecka.com") . "\n";

?>
