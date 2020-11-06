<?php

namespace Pars\Mvc\Parameter;

use Niceshops\Core\Attribute\AttributeAwareInterface;
use Niceshops\Core\Attribute\AttributeAwareTrait;
use Pars\Mvc\Helper\ParameterMapHelper;

abstract class AbstractParameter implements AttributeAwareInterface
{
    use AttributeAwareTrait;

    /**
     * @var ParameterMapHelper
     */
    private ParameterMapHelper $parameterMapHelper;

    /**
     * @return ParameterMapHelper
     */
    public function getParameterMapHelper(): ParameterMapHelper
    {
        if (null === $this->parameterMapHelper) {
            $this->parameterMapHelper = new ParameterMapHelper();
        }
        return $this->parameterMapHelper;
    }

    /**
     * @param string $parameter
     * @return AbstractParameter
     * @throws \Niceshops\Core\Exception\AttributeExistsException
     * @throws \Niceshops\Core\Exception\AttributeLockException
     */
    public function fromString(string $parameter)
    {
        $data = $this->getParameterMapHelper()->parseParameter($parameter);
        foreach ($data as $key => $value) {
            $this->setAttribute($key, $value);
        }
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getParameterMapHelper()->generateParameter($this->getAttribute_List());
    }

    /**
     * @return string
     */
    abstract public function getParamterKey(): string;
}
