<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Attribute\Route;

#[AsController]
final readonly class ReproducerController
{
    #[Route('/reproducer', name: 'app_reproducer')]
    #[Cache(maxage: 30, public: true)]
    public function __invoke(EventRepository $eventRepository): Response
    {
        $events = $eventRepository->findBy(['active' => true]);

        if (count($events) === 0) {
            return new Response('<span>No events</span>');
        }

        $responseHtml = array_map(
            fn (Event $event) => '<a href="/'.$event->url.'">'.$event->name.'</a>',
            $events
        );

        return new Response('<div>'.implode('<br>', $responseHtml).'</div>');
    }
}
