<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base;

use Mezzio\Mvc\View\ComponentDataBeanInterface;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;

abstract class AbstractField implements OptionAwareInterface
{
    use OptionTrait;

    public const STYLE_PRIMARY = 'primary';
    public const STYLE_SECONDARY = 'secondary';
    public const STYLE_SUCCESS = 'success';
    public const STYLE_DANGER = 'danger';
    public const STYLE_WARNING = 'warning';
    public const STYLE_INFO = 'info';
    public const STYLE_LIGHT = 'light';
    public const STYLE_DARK = 'dark';

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $value;

    /**
     * AbstractField constructor.
     * @param string $name
     * @param string $key
     */
    public function __construct(string $name, string $key)
    {
        $this->name = $name;
        $this->key = $key;
    }

    /**
     * @param string $input
     * @param ComponentDataBeanInterface $bean
     * @return string
     */
    protected function replacePlaceholders(string $input, ComponentDataBeanInterface $bean)
    {
        $output = $input;
        foreach ($bean as $key => $item) {
            $placeholder = "{{$key}}";
            if (strpos($input, $placeholder) !== false) {
                $output = str_replace($placeholder, $item, $output);
            }
        }
        return $output;
    }

    /**
     * @param ComponentDataBeanInterface|null $bean
     * @return string
     */
    public function getValue(?ComponentDataBeanInterface $bean = null)
    {
        if (null !== $bean) {
            if (!$this->hasValue()) {
                $value = "{{$this->getKey()}}";
            } else {
                $value = $this->value;
            }
            return $this->replacePlaceholders($value, $bean);
        }
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasValue(): bool
    {
        return null !== $this->value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param mixed $key
     * @return $this
     */
    public function setKey($key): self
    {
        $this->key = $key;
        return $this;
    }

    /**
     * @return string
     */
    abstract public function getTemplate();
}
