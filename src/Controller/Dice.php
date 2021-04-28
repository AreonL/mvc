<?php

declare(strict_types=1);

namespace Mos\Controller;

use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;

/**
 * Controller for the dice route.
 */
class Dice //extends ControllerBase
{
    use ControllerTrait;

    public function __invoke(): ResponseInterface
    {
        $data = [
            "header" => "dice page",
            "message" => "Hello, this is the dice page, rendered as a layout.",
        ];

        $body = renderView("layout/dice.php", $data);

        return $this->response($body);
    }
}
