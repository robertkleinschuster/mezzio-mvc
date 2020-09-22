<?php

namespace Mezzio\Mvc\Factory;

use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Mvc\Controller\ControllerResponse;
use Mezzio\Mvc\Exception\MvcException;

class ServerResponseFactory
{
    /**
     * @param ControllerResponse $controllerResponse
     * @return HtmlResponse|JsonResponse
     * @throws MvcException
     */
    public function __invoke(ControllerResponse $controllerResponse)
    {
        switch ($controllerResponse->getMode()) {
            case ControllerResponse::MODE_HTML:
                return new HtmlResponse(
                    $controllerResponse->getBody(),
                    $controllerResponse->getStatusCode(),
                    $controllerResponse->getHeaders()
                );
            case ControllerResponse::MODE_JSON:
                $data = [
                    'html' => $controllerResponse->getBody(),
                    'attributes' => $controllerResponse->getAttributes(),
                    'inject' => $controllerResponse->getInjector()->toArray()
                ];
                return new JsonResponse($data, $controllerResponse->getStatusCode(), $controllerResponse->getHeaders());
        }
        throw new MvcException('Invalid Mode set in ControlerResponse.');
    }
}
