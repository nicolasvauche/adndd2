<?php

namespace App\Service;

use App\Repository\OrganizationRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;

class OrganizationService
    extends AbstractExtension
{
    private $organization;

    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->organization = $organizationRepository->find(1);
    }

    public function getTelephone()
    {
        return $this->organization ? $this->organization->getTelephone() : null;
    }

    public function getAddress1()
    {
        return $this->organization ? $this->organization->getAddress1() : null;
    }

    public function getAddress2()
    {
        return $this->organization ? $this->organization->getAddress2() : null;
    }

    public function getAddress3()
    {
        return $this->organization ? $this->organization->getAddress3() : null;
    }

    public function getZipcode()
    {
        return $this->organization ? $this->organization->getZipcode() : null;
    }

    public function getCountry()
    {
        return $this->organization ? $this->organization->getCountry() : null;
    }

    public function getCity()
    {
        return $this->organization ? $this->organization->getCity() : null;
    }

    public function getHoursWeek()
    {
        return $this->organization ? $this->organization->getHoursWeek() : null;
    }

    public function getHoursWeekend()
    {
        return $this->organization ? $this->organization->getHoursWeekend() : null;
    }

    public function getFacebook()
    {
        return $this->organization ? $this->organization->getFacebook() : null;
    }

    public function getTwitter()
    {
        return $this->organization ? $this->organization->getTwitter() : null;
    }

    public function getInstagram()
    {
        return $this->organization ? $this->organization->getInstagram() : null;
    }

    public function getYoutube()
    {
        return $this->organization ? $this->organization->getYoutube() : null;
    }
}
