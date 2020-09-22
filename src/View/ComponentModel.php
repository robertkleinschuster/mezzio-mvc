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
     * @var array
     */
    private $editData;

    /**
     * ComponentModel constructor.
     */
    public function __construct()
    {
        $this->overviewData = [];
        $this->detailData = [];
        $this->editData = [];
    }


    public function getOverview()
    {
        return $this->overviewData;
    }

    public function getDetail(string $key)
    {
        return $this->detailData[$key];
    }

    public function getEdit(string $key)
    {
        return $this->editData[$key];
    }


    /**
     * @param array $overviewData
     */
    public function setOverviewData(array $overviewData): void
    {
        $this->overviewData = $overviewData;
    }

    /**
     * @param array $detailData
     */
    public function setDetailData(array $detailData): void
    {
        $this->detailData = $detailData;
    }

    /**
     * @param array $editData
     */
    public function setEditData(array $editData): void
    {
        $this->editData = $editData;
    }

}
