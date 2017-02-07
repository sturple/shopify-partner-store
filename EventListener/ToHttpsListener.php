<?php

namespace Fgms\PartnerStoreBundle\EventListener;

class ToHttpsListener
{
    private $router;

    public function __construct(\Symfony\Component\Routing\RouterInterface $router)
    {
        $this->router = $router;    
    }

    public function onKernelController(\Symfony\Component\HttpKernel\Event\FilterControllerEvent $event)
    {
        $this->router->getContext()->setScheme('https');
    }
}
