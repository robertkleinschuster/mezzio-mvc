<?php

declare(strict_types=1);

namespace Mvc\Model;

use Mvc\Bean\TemplateDataBean;
use Mvc\Helper\ValidationHelper;

interface ModelInterface
{
    /**
     * @return TemplateDataBean
     */
    public function getTemplateData(): TemplateDataBean;

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper;

    /**
     * Initialize data source in model
     */
    public function init();

    /**
     * Set limit and current page (starting with 1) from request params
     *
     * @param int $limit
     * @param int $page
     */
    public function setLimit(int $limit, int $page);

    /**
     * @param string $search
     */
    public function handleSearch(string $search);

    /**
     * @param string $order
     * @return mixed
     */
    public function handleOrder(string $order);

    /**
     * Preload data for given ids
     * Load all data with set limit if ids are empty
     *
     * @param array $viewIdMap
     */
    public function find(array $viewIdMap);

    /**
     * Handle form submit
     *
     * @param string $submitMode
     * @param array $viewIdMap
     * @param array $attributes
     */
    public function submit(string $submitMode, array $viewIdMap, array $attributes);
}
