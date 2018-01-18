<?php


namespace kitten\pack\agent;


class AgentInfo
{
    protected $browserName='';
    protected $browserVersion='';
    protected $platformName='';
    protected $platformVersion='';
    protected $ip='';
    protected $isDesktop=false;
    protected $isMobile=false;
    protected $robotName='';

    /**
     * @return bool
     */
    public function isDesktop()
    {
        return $this->isDesktop;
    }

    /**
     * @param bool $isDesktop
     */
    public function setIsDesktop(bool $isDesktop)
    {
        $this->isDesktop = $isDesktop;
    }

    /**
     * @return bool
     */
    public function isMobile()
    {
        return $this->isMobile;
    }

    /**
     * @param bool $isMobile
     */
    public function setIsMobile(bool $isMobile)
    {
        $this->isMobile = $isMobile;
    }

    /**
     * @return string
     */
    public function getRobotName()
    {
        return $this->robotName;
    }

    /**
     * @param string $robotName
     */
    public function setRobotName(string $robotName)
    {
        $this->robotName = $robotName;
    }

    /**
     * @return bool
     */
    public function isRobot()
    {
        return $this->isRobot;
    }

    /**
     * @param bool $isRobot
     */
    public function setIsRobot(bool $isRobot)
    {
        $this->isRobot = $isRobot;
    }
    protected $isRobot=false;


    /**
     * @return string
     */
    public function getBrowserName()
    {
        return $this->browserName;
    }

    /**
     * @param string $browserName
     */
    public function setBrowserName(string $browserName)
    {
        $this->browserName = $browserName;
    }

    /**
     * @return string
     */
    public function getBrowserVersion()
    {
        return $this->browserVersion;
    }

    /**
     * @param string $browserVersion
     */
    public function setBrowserVersion(string $browserVersion)
    {
        $this->browserVersion = $browserVersion;
    }

    /**
     * @return string
     */
    public function getPlatformName()
    {
        return $this->platformName;
    }

    /**
     * @param string $platformName
     */
    public function setPlatformName(string $platformName)
    {
        $this->platformName = $platformName;
    }

    /**
     * @return string
     */
    public function getPlatformVersion()
    {
        return $this->platformVersion;
    }

    /**
     * @param string $platformVersion
     */
    public function setPlatformVersion(string $platformVersion)
    {
        $this->platformVersion = $platformVersion;
    }

    /**
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @param string $ip
     */
    public function setIp(string $ip)
    {
        $this->ip = $ip;
    }
}