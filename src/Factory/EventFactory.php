<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Event;
use Zenstruck\Foundry\Persistence\PersistentObjectFactory;

/**
 * @extends PersistentObjectFactory<Event>
 */
final class EventFactory extends PersistentObjectFactory
{
    #[\Override]
    public static function class(): string
    {
        return Event::class;
    }

    public function active(): self
    {
        return $this->with(['active' => true]);
    }

    public function inactive(): self
    {
        return $this->with(['active' => false]);
    }

    #[\Override]
    protected function defaults(): array|callable
    {
        return [
            'active' => self::faker()->boolean(),
            'name' => self::faker()->text(255),
            'url' => self::faker()->url(),
        ];
    }
}
