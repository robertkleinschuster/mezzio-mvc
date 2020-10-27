<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

use Mvc\View\Components\Base\AbstractField;
use Mvc\View\Components\Base\RequiredAwareInterface;
use Mvc\View\Components\Base\RequiredAwareTrait;

abstract class AbstractRadioButtonGroup extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var array
     */
    private $selectOptions;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/radiobuttongroup';
    }


    /**
     * @param string $name
     * @param string $value
     * @return AbstractSelect
     */
    public function addSelectOption(string $name, string $value): self
    {
        $this->selectOptions[$value] = $name;
        return $this;
    }

    /**
     * @return array
     */
    public function getSelectOptions(): array
    {
        return $this->selectOptions ?? [];
    }

    /**
     * @param array $options
     * @return AbstractSelect
     */
    public function setSelectOptions(array $options): self
    {
        $this->selectOptions = $options;
        return $this;
    }
}
