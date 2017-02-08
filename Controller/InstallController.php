<?php

namespace Fgms\PartnerStoreBundle\Controller;

class InstallController extends BaseController
{
    private function check(\Symfony\Component\HttpFoundation\Request $request)
    {
        $name = $this->getStoreNameFromRequestRaw($request);
        $repo = $this->getStoreRepository();
        if ($repo->findOneByName($name)) throw $this->createBadRequestException('Already installed');
    }

    public function installAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->check($request);
        $addr = $this->getStoreAddressFromRequestRaw($request);
        $router = $this->getRouter();
        $return_url = $router->generate('fgms_partner_store_auth',[],\Symfony\Component\Routing\Generator\UrlGeneratorInterface::ABSOLUTE_URL);
        $install_url = sprintf(
            'https://%s/admin/oauth/authorize?client_id=%s&scope=%s&redirect_uri=%s',
            $addr,
            rawurlencode($this->getApiKey()),
            rawurlencode($this->getScope()),
            rawurlencode($return_url)
        );
        return $this->redirect($install_url);
    }

    public function authAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->check($request);
        $name = $this->getStoreNameFromRequest($request);
        $code = $request->query->get('code');
        if (!is_string($code)) throw $this->createBadRequestException('"code" missing or not string in query string');
        $store = new \Fgms\PartnerStoreBundle\Entity\Store();
        $store->setName($name);
        $shopify = $this->getShopify($store);
        $token = $shopify->getToken($code);
        $store->setAccessToken($token->getString('access_token'));
        $em = $this->getEntityManager();
        $em->persist($store);
        $em->flush();
        return $this->redirectToRoute('fgms_partner_store_homepage');
    }
}
