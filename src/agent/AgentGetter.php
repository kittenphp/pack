<?php


namespace kitten\pack\agent;


use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Request;

class AgentGetter
{
    protected $request;
    public function __construct(Request $request)
    {
        $this->request=$request;
    }

    /**
     * @return AgentInfo
     */
    public function detectInfo(){
        $request=$this->request;
        $agentString=$request->headers->get('User-Agent');
        $httpHead=$request->headers->all();
        $agent=new Agent();
        $agent->setUserAgent($agentString);
        $agent->setHttpHeaders($httpHead);
        $info=new AgentInfo();
        $info->setIp($request->getClientIp());
        $browser=$agent->browser();
        $info->setBrowserName($browser);
        $info->setBrowserVersion($agent->version($browser));
        $platform = $agent->platform();
        $info->setPlatformName($platform);
        $info->setPlatformVersion($agent->version($platform));
        $info->setIsDesktop($agent->isDesktop());
        $info->setIsMobile($agent->isMobile());
        $isRobot=$agent->isRobot();
        $info->setIsRobot($isRobot);
        if ($isRobot){
            $info->setRobotName($agent->robot());
        }
        return $info;
    }

}