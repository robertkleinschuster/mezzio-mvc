<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Controller;

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
     * @var array
     */
    private $id_Map;

    /**
     * ControllerRequestProperties constructor.
     * @param ServerRequestInterface $serverRequest
     * @throws Exception
     */
    public function __construct(ServerRequestInterface $serverRequest)
    {
        $this->serverRequest = $serverRequest;

        // POST Params
        foreach ($serverRequest->getParsedBody() as $key => $value) {
            $this->setAttribute($key, $value);
        }

        // GET Params
        foreach ($serverRequest->getQueryParams() as $key => $value) {
            $this->setAttribute($key, $value);
        }

        // View ID
        $this->setIdMap($this->convertViewID_To_Array($this->getAttribute(ControllerInterface::VIEWID_ATTRIBUTE)));
    }


    /**
     * @param string $viewID
     * @return array
     */
    protected function convertViewID_To_Array(string $viewID): array
    {
        $result = [];
        $key_List = explode(';', urlencode($viewID));
        foreach ($key_List as $item) {
            $split = explode('=', $item);
            $result[$split[0]] = $split[1];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getIdMap(): array
    {
        return $this->id_Map;
    }

    /**
     * @param array $id_Map
     */
    public function setIdMap(array $id_Map): void
    {
        $this->id_Map = $id_Map;
    }


    /**
     * @return ServerRequestInterface
     */
    public function getServerRequest(): ServerRequestInterface
    {
        return $this->serverRequest;
    }
}
