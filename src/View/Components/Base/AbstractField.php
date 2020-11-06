<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base;

use Niceshops\Bean\Converter\BeanConverterAwareInterface;
use Niceshops\Bean\Converter\BeanConverterAwareTrait;
use Niceshops\Bean\Type\Base\BeanInterface;
use Niceshops\Core\Attribute\AttributeAwareInterface;
use Niceshops\Core\Attribute\AttributeAwareTrait;
use Niceshops\Core\Option\OptionAwareInterface;
use Niceshops\Core\Option\OptionAwareTrait;
use Pars\Mvc\Helper\PathHelperAwareInterface;
use Pars\Mvc\Helper\PathHelperAwareTrait;

/**
 * Class AbstractField
 * @package Pars\Mvc\View\Components\Base
 */
abstract class AbstractField implements
    OptionAwareInterface,
    AttributeAwareInterface,
    BeanConverterAwareInterface,
    PathHelperAwareInterface,
    LinkAwareInterface
{
    use OptionAwareTrait;
    use AttributeAwareTrait;
    use BeanConverterAwareTrait;
    use PathHelperAwareTrait;
    use LinkAwareTrait;

    public const STYLE_PRIMARY = 'primary';
    public const STYLE_SECONDARY = 'secondary';
    public const STYLE_SUCCESS = 'success';
    public const STYLE_DANGER = 'danger';
    public const STYLE_WARNING = 'warning';
    public const STYLE_INFO = 'info';
    public const STYLE_LIGHT = 'light';
    public const STYLE_DARK = 'dark';

    public const OPTION_APPEND_TO_PREVIOUS = 'append_to_previous';

    /**
     * @var string
     */
    private ?string $title;

    /**
     * @var string
     */
    private string $key;

    /**
     * @var string
     */
    private ?string $value = null;

    /**
     * @var string
     */
    private ?string $chapter = null;

    /**
     * @var int
     */
    private ?int $width = null;

    /**
     * @var string
     */
    private ?string $permission = null;

    /**
     * @var callable
     */
    private $show = null;

    /**
     * @var callable
     */
    private $format = null;

    /**
     * AbstractField constructor.
     * @param string $title
     * @param string $key
     */
    public function __construct(string $key, string $title = null)
    {
        $this->title = $title;
        $this->key = $key;
    }

    /**
     * @param string $input
     * @param BeanInterface $bean
     * @return string
     */
    protected function replacePlaceholders(string $input, BeanInterface $bean)
    {
        $output = $input;
        $converter = null;
        if ($this->hasBeanConverter()) {
            $converter = $this->getBeanConverter()->convert($bean);
        }
        foreach ($bean as $key => $item) {
            $placeholder = "{{$key}}";
            if (strpos($input, $placeholder) !== false) {
                if (null === $converter) {
                    $value = $item;
                } else {
                    $value = $converter->getData($key);
                }
                $output = str_replace($placeholder, $value, $output);
            }
            $placeholderEncoded = urlencode($placeholder);
            if (strpos($input, $placeholderEncoded) !== false) {
                if (null === $converter) {
                    $value = $item;
                } else {
                    $value = $converter->getData($key);
                }
                $output = str_replace($placeholderEncoded, $value, $output);
            }
        }
        return $output;
    }

    /**
     * @param BeanInterface|null $bean
     * @return string
     */
    public function getValue(?BeanInterface $bean = null)
    {
        if (null !== $bean) {
            if ($this->hasFormat()) {
                return ($this->getFormat())($bean, $this);
            } else {
                if (!$this->hasValue()) {
                    $value = "{{$this->getKey()}}";
                } else {
                    $value = $this->value;
                }
                return $this->replacePlaceholders($value, $bean);
            }
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
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function hasTitle()
    {
        return $this->title !== null;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
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
    public function getChapter(): string
    {
        return $this->chapter ?? '';
    }

    /**
     * @param string $chapter
     * @return AbstractField
     */
    public function setChapter(string $chapter)
    {
        $this->chapter = $chapter;
        return $this;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     *
     * @return $this
     */
    public function setWidth(int $width): self
    {
        $this->width = $width;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasWidth(): bool
    {
        return $this->width !== null;
    }

    /**
     * @param bool $append
     * @return $this
     */
    public function setAppendToColumnPrevious(bool $append)
    {
        if ($append) {
            $this->addOption(self::OPTION_APPEND_TO_PREVIOUS);
        } else {
            $this->removeOption(self::OPTION_APPEND_TO_PREVIOUS);
        }
        return $this;
    }

    /**
     * @return bool
     */
    public function isAppendToPrevious(): bool
    {
        return $this->hasOption(self::OPTION_APPEND_TO_PREVIOUS);
    }

    /**
     * @return string
     */
    public function getPermission(): string
    {
        return $this->permission;
    }

    /**
     * @param string $permission
     *
     * @return $this
     */
    public function setPermission(string $permission): self
    {
        $this->permission = $permission;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasPermission(): bool
    {
        return $this->permission !== null;
    }

    /**
     * @return callable
     */
    public function getShow(): callable
    {
        return $this->show;
    }

    /**
     * @param callable $show
     *
     * @return $this
     */
    public function setShow(callable $show): self
    {
        $this->show = $show;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasShow(): bool
    {
        return $this->show !== null;
    }

    /**
     * @param BeanInterface $bean
     * @return bool
     */
    public function isShow(BeanInterface $bean): bool
    {
        if ($this->hasShow()) {
            return ($this->getShow())($bean);
        }
        return true;
    }

    /**
     * @return callable
     */
    public function getFormat(): callable
    {
        return $this->format;
    }

    /**
     * @param callable $format
     *
     * @return $this
     */
    public function setFormat(callable $format): self
    {
        $this->format = $format;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasFormat(): bool
    {
        return $this->format !== null;
    }

    /**
     * @param BeanInterface|null $bean
     * @return string
     */
    public function getLink(?BeanInterface $bean = null): string
    {
        if (null === $bean) {
            return $this->link ?? $this->getPathHelper()->getPath(false);
        } else {
            return $this->replacePlaceholders($this->link ?? $this->getPathHelper()->getPath(false), $bean);
        }
    }
    /**
     * @return bool
     */
    public function hasLink(): bool
    {
        return $this->link !== null || $this->hasPathHelper();
    }

    /**
     * @return string
     */
    abstract public function getTemplate();
}
