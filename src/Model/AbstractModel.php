<?php
declare(strict_types=1);

namespace Pars\Mvc\Model;

use Pars\Mvc\Bean\TemplateDataBean;
use Niceshops\Core\Option\OptionAwareInterface;
use Niceshops\Core\Option\OptionAwareTrait;
use Pars\Mvc\Controller\ControllerRequest;
use Pars\Mvc\Helper\ValidationHelper;

/**
 * Class AbstractModel
 * @package Pars\Mvc\Model
 */
abstract class AbstractModel implements ModelInterface, OptionAwareInterface
{
    use OptionAwareTrait;

    public const OPTION_CREATE_ALLOWED = 'create_allowed';
    public const OPTION_EDIT_ALLOWED = 'edit_allowed';
    public const OPTION_DELETE_ALLOWED = 'delete_allowed';

    /**
     * @var TemplateDataBean
     */
    private ?TemplateDataBean $templateData = null;

    /**
     * @var ValidationHelper
     */
    private ?ValidationHelper $validationHelper = null;

    /**
     * @return TemplateDataBean
     */
    public function getTemplateData(): TemplateDataBean
    {
        if (null == $this->templateData) {
            $this->templateData = new TemplateDataBean();
        }
        return $this->templateData;
    }

    /**
     * @return ValidationHelper
     */
    public function getValidationHelper(): ValidationHelper
    {
        if (null == $this->validationHelper) {
            $this->validationHelper = new ValidationHelper();
        }
        return $this->validationHelper;
    }

    /**
     * @param string $submitMode
     * @param array $viewIdMap
     * @param array $attributes
     */
    public function submit(string $submitMode, array $viewIdMap, array $attributes)
    {
        switch ($submitMode) {
            case ControllerRequest::SUBMIT_MODE_SAVE:
                if ($this->hasOption(self::OPTION_EDIT_ALLOWED)) {
                    $this->save($attributes);
                } else {
                    $this->handlePermissionDenied();
                }
                break;
            case ControllerRequest::SUBMIT_MODE_CREATE:
                if ($this->hasOption(self::OPTION_CREATE_ALLOWED)) {
                    $this->create($viewIdMap, $attributes);
                } else {
                    $this->handlePermissionDenied();
                }
                break;
            case ControllerRequest::SUBMIT_MODE_DELETE:
                if ($this->hasOption(self::OPTION_DELETE_ALLOWED)) {
                    $this->delete($viewIdMap);
                } else {
                    $this->handlePermissionDenied();
                }
                break;
        }
    }

    abstract protected function handlePermissionDenied();

    /**
     * @param array $viewIdMap
     * @param array $attributes
     * @return mixed
     */
    abstract protected function create(array $viewIdMap, array $attributes);

    /**
     * @param array $viewIdMap
     * @return mixed
     */
    abstract protected function delete(array $viewIdMap);

    /**
     * @param array $attributes
     * @return mixed
     */
    abstract protected function save(array $attributes);
}
