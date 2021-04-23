<?php

// kmom01
declare(strict_types=1);

namespace AreonL\Dice;

use AreonL\Dice\{
    Dice,
    DiceHand,
    DiceGraphic
};

use function Mos\Functions\{
    redirectTo,
    renderView,
    sendResponse,
    url
};

/**
 * Class Game.
 */
class Game
{
    public function setUp(): void
    {
        $data = [
            "header" => "Game 21",
            "message" => "Kör tills du får vill eller 21, över så förlorar du!",
            "output" => $_SESSION["output"] ?? null,
        ];
        $_SESSION["sum"] = (int)0;
        $_SESSION["win"] = null;
        $_SESSION["lose"] = null;
        $_SESSION["pScore"] = 0;
        $_SESSION["cScore"] = 0;
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function playGame(): void
    {
        $data = [
            "dices" => $_SESSION["dices"] ?? null,
        ];
        if (!$_SESSION["win"] and !$_SESSION["lose"]) :
            $diceHand = new DiceHand();
            for ($i = 0; $i < (int)$_SESSION["dices"]; $i++) {
                $diceHand->addDice(new DiceGraphic());
            }
            $diceHand->roll();
            $data["dh"] = $diceHand->getHand();
            $_SESSION["sum"] += (int)$diceHand->getSum();
            // Check player sum after roll
            if ($_SESSION["sum"] == 21) {
                $data = [
                    "win" => "win",
                ];
                $_SESSION["pScore"] += 1;
            } elseif ($_SESSION["sum"] > 21) {
                $data = [
                "lose" => "lose",
                ];
                $_SESSION["cScore"] += 1;
            }
        endif;
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    private bool $noWin;
    private int $sum;
    public function end(): void
    {
        $data = [
            "dices" => $_SESSION["dices"] ?? null,
        ];
        $data["computerSum"] = (int)0;
        $data["getComputer"] = "";
        $this->noWin = true;
        $this->sum = 0;
        while ($this->noWin) :
            $diceHand = new DiceHand();
            for ($i = 0; $i < (int)$_SESSION["dices"]; $i++) {
                $diceHand->addDice(new DiceGraphic());
            }
            $diceHand->roll();
            $data["getComputer"] .= $diceHand->getComputer();
            $this->sum += (int)$diceHand->getSum();
            $data["computerSum"] += (int)$diceHand->getSum();
            if (
                $this->sum == $_SESSION["sum"] or $this->sum == 21
                or ($this->sum > $_SESSION["sum"] and $this->sum < 21)
            ) :
                $data["cWin"] = "cWin";
                $_SESSION["cScore"] += 1;
                $this->noWin = false;
            elseif ($this->sum > 21) :
                $data["cLose"] = "cLose";
                $_SESSION["pScore"] += 1;
                $this->noWin = false;
            endif;
        endwhile;
        $data["getComputer"] = substr($data["getComputer"], 0, -2);
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }

    public function redo(): void
    {
        $data = [
            "header" => "Game 21",
            "message" => "Kör tills du får vill eller 21, över så förlorar du!",
            "output" => $_SESSION["output"] ?? null,
        ];
        $_SESSION["sum"] = (int)0;
        $_SESSION["win"] = null;
        $_SESSION["lose"] = null;
        $_SESSION["redo"] = null;
        $_SESSION["output"] = null;
        $body = renderView("layout/dice.php", $data);
        sendResponse($body);
    }
}
