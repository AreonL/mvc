<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\{
    destroySession,
    renderView,
    url
};

/**
 * Controller showing how to work with forms.
 */
class Form extends ControllerBase
{
    public function view(): ResponseInterface
    {
        $data = [
            "header" => "Form",
            "message" => "Press submit to send the message to the result page.",
            "action" => url("/form/process"),
            "output" => $_SESSION["output"] ?? null,
        ];
        $body = renderView("layout/form.php", $data);

        return $this->response($body);
    }

    public function process(): ResponseInterface
    {
        $_SESSION["output"] = $_POST["content"] ?? null;

        return $this->redirectResponse(url("/form/view"));
    }
}
