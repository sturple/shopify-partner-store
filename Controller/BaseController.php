<?php

namespace Fgms\PartnerStoreBundle\Controller;

abstract class BaseController extends \Symfony\Bundle\FrameworkBundle\Controller\Controller
{

    protected function createBadRequestException($message = 'Bad Request', $previous = null)
    {
        return new \Symfony\Component\HttpKernel\Exception\BadRequestHttpException($message,$previous);
    }

    protected function getTwigEnvironment()
    {
        return $this->container->get('twig');
    }



    protected function getEntityManager()
    {
        $doctrine = $this->getDoctrine();
        return $doctrine->getEntityManager();
    }

    private function getStoreAddressFromSession(\Symfony\Component\HttpFoundation\Request $request)
    {
        $session = $request->getSession();
        $addr = $session->get('shop');
        if (is_null($addr)) throw $this->createBadRequestException('"shop" missing from session');
        if (!is_string($addr)) throw $this->createBadRequestException('"shop" not string in session');
        return $addr;
    }

    private function createShopifyClientFromStoreName($name)
    {
        return new \Fgms\Shopify\Client(
            $this->getApiKey(),
            $this->getSecret(),
            $name
        );
    }

    protected function getStoreAddressFromRequest(\Symfony\Component\HttpFoundation\Request $request)
    {
        $retr = $this->getStoreAddressFromRequestRaw($request,true);
        if (is_null($retr)) return $this->getStoreAddressFromSession($request);
        //  Verify request
        $shopify = $this->createShopifyClientFromStoreName($this->getStoreName($retr));
        if (!$shopify->verify($request)) throw $this->createBadRequestException('Request does not verify');
        $session = $request->getSession();
        $session->set('shop',$this->getStoreName($retr));
        return $retr;
    }

    protected function getStoreName($addr)
    {
        return preg_replace('/\\.myshopify\\.com$/u','',$addr);
    }

    protected function getStoreAddressFromRequestRaw(\Symfony\Component\HttpFoundation\Request $request, $opt = false)
    {
        $retr = $request->query->get('shop');
        if (is_null($retr)) {
            if ($opt) return $retr;
            throw $this->createBadRequestException('"shop" missing in query string');
        }
        if (!is_string($retr)) throw $this->createBadRequestException('"shop" not string in query string');
        return $retr;
    }

    protected function getStoreNameFromRequestRaw(\Symfony\Component\HttpFoundation\Request $request)
    {
        $addr = $this->getStoreAddressFromRequestRaw($request);
        return $this->getStoreName($addr);
    }

    protected function getStoreNameFromRequest(\Symfony\Component\HttpFoundation\Request $request)
    {
        $addr = $this->getStoreAddressFromRequest($request);
        return $this->getStoreName($addr);
    }

    protected function getConfig()
    {
        return $this->container->getParameter('fgms_partner_store.config');
    }

    protected function getScope()
    {
        $scope = $this->getConfig()['scope'];
        return empty($scope) ? 'read_content' : $scope;
    }
    
    protected function getApiKey()
    {
        return $this->getConfig()['api_key'];
    }

    protected function getSecret()
    {
        return $this->getConfig()['secret'];
    }

    protected function getShopify(\Fgms\PartnerStoreBundle\Entity\Store $store)
    {
        $retr = $this->createShopifyClientFromStoreName($store->getName());
        $token = $store->getAccessToken();
        if (!is_null($token)) $retr->setToken($token);
        return $retr;
    }

    protected function getStoreRepository()
    {
        $doctrine = $this->getDoctrine();
        return $doctrine->getRepository(\Fgms\PartnerStoreBundle\Entity\Store::class);
    }

    protected function getStoreFromRequest(\Symfony\Component\HttpFoundation\Request $request)
    {
        $name = $this->getStoreNameFromRequest($request);
        $repo = $this->getStoreRepository();
        $retr = $repo->findOneByName($name);
        if (is_null($retr)) throw $this->createNotFoundException(
            sprintf(
                'No Store entity with name "%s"',
                $name
            )
        );
        return $retr;
    }

    protected function getRouter()
    {
        return $this->container->get('router');
    }

    protected function getSwift()
    {
        return $this->container->get('swiftmailer.mailer');
    }
}
