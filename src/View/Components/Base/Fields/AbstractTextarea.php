<?php

declare(strict_types=1);

namespace Pars\Mvc\View\Components\Base\Fields;

use Pars\Mvc\View\Components\Base\AbstractField;
use Pars\Mvc\View\Components\Base\RequiredAwareInterface;
use Pars\Mvc\View\Components\Base\RequiredAwareTrait;

/**
 * Class AbstractTextarea
 * @package Pars\Mvc\View\Components\Base\Fields
 */
abstract class AbstractTextarea extends AbstractField implements RequiredAwareInterface
{
    use RequiredAwareTrait;

    /**
     * @var int
     */
    private ?int $rows = null;

    /**
     * @return string
     */
    public function getTemplate()
    {
        return 'components/base/fields/textarea';
    }

    /**
     * @return int
     */
    public function getRows(): int
    {
        return $this->rows;
    }

    /**
     * @param int $rows
     *
     * @return $this
     */
    public function setRows(int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasRows(): bool
    {
        return $this->rows !== null;
    }
}
