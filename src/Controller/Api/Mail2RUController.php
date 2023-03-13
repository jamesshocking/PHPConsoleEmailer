<?php

class Mail2RUController extends BaseController
{
    // max recipient list size
    const RECIPIENT_SIZE = 200;

        /**
     * /pageevent/list - get a list of all page events
     */
    public function emailAction()
    {
        // do we have email recipients that we haven't already emailed?
        $mail2ruModel = new Mail2RUModel();
        $addresses = $mail2ruModel->getEmailRecipients(self::RECIPIENT_SIZE);

        // no addresses? - get another collection of addresses
        if (count($addresses) < self::RECIPIENT_SIZE) {
            // update the list
            // get the list of recipients from the mail2ru server
            print("Getting recipients from mail2ru\n");
            $mail2ruWebSiteModel = new Mail2RUWebModel();
            $newRecipients = $mail2ruWebSiteModel->getEmailAddresses('https://mail2ru.org');

            // insert the new recipients into the list
            $mail2ruModel->saveNewEmailAddresses($newRecipients);

            // get the receipient to email list
            $addresses = $mail2ruModel->getEmailRecipients(self::RECIPIENT_SIZE);
        }

        // get the content of the email to send
        print("Get the email message content\n");
        $contentModel = new ContentModel();
        $emailContent = $contentModel->getEmailContents();

        // send the email
        print("Sending email\n");
        $emailModel = new EmailHandlerModel();
        $emailModel->sendEmail($emailContent, $addresses);

        // update the sent email recipients list to avoid sending emails to the same address more than once
        print("Saving whom we have emailed to the database\n");
        $mail2ruModel->saveSentEmailAddresses($addresses);
    }
}


?>