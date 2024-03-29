<?php

require_once PROJECT_ROOT_PATH . "Model/DataStore.php";

class Mail2RUModel extends DataStore
{
    public function saveNewEmailAddresses($addresses = []) {
/*
        $sql = "INSERT IGNORE INTO Mail2RUEmailAddresses (Email) VALUES (?)";

        print("Saving new addresses\n");

        foreach($addresses as $email_address) {
            $this->insert($sql, [$email_address], "s");
            print("Email Address:" . $email_address . "\n");
        }
        */
        return $this->insert($addresses);
    }

    public function saveSentEmailAddresses($addresses = []) {
        
        //$sql = "INSERT IGNORE INTO SentEmailAddresses (Email) VALUES (?)";

        foreach($addresses as $email_address => $person) {
            //$this->insert($sql, [$email_address], "s");
            $person->sent = TRUE;
            $addresses[$email_address] = $person;
        }

        return $this->update($addresses);
    }

    public function getEmailRecipients($limit = 300)
    {
        /*$emailAddresses = [];
        $rs = $this->select("SELECT n.email FROM email_addresses n, send_email_addresses s LEFT OUTER JOIN n.email = s.email WHERE s.email IS NULL LIMIT ?", ["i", $limit]);
        var_dump($rs);
        return [];*/
        return $this->select($limit);
    }

}

?>
