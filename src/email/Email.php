<?php


namespace kitten\pack\email;


use Swift_Message;
use Swift_SmtpTransport;

class Email
{
    private $config;
    private $transport;
    private $swiftEmail;
    public function __construct(EmailConfig $config)
    {
        $this->config=$config;
        // Create the Transport
        $transport=new Swift_SmtpTransport($config->getSmtpServer(), $config->getPort());
        $transport->setUsername($config->getUsername());
        $transport->setPassword($config->getPassword());
        $this->transport=$transport;
        $this->swiftEmail=new \Swift_Mailer($transport);
    }

    /**
     * @param string $sendEmail
     * @param string $title
     * @param string $content
     * @param bool $isHtmlFormat
     * @return bool
     */
    public function send(string $sendEmail,string $title,string $content,bool $isHtmlFormat=true) {
        $config=$this->config;
        $message = new Swift_Message($title);
        if ($isHtmlFormat){
            $message->setContentType('text/html');
        }
        $message->setFrom($config->getFromEmail());
        $message->setTo($sendEmail);
        $message->setBody($content);
        $status= $this->swiftEmail->send($message);
        if ($status>0){
            return true;
        }else{
            return false;
        }
    }
}