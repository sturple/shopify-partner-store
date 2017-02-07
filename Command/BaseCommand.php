<?php

namespace Fgms\PartnerStoreBundle\Command;

abstract class BaseCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
{
    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }

    protected function getEntityManager()
    {
        $doctrine = $this->getDoctrine();
        return $doctrine->getEntityManager();
    }
}
