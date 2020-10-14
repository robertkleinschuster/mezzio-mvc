<?php

declare(strict_types=1);

namespace Mvc\Model;

use Mvc\Bean\TemplateDataBean;
use Mvc\Controller\ControllerRequest;
use Mvc\Helper\ValidationHelper;
use NiceshopsDev\NiceCore\Option\OptionAwareInterface;
use NiceshopsDev\NiceCore\Option\OptionTrait;

abstract class AbstractModel implements ModelInterface, OptionAwareInterface
{
    use OptionTrait;

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
     * @param string $submitModel
     * @param array $viewIdMap
     * @param array $attributes
     */
    public function submit(string $submitModel, array $viewIdMap, array $attributes)
    {
        switch ($submitModel) {
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
