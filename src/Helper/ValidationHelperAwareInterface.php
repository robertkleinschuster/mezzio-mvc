<?php


namespace Mvc\Helper;


interface ValidationHelperAwareInterface
{
    public function getValidationHelper(): ValidationHelper;

}
