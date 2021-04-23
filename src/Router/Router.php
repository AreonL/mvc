<?php

declare(strict_types=1);

namespace Mos\Router;
// namespace AreonL\Dice;

use function Mos\Functions\{
    destroySession,
    redirectTo,
    renderView,
    renderTwigView,
    sendResponse,
    url
};

use AreonL\Dice\Game;

/**
 * Class Router.
 */
class Router
{
    public static function dispatch(string $method, string $path): void
    {
        if ($method === "GET" && $path === "/") {
            $data = [
                "header" => "Index page",
                "message" => "Hello, this is the index page, rendered as a layout.",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session") {
            $body = renderView("layout/session.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/session/destroy") {
            destroySession();
            redirectTo(url("/session"));
            return;
        } else if ($method === "GET" && $path === "/debug") {
            $body = renderView("layout/debug.php");
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/twig") {
            $data = [
                "header" => "Twig page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderTwigView("index.html", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/some/where") {
            $data = [
                "header" => "Rainbow page",
                "message" => "Hey, edit this to do it youreself!",
            ];
            $body = renderView("layout/page.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "GET" && $path === "/form/view") {
            $data = [
                "header" => "Form",
                "message" => "Press submit to send the message to the result page.",
                "action" => url("/form/process"),
                "output" => $_SESSION["output"] ?? null,
            ];
            $body = renderView("layout/form.php", $data);
            sendResponse($body);
            return;
        } else if ($method === "POST" && $path === "/form/process") {
            $_SESSION["output"] = $_POST["content"] ?? null;
            redirectTo(url("/form/view"));
            return;
        } else if ($method === "GET" && $path === "/dice") {
            $output = $_SESSION["output"] ?? null;
            $dices = $_SESSION["dices"] ?? null;
            $redo = $_SESSION["redo"] ?? null;
            $reset = $_SESSION["reset"] ?? null;

            $callable = new Game();

            if ($reset) :
                $callable->setUp();
            elseif ($redo) :
                $callable->redo();
            elseif ($output == "end") :
                // end
                $callable->end();
            elseif ($dices !== null) :
                $callable->playGame();
            elseif ($redo == null) :
                $callable->setUp();
            endif;

            return;
        } else if ($method === "POST" && $path === "/dice") {
            $_SESSION["redo"] = $_POST["redo"] ?? null;
            $_SESSION["reset"] = $_POST["reset"] ?? null;
            if ($_POST["content"] == "roll" or $_POST["content"] == "end") :
                $_SESSION["output"] = $_POST["content"] ?? null;
            endif;
            if (!$_SESSION["dices"] or ($_SESSION["dices"] !== $_POST["dices"] and $_POST["dices"] !== null)) :
                $_SESSION["dices"] = $_POST["dices"] ?? null;
            endif;
            redirectTo(url("/dice"));
            return;
        }

        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];
        $body = renderView("layout/page.php", $data);
        sendResponse($body, 404);
    }
}
