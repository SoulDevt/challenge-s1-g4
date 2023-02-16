<?php

// namespace App\EventSubscriber;

// use ApiPlatform\Symfony\EventListener\EventPriorities;
// use App\Entity\AnnoncesPosts;
// use Doctrine\ORM\EntityManagerInterface;
// use Symfony\Component\EventDispatcher\EventSubscriberInterface;
// use Symfony\Component\HttpFoundation\Request;
// use Symfony\Component\HttpKernel\Event\ViewEvent;
// use Symfony\Component\HttpKernel\KernelEvents;
// use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

// final class SetItemOwnerEventSubscriber implements EventSubscriberInterface
// {
//     public function __construct(private readonly EntityManagerInterface $entityManager, private readonly TokenStorageInterface $tokenStorage)
//     {
//     }

//     public static function getSubscribedEvents(): array
//     {
//         return [
//             KernelEvents::VIEW => ['setAuthor', EventPriorities::PRE_WRITE],
//         ];
//     }

//     public function setAuthor(ViewEvent $event): void
//     {
//         $author = $event->getControllerResult();
//         $method = $event->getRequest()->getMethod();

//         if (!$author instanceof AnnoncesPosts || Request::METHOD_POST !== $method) {
//             return;
//         }

//         $user = $this->tokenStorage->getToken()->getUser();
//         $author->setAuthor($user);
//         // $this->entityManager->flush();
//         $this->entityManager->persist($author);
//         $this->entityManager->flush();
//     }
// }