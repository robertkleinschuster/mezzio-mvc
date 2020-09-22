<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

interface ComponentModelInterface
{
    public function getOverview();

    public function getDetail(string $key);
    public function getEdit(string $key);
}
