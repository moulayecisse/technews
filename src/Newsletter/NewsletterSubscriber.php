<?php
/**
 * Created by PhpStorm.
 * User: Moulaye CISSE
 * Date: 03/07/2018
 * Time: 12:02
 */

namespace App\Newsletter;


use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class NewsletterSubscriber implements EventSubscriberInterface
{
    private $session;

    /**
     * NewsletterSubscriber constructor.
     * @param $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    public static function getSubscribedEvents()
    {
        return
        [
            KernelEvents::REQUEST        => 'onKernelRequest',
            KernelEvents::RESPONSE       => 'onKernelResponse',
        ];
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        if( !$event->isMasterRequest() || $event->getRequest()->isXmlHttpRequest() )
        {
            return;
        }

        $session = new Session();

        $session->set('visits', $session->get('visits', 0) + 1 );
        if( $session->get('visits') === 3 ) $session->set('showModal', true);
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if( !$event->isMasterRequest() || $event->getRequest()->isXmlHttpRequest() )
        {
            return;
        }

        if( $this->session->get('visits') >= 3 ) $this->session->set('showModal', false);
    }
}