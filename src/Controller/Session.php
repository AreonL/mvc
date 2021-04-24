<?php

declare(strict_types=1);

namespace Mos\Controller;

use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller for the session routes.
 */
class Session //extends ControllerBase
{
    use ControllerTrait;

    public function index(): ResponseInterface
    {
        $data = [
            "header" => "Index page",
            "message" => "Hello, this is the index page, rendered as a layout.",
        ];
        echo "Here";
        $body = renderView("layout/session.php", $data);
        return $this->response($body);
    }

    public function destroy(): ResponseInterface
    {
        destroySession();
        return $this->redirect(url("/session"));
    }
}
