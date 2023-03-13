<?php

class DataStore {
    /*
    The DataStore creates a JSON file from an array, whose structure is such

    key[email address] = value[RecipientModel]

    //$dictionary = array("a@a.com" => False, "b" => False, "c" => False);




$c = array(12345 => new Person("Charlie"), 56789 => new Person("james", TRUE));
//$c[1]->emailed = FALSE;




$json = json_encode($c);

file_put_contents("addresses.json", $json);


$s = file_get_contents("addresses.json");

$object = json_decode($s);

var_dump($object);

foreach($object as $key => $value){
    $a = (object)$value;
    echo $a->name . "\n";
}

$item = (fn($item):YourClass=>$item)($item);
    */
    public function __construct() {
        // 
    }

    public function insert($addresses = []){
        $json = json_encode($addresses);
        file_put_contents(PROJECT_JSON_DATABASE, $json);        
    }

    public function update($addresses = []){
        $fileDb = $this->select();
        foreach($addresses as $key => $value){
            // update the email addresses of those that we have already emailed
            $value->sent = True;
            $fileDb[$key] = $value;
        }

        $json = json_encode($fileDb);
        file_put_contents(PROJECT_JSON_DATABASE, $json);        
    }

    public function select($limit = 0){
        // read the file from disk and select the first $limit that are not sent
        // assumes deserialization as a RecipientModel class / object
        $addresses = [];

        try {
            $encodedFileContents = file_get_contents(PROJECT_JSON_DATABASE);
            $recipientsList = json_decode($encodedFileContents);
    
            $counter = 0;
            // iterate through the decoded list and select the first $limit that are not sent (I.e. RecipientModel->sent is false)
            foreach($recipientsList as $key => $value){
                if($limit > 0 && $counter == $limit) break;
    
                // create a collection of RecipientModel objects in an dictionary - key is the UniqueId and Value is the object
                // of type RecipientModel
                $person = (object)$value;
                if($person->sent == False) {
                    $addresses[$key] = $person;
                    $counter++;
                }
            }
        }
        catch(Exception $e){
            echo $e->getMessage() . "\n";
        }

        return $addresses;
    }
}

?>