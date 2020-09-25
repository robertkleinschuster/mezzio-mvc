<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View\Components\Base\Fields;

use Mezzio\Mvc\View\Components\Base\AbstractField;

abstract class AbstractRadioButtonGroup extends AbstractField
{

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
