<?php

declare(strict_types=1);

namespace Mvc\View\Components\Base\Fields;

interface RequiredAwareInterface
{

    /**
     * @return bool
     */
    public function isRequired(): bool;

    /**
     * @param bool $required
     * @return $this;
     */
    public function setRequired(bool $required = true);
}
