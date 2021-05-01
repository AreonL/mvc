<?php

namespace Mos\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Guess.
 */
class GuessCreateObjectTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateObjectNoArguments()
    {
        $guess = new Guess();
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties, use only first argument.
     */
    public function testCreateObjectFirstArgument()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 6;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }



    /**
     * Construct object and verify that the object has the expected
     * properties, use both arguments.
     */
    public function testCreateObjectBothArguments()
    {
        $guess = new Guess(42, 7);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->tries();
        $exp = 7;
        $this->assertEquals($exp, $res);

        $res = $guess->number();
        $exp = 42;
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectGuessCorrect()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->makeGuess(42);
        $exp = "correct!!!";
        $this->assertEquals($exp, $res);

        $res = $guess->tries();
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectGuessLow()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->makeGuess(1);
        $exp = "to low...";
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectGuessHigh()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->makeGuess(100);
        $exp = "to high...";
        $this->assertEquals($exp, $res);
    }

    public function testCreateObjectNoGuessesLeft()
    {
        $guess = new Guess(42, 0);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $res = $guess->makeGuess(42);
        $exp = "no guesses left.";
        $this->assertEquals($exp, $res);
    }

    public function testException()
    {
        $guess = new Guess(42);
        $this->assertInstanceOf("\Mos\Guess\Guess", $guess);

        $this->expectException(GuessException::class);

        $res = $guess->makeGuess(200);
    }
}
