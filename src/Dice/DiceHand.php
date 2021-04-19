<?php

declare(strict_types=1);

namespace AreonL\Dice;

/**
 * Class DiceHand.
 */
class DiceHand
{
    private array $dices;
    private int $numberDices = 0;
    private int $sum;
    private string $text;

    public function addDice(DiceInterface $dice)
    {
        $this->numberDices++;
        $this->dices[] = $dice;
    }

    public function roll(): void
    {
        $this->sum = 0;
        $this->text = "";
        for ($i = 0; $i < $this->numberDices; $i++) {
            $this->sum += $this->dices[$i]->roll();
            $this->text .= $this->dices[$i]->getLastRoll() . ", ";
        }
    }

    public function getHand(): string
    {
        $res = "";
        $result = "";

        for ($i = 0; $i < $this->numberDices; $i++) {
            $res .= $this->dices[$i]->getLastRoll() . ", ";
            $result .= $this->dices[$i]->asString() . " ";
        }
        $res = substr($res, 0, -2);
        $result .= "<br>" . $res . " = " . $this->sum;
        return $result;
    }

    public function getComputer(): string
    {
        return $this->text;
    }

    public function getSum(): int
    {
        return $this->sum;
    }
}
