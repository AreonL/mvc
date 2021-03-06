<?php

declare(strict_types=1);

namespace Mos\Controller;

use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;

/**
 * Controller for the Index route.
 */
class Index //extends ControllerBase
{
    use ControllerTrait;

    public function __invoke(): ResponseInterface
    {
        $data = [
            "header" => "Index page",
            "message" => "Hello, this is the Index page, rendered as a layout.",
        ];

        $body = renderView("layout/page.php", $data);

        return $this->response($body);
    }
}
