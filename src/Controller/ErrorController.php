<?php
declare(strict_types=1);


namespace Mezzio\Mvc\Controller;


use Mezzio\Mvc\Exception\NotFoundException;
use Mezzio\Mvc\Helper\ValidationHelper;

class ErrorController extends AbstractController
{
    public function init()
    {

    }

    public function end()
    {

    }

    protected function initView()
    {
        // TODO: Implement initView() method.
    }

    protected function initModel()
    {
        // TODO: Implement initModel() method.
    }

    protected function handleSubmitSecurity(): bool
    {
        return false;
    }

    protected function handleValidationError(ValidationHelper $validationHelper)
    {
        // TODO: Implement handleValidationError() method.
    }


    /**
     * @param \Throwable $exception
     * @return mixed|void
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function error(\Throwable $exception)
    {
        if ($exception instanceof NotFoundException) {
            $this->getControllerResponse()->setStatusCode(ControllerResponse::STATUS_NOT_FOUND);
        }
        $errorString = htmlspecialchars($exception->__toString());
        $body = "<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\"/>
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"/>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\"/>
    <title>Error</title>
    <link rel=\"shortcut icon\" href=\"favicon.ico\"/>
    <link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css\"/>
    <link href=\"https://use.fontawesome.com/releases/v5.13.0/css/all.css\" rel=\"stylesheet\"/>
    <style>
        body {
            padding-top: 70px;
        }

        .app {
            min-height: 100vh;
        }

    </style>
</head>
<body class=\"app\">

<h1 class=\"text-center mx-auto\">Error</h1>
<h2 class=\"text-center mx-auto\">{$exception->getMessage()}</h2>

<div class=\"app-content\">
    <main class=\"container\">
    <pre><code>{$errorString}</code></pre>
    </main>
</div>
</body>
</html>";
        $this->getControllerResponse()->setBody($body);
        $error =  [
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'trace' => $exception->getTrace(),
        ];
        $this->getControllerResponse()->setAttribute('error', $error);
    }


}
