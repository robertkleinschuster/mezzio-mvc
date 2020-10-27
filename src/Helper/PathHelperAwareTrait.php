<?php
declare(strict_types=1);


namespace Mvc\Helper;


trait PathHelperAwareTrait
{
    private ?PathHelper $pathHelper;

    /**
    * @return PathHelper
    */
    public function getPathHelper(): PathHelper
    {
        return $this->pathHelper;
    }

    /**
    * @param PathHelper $pathHelper
    *
    * @return $this
    */
    public function setPathHelper(PathHelper $pathHelper)
    {
        $this->pathHelper = $pathHelper;
        return $this;
    }

    /**
    * @return bool
    */
    public function hasPathHelper(): bool
    {
        return $this->pathHelper !== null;
    }

}
