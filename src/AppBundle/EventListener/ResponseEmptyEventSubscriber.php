<?php

namespace AppBundle\EventListener;

use JMS\Serializer\EventDispatcher\EventSubscriberInterface;
use JMS\Serializer\EventDispatcher\ObjectEvent;

/**
 * ResponseEmptyEventSubscriber
 * @author F.Bourbigot
 */
class ResponseEmptyEventSubscriber implements EventSubscriberInterface
{
    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            [
                'event'  => 'serializer.pre_serialize',
                'method' => 'emptyChecker',
            ]
        ];
    }

    /**
     * Upgrade an Object instance of ActioneableInterface To ActionResponse
     * @param ObjectEvent $event
     */
    public function emptyChecker(ObjectEvent $event)
    {
    }
}
