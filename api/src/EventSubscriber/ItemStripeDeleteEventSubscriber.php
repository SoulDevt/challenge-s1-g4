<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Items;
use Stripe\StripeClient;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ItemStripeDeleteEventSubscriber implements EventSubscriberInterface {
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['deleteStripeProduct', EventPriorities::POST_WRITE],
        ];
    }

    public function deleteStripeProduct(ViewEvent $event): void
    {
        $item = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$item instanceof Items || Request::METHOD_DELETE !== $method) {
            return;
        }

        $stripe = new StripeClient($_SERVER['STRIPE_SECRET_KEY']);
        $stripe->products->delete(
            $item->getProductId(),
            []
        );
    }
}