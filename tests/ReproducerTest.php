<?php

declare(strict_types=1);

namespace Tests;

use App\Factory\EventFactory;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Foundry\Test\Factories;
use Zenstruck\Foundry\Test\ResetDatabase;

class ReproducerTest extends WebTestCase
{
    use Factories;
    use ResetDatabase;

    public function testActiveEventShown(): void
    {
        EventFactory::new()->active()->many(3)->create();
        self::ensureKernelShutdown();

        $client = static::createClient();
        $client->request('GET', 'http://127.0.0.1/reproducer');

        self::assertResponseIsSuccessful();
        self::assertCount(3, $client->getCrawler()->filter('a'));
    }

    public function testInactiveEventNotShown(): void
    {
        EventFactory::new()->inactive()->many(3)->create();
        self::ensureKernelShutdown();

        $client = static::createClient();
        $client->request('GET', 'http://127.0.0.1/reproducer');

        self::assertResponseIsSuccessful();
        self::assertCount(0, $client->getCrawler()->filter('a'));
        self::assertSelectorTextContains('span', 'No events');
    }
}
