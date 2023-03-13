<?php

class RecipientModel {
  public $emailAddress;
  public $sent;
  public $uniqueId;

  function __construct($emailAddress) 
  {
    $this->emailAddress = $emailAddress;
    $this->uniqueId = md5($emailAddress);
    $this->sent = FALSE;
  }

  public function setSent($sent = FALSE){
    $this->sent = $sent;
  }
}

?>