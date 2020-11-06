<?php

namespace Pars\Mvc\Parameter;

use Pars\Mvc\Controller\ControllerRequest;

/**
 * Class MoveParameter
 * @package Pars\Mvc\Parameter
 */
class MoveParameter extends AbstractParameter
{
    public const ATTRIBUTE_MODE = 'mode';
    public const MODE_UP = 'up';
    public const MODE_DOWN = 'down';


    public function getParamterKey(): string
    {
        return ControllerRequest::ATTRIBUTE_MOVE;
    }


    /**
     * @param string $mode
     * @return $this
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     */
    public function setMode(string $mode)
    {
        $this->setAttribute(self::ATTRIBUTE_MODE, $mode);
        return $this;
    }

    /**
     * @return string
     * @throws \Niceshops\Core\Exception\AttributeNotFoundException
     */
    public function getMode(): string
    {
        return $this->getAttribute(self::ATTRIBUTE_MODE);
    }

    /**
     * @return $this
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     */
    public function setUp()
    {
        $this->setMode(self::MODE_UP);
        return $this;
    }

    /**
     * @return $this
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     */
    public function setDown()
    {
        $this->setMode(self::MODE_DOWN);
        return $this;
    }
}
