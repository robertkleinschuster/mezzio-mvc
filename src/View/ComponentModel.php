<?php

declare(strict_types=1);

namespace Mezzio\Mvc\View;

class ComponentModel implements ComponentModelInterface
{

    /**
     * @var array
     */
    private $overviewData;
    /**
     * @var array
     */
    private $detailData;

    /**
     * ComponentModel constructor.
     */
    public function __construct()
    {
        $this->overviewData = [];
        $this->detailData = [];
    }


    public function getOverview()
    {
        return $this->overviewData;
    }

    public function getDetail()
    {
        return $this->detailData;
    }
}
