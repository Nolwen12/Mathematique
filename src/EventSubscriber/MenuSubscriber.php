<?php

namespace App\EventSubscriber;

use App\Repository\NiveauRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

class MenuSubscriber implements EventSubscriberInterface
{
    private NiveauRepository $niveauRepository;
    private Environment $twig;

    public function __construct(NiveauRepository $niveauRepository, Environment $twig)
    {
        $this->niveauRepository = $niveauRepository;
        $this->twig = $twig;
    }

    public function onKernelController(ControllerEvent $event): void
    {
        if (!$event->isMainRequest()) {
            return;
        }

        $niveaux = $this->niveauRepository->findAll();

        $this->twig->addGlobal('niveau', $niveaux);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }
}