<?php

declare(strict_types=1);

namespace Mezzio\Mvc\Model;

use Mezzio\Mvc\Bean\TemplateDataBean;
use Mezzio\Mvc\Controller\ControllerRequest;
use Mezzio\Mvc\Helper\ValidationHelper;

abstract class AbstractModel implements ModelInterface
{
    /**
     * @var TemplateDataBean
     */
    private $templateData;

    /**
     * @var ValidationHelper
     */
    private $validationHelper;

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
                $this->save($request->getAttributes());
                break;
            case ControllerRequest::SUBMIT_MODE_CREATE:
                $this->create($request->getViewIdMap(), $request->getAttributes());
                break;
            case ControllerRequest::SUBMIT_MODE_DELETE:
                $this->delete($request->getViewIdMap());
                break;
        }
    }

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
