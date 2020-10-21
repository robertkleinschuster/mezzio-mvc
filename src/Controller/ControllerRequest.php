<?php

declare(strict_types=1);

namespace Mvc\Controller;

use Mezzio\Router\RouteResult;
use Mvc\Helper\ViewIdHelper;
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

    public const ATTRIBUTE_SUBMIT = 'submit';
    public const ATTRIBUTE_REDIRECT = 'redirect';
    public const ATTRIBUTE_NAV_ID = 'navid';
    public const ATTRIBUTE_NAV_INDEX = 'navindex';
    public const ATTRIBUTE_LIMIT = 'limit';
    public const ATTRIBUTE_PAGE = 'page';
    public const ATTRIBUTE_SEARCH = 'search';

    public const SUBMIT_MODE_CREATE = 'create';
    public const SUBMIT_MODE_SAVE = 'save';
    public const SUBMIT_MODE_DELETE = 'delete';

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

        foreach ($serverRequest->getUploadedFiles() as $key => $value) {
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
     * @return bool
     * @throws Exception
     */
    public function hasViewIdMap(): bool
    {
        return $this->hasAttribute(ViewIdHelper::VIEWID_ATTRIBUTE)
            && null != $this->getAttribute(ViewIdHelper::VIEWID_ATTRIBUTE);
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

    /**
     * @return bool
     */
    public function hasRedirect(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_REDIRECT);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getRedirect(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_REDIRECT);
    }

    /**
     * @return bool
     */
    public function hasSubmit(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_SUBMIT);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getSubmit(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_SUBMIT);
    }

    /**
     * @return bool
     */
    public function hasNavId(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_NAV_ID);
    }

    /**
     * @return bool
     */
    public function hasNavIndex(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_NAV_INDEX);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getNavId(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_NAV_ID);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getNavIndex(): int
    {
        return intval($this->getAttribute(self::ATTRIBUTE_NAV_INDEX));
    }

    /**
     * @return bool
     */
    public function hasLimit(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_LIMIT);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getLimit(): int
    {
        return intval($this->getAttribute(self::ATTRIBUTE_LIMIT));
    }

    /**
     * @return bool
     */
    public function hasPage(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_PAGE);
    }

    /**
     * @return int
     * @throws Exception
     */
    public function getPage(): int
    {
        return intval($this->getAttribute(self::ATTRIBUTE_PAGE));
    }

    /**
     * @return bool
     */
    public function hasSearch(): bool
    {
        return $this->hasAttribute(self::ATTRIBUTE_SEARCH);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getSearch(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_SEARCH);
    }

    /**
     *
     * @return bool
     */
    public function isAjax(): bool
    {
        return strtolower($this->getServerRequest()->getHeaderLine('X-Requested-With')) === 'xmlhttprequest';
    }
}
