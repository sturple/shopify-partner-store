<?php

namespace Fgms\PartnerStoreBundle\Controller;

class DefaultController extends BaseController
{
    private
        $store = null;
    public function homeAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $this->store = $this->getStoreFromRequest();
        $companies = $this->getDoctrine()
            ->getRepository('FgmsPartnerStoreBundle:Company')
            ->findBy(
                array('status'=>'active'),
                array('title'=>'ASC')
            );
        $data = $this->mergeStoreData(
            [
                'companies' => $companies
            ]
        );
        return $this->render('FgmsPartnerStoreBundle:App:index.html.twig',$data);
    }

    // admin partner store edit by id
    public function adminStoreEditAction($id){
        $this->store = $this->getStoreFromRequest();
        $company = $this->getDoctrine()
            ->getRepository('FgmsPartnerStoreBundle:Company')
            ->findOneBy(array('id'=>$id));
        //this means must be creating new.
        if (!$company){
            $company = new \Fgms\PartnerStoreBundle\Entity\Company();
            $company->setCreateDate();
            $company->setStore($this->store);
        }
        $company_form = $this->createForm(\Fgms\PartnerStoreBundle\Form\CompanyType::class , $company);
        $company_form->handleRequest($this->get('request_stack')->getCurrentRequest());

        if ($company_form->isValid()){
            $em = $this->getDoctrine()->getManager();
			$em->persist($company_form->getData());
			$em->flush();
        }

        $data = $this->mergeStoreData(
            [
                'company' => $company,
                'company_form'=>$company_form->createView(),
                'page_content' => [],
                'announcements' => []
            ]
        );
        return $this->render(
            'FgmsPartnerStoreBundle:App:partner-store.html.twig',
            $data
        );
    }

    // displays pages
    public function proxyStoreViewAction($permalink){
        return $this->render(
            'FgmsPartnerStoreBundle:Public:partner-store.html.twig',
            array()
        );
    }

    private function mergeStoreData($array=array()){
        return array_merge($array,[
            'api_key' => $this->getApiKey(),
            'store' => $this->store
        ]);
    }
}
