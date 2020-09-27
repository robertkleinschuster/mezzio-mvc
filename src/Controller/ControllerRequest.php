<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

use Mezzio\Mvc\Helper\ViewIdHelper;
use Mezzio\Router\RouteResult;
use NiceshopsDev\NiceCore\Attribute\AttributeAwareInterface;
use NiceshopsDev\NiceCore\Attribute\AttributeTrait;
use NiceshopsDev\NiceCore\Exception;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;
use Psr\Http\Message\ServerRequestInterface;

class ControllerRequest implements OptionAwareInterface, AttributeAwareInterface
{
    use OptionTrait;
    use AttributeTrait;


    /**
     * @var ServerRequestInterface
     */
    private $serverRequest;

    /**
     * @var RouteResult
     */
    private $routeResult;

    /**
     * ControllerRequestProperties constructor.
     * @param ServerRequestInterface $serverRequest
     * @throws Exception
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        $this->serverRequest = $serverRequest;
        $this->routeResult = $serverRequest->getAttribute(RouteResult::class);
        // POST Params
        foreach ($serverRequest->getParsedBody() as $key => $value) {
            $this->setAttribute($key, $value);
        }

        // GET Params
        foreach ($serverRequest->getQueryParams() as $key => $value) {
            $this->setAttribute($key, $value);
        }
    }

    /**
     * @return ServerRequestInterface
     */
    public function getServerRequest(): ServerRequestInterface
    {
        return $this->serverRequest;
    }

    /**
     * @return RouteResult
     */
    public function getRouteResult(): RouteResult
    {
        return $this->routeResult;
    }

    /**
     * @return array
     * @throws Exception
     */
    public function getViewIdMap(): array
    {
        $viewId = $this->getAttribute(ViewIdHelper::VIEWID_ATTRIBUTE);
        if (null !== $viewId) {
            return (new ViewIdHelper())->parseViewId(urldecode($viewId));
        } else {
            return [];
        }
    }


}
