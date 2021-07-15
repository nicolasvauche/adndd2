<?php

namespace App\Service;

use App\Repository\ConfigRepository;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;

class ConfigService
    extends AbstractExtension
{

    private $configRepository;
    private $locale;

    public function __construct(ConfigRepository $configRepository, TranslatorInterface $translator)
    {
        $this->configRepository = $configRepository;
        $defaultLocale = $this->configRepository->findOneByName('app_locale');
        $this->locale = $defaultLocale;
        $translator->setLocale($this->locale);
    }

    public function getAppName()
    {
        return $this->configRepository->findOneByName('app_name');
    }

    public function getAppTitle()
    {
        return $this->configRepository->findOneByName('app_title');
    }

    public function getAppAuthor()
    {
        return $this->configRepository->findOneByName('app_author');
    }

    public function getAppLocale()
    {
        return $this->locale;
    }

    public function getDTLocale()
    {
        switch ($this->locale) {
            case 'en':
                $languageFile = 'English';
                break;
            default:
                $languageFile = 'French';
                break;
        }

        return $languageFile;
    }

    public function getAppVersion()
    {
        return $this->configRepository->findOneByName('app_version');
    }

    public function getAppEmail()
    {
        return $this->configRepository->findOneByName('app_email');
    }
}
