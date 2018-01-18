<?php


namespace kitten\pack\email;


class EmailConfig
{
    private $smtpServer='';
    private $port=25;
    private $username='';
    private $password='';
    private $fromEmail='';
    private $formName='';

    /**
     * EmailConfig constructor.
     * @param string $smtpServer
     * @param string $username
     * @param string $password
     * @param string $fromEmail
     * @param string $fromName
     * @param int $port
     */
    public function __construct(string $smtpServer,string $username,string $password,string $fromEmail,string $fromName,int $port=25)
    {
        $this->smtpServer=$smtpServer;
        $this->username=$username;
        $this->password=$password;
        $this->port=$port;
        $this->formName=$fromName;
        $this->fromEmail=$fromEmail;
    }

    /**
     * @return string
     */
    public function getSmtpServer()
    {
        return $this->smtpServer;
    }

    /**
     * @return int
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * @return string
     */
    public function getFormName()
    {
        return $this->formName;
    }
}