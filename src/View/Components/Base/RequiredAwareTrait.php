<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base;

trait RequiredAwareTrait
{

    /**
     * @var bool
     */
    private bool $required = false;


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
