<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Items;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

final class SetItemOwnerEventSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly EntityManagerInterface $entityManager, private readonly TokenStorageInterface $tokenStorage)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setItemOwner', EventPriorities::PRE_WRITE],
        ];
    }

    public function setItemOwner(ViewEvent $event): void
    {
        $item = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$item instanceof Items || Request::METHOD_POST !== $method) {
            return;
        }

        $user = $this->tokenStorage->getToken()->getUser();
        $item->setItemOwner($user);
        // $this->entityManager->flush();
        $this->entityManager->persist($item);
        $this->entityManager->flush();
    }
}