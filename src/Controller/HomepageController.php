<?php
declare(strict_types=1);

namespace MonsieurBiz\SyliusHomepagePlugin\Controller;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomepageController extends ResourceController
{
    public function createAction(Request $request): Response
    {
        try {
            return parent::createAction($request);
        } catch (UniqueConstraintViolationException $exception) {
            $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
            $this->flashHelper->addErrorFlash($configuration, 'monsieurbiz_homepage.unique_channel');
            return $this->redirectHandler->redirectToReferer($configuration);
        }
    }

    public function updateAction(Request $request): Response
    {
        try {
            return parent::updateAction($request);
        } catch (UniqueConstraintViolationException $exception) {
            $configuration = $this->requestConfigurationFactory->create($this->metadata, $request);
            $this->flashHelper->addErrorFlash($configuration, 'monsieurbiz_homepage.unique_channel');
            return $this->redirectHandler->redirectToReferer($configuration);
        }
    }
}
