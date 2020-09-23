<?php


namespace Mezzio\Mvc\View\Components\Edit\Fields;


use Mezzio\Mvc\View\Components\Base\AbstractField;

class Select extends AbstractField
{

    /**
     * @var array
     */
    private $options;

    /**
     * @var int
     */
    private $size;

    /**
     * @var bool
     */
    private $multiple;

    public function getTemplate()
    {
        return 'components/edit/fields/select';
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addOption(string $name, string $value)
    {
        $this->options[$value] = $name;
    }

    /**
     * @return array
     */
    public function getOptions(): array
    {
        return $this->options ?? [];
    }

    /**
     * @param array $options
     */
    public function setOptions(array $options): void
    {
        $this->options = $options;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size ?? 1;
    }

    /**
     * @param int $size
     */
    public function setSize(int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return bool
     */
    public function isMultiple(): bool
    {
        return $this->multiple ?? false;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple): void
    {
        $this->multiple = $multiple;
    }


}
