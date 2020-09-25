<?php


namespace Mezzio\Mvc\View\Components\Base\Fields;


trait RequiredAwareTrait
{

    /**
     * @var bool
     */
    private $required;


    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required ?? false;
    }

    /**
     * @param bool $required
     * @return $this;
     */
    public function setRequired(bool $required = true)
    {
        $this->required = $required;
        return $this;
    }
}
