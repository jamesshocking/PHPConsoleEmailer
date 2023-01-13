<?php

class Mail2RUController extends BaseController
{
    /**
     * /pageevent/list - get a list of all page events
     */
    public function emailAction()
    {
        // get the list of recipients from the mail2ru server
        print("Getting recipients from mail2ru\n");
        $mail2ruWebSiteModel = new Mail2RUWebModel();
        $newRecipients = $mail2ruWebSiteModel->getEmailAddresses('https://mail2ru.org');

        // update the database of available recipients
        print("Save the recipients to the database\n");
        $mail2ruModel = new Mail2RUModel();
        $mail2ruModel->saveNewEmailAddresses($newRecipients);

        // get the content of the email to send
        print("Get the email message content\n");
        $contentModel = new ContentModel();
        $emailContent = $contentModel->getEmailContents();

        // select the email recipients from the database
        print("Getting 300 recipients to email from our database\n");
        $emailReceipientsToSend = $mail2ruModel->getEmailRecipients();

        // send the email
        print("Sending email\n");
        $emailModel = new EmailModel();
        $emailModel->sendEmail($emailContent, $emailReceipientsToSend);

        // update the sent email recipients list to avoid sending emails to the same address more than once
        print("Saving whom we have emailed to the database\n");
        $mail2ruModel->saveSentEmailAddresses($emailReceipientsToSend);
    }
}


?>