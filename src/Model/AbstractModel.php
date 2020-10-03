<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Helper\ValidationHelper;
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
    private $templateData;

    /**
     * @var ValidationHelper
     */
    private $validationHelper;

    /**
     * @var array
     */
    private $permissionList;

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
     * @param ControllerRequest $request
     * @throws \NiceshopsDev\NiceCore\Exception
     */
    public function submit(ControllerRequest $request)
    {
        switch ($request->getSubmit()) {
            case ControllerRequest::SUBMIT_MODE_SAVE:
                if ($this->hasOption(self::OPTION_EDIT_ALLOWED)) {
                    $this->save($request->getAttributes());
                } else {
                    $this->handlePermissionDenied();
                }
                break;
            case ControllerRequest::SUBMIT_MODE_CREATE:
                if ($this->hasOption(self::OPTION_CREATE_ALLOWED)) {
                    $this->create($request->getViewIdMap(), $request->getAttributes());
                } else {
                    $this->handlePermissionDenied();
                }
                break;
            case ControllerRequest::SUBMIT_MODE_DELETE:
                if ($this->hasOption(self::OPTION_DELETE_ALLOWED)) {
                    $this->delete($request->getViewIdMap());
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
