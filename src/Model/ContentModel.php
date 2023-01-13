<?php


class ContentModel 
{
    public function getEmailContents()
    {
        $path = PROJECT_ROOT_PATH . "/email_content.html";

        return file_get_contents($path);
    }
}

?>
