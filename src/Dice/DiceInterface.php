<?php

declare(strict_types=1);

namespace AreonL\Dice;

/**
 * Class DiceInterface.
 */
interface DiceInterface
{
    public function roll(): int;
    public function getLastRoll(): ?int;
    public function asString(): string;
}
