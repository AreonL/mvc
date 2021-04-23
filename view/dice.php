<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

namespace Mos\Router;

use function Mos\Functions\url;

$header = "Game 21";
$action = $action ?? url("/dice");
$message = $message ?? null;
$dices = $dices ?? null;
$diceHand = $diceHand ?? null;
$output = $output ?? null;
$gh = $gh ?? null;
$graphic = $graphic ?? null;

$end = $_SESSION["output"] ?? null;

$pScore = $_SESSION["pScore"] ?? null;
$cScore = $_SESSION["cScore"] ?? null;
$getComputer = $getComputer ?? null;
$computerSum = $computerSum ?? null;

$cWin = $cWin ?? null;
$cLose = $cLose ?? null;
$lose = $lose ?? null;
$win = $win ?? null;
?>

<?php if ($win or $cLose) : ?>
    <!-- Winning -->
    <h1><?= $header ?></h1>
    <h2>You won!</h2>
    <p>You got: <?= $_SESSION["sum"] ?></p>
    <?php if ($cLose) : ?>
        <p>Computer got: <?= $getComputer ?> = <?= $computerSum?></p>
    <?php endif ?>
    <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="redo" value="redo">
            <input type="submit" value="Continue">
        </p>
    </form>
<?php elseif ($lose or $cWin) : ?>
    <!-- Losing -->
    <h1><?= $header ?></h1>
    <h2>You lost</h2>
    <p>You got: <?= $_SESSION["sum"] ?></p>
    <?php if ($cWin) : ?>
        <p>Computer got: <?= $getComputer ?> = <?= $computerSum?></p>
    <?php endif ?>
    <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="redo" value="redo">
            <input type="submit" value="Continue">
        </p>
    </form>
    

<?php elseif (!$dices) : ?>
    <!-- Setup / New pick of dices -->
    <h1><?= $header ?></h1>
    <p><?= $message ?></p>

    <form method="post" action="<?= $action ?>">
        <p>Hur många täningar?</p>
        <p>
            <input type="radio" id="1" name="dices" value="1" checked>
            <label for="1">1</label>
        </p>
        <p>
            <input type="radio" id="2" name="dices" value="2">
            <label for="2">2</label>
        </p>
        <p>
            <input type="submit" value="Play">
        </p>
    </form>

    <?php if ($pScore or $cScore > 0) : ?>
        <p>Player score: <?= $pScore ?></p>
        <p>Computer score: <?= $cScore ?></p>
        <p>Reset score?</p>
        <form method="post" action="<?= $action ?>">
        <p>
            <input type="hidden" name="reset" value="reset">
            <input type="submit" value="Reset">
        </p>
    </form>
    <?php endif; ?>

<?php elseif ($end !== "end") : ?>
    <!-- Playgame -->
<p>Tärningar: <?= $dices ?></p>
<p><?= $dh ?></p>
<p>Player summa: <?= $_SESSION["sum"] ?></p>
<form method="post" action="<?= $action ?>">
    <p>Continue?</p>
    <p>
        <input type="radio" id="roll" name="content" value="roll" checked>
        <label for="roll">Roll!</label>
    </p>
    <p>
        <input type="radio" id="end" name="content" value="end">
        <label for="end">Stop</label>
    </p>
    <p>
        <input type="submit" value="Submit">
    </p>
</form>
<?php else : ?>
    <!-- End turn -->
    <p>End turn</p>
<?php endif; ?>
