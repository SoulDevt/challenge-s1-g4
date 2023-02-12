<?php

namespace App\EventSubscriber;

use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Items;
use Stripe\StripeClient;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpFoundation\Request;

final class ItemStripeCreationEventSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['createStripeProduct', EventPriorities::POST_WRITE],
        ];
    }

    public function createStripeProduct(ViewEvent $event): void
    {
        $item = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$item instanceof Items || Request::METHOD_POST !== $method) {
            return;
        }

        $stripe = new StripeClient($_ENV['STRIPE_SECRET_TEST_KEY']);
        $stripe->products->create([
            'name' => $item->getTitle(),
            'description' => $item->getDescription(),
            'default_price_data' => [
                'currency' => 'eur',
                'unit_amount' => $item->getPrice() * 100,
            ],
        ]);

    }
}
