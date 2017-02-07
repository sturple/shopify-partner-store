<?php

namespace Fgms\PartnerStoreBundle\Controller;

class DefaultController extends BaseController
{
    public function homeAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $store = $this->getStoreFromRequest($request);
        //  TODO: Some kind of sorting for the forms?
        $ctx = [
            'api_key' => $this->getApiKey(),    //  TODO: Creating this default context should really be its own method
            'store' => $store
        ];
        return $this->render('FgmsPartnerStoreBundle:Default:index.html.twig',$ctx);
    }

}
