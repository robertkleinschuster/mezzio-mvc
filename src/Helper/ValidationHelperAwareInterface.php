<?php


namespace Mezzio\Mvc\Helper;


interface ValidationHelperAwareInterface
{
    public function getValidationHelper(): ValidationHelper;

}
