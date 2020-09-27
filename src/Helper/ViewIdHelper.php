<?php
declare(strict_types=1);

namespace Mezzio\Mvc\Helper;

class ViewIdHelper
{

    public const VIEWID_ATTRIBUTE = 'viewid';


    /**
     * @param string $viewID
     * @return array
     */
    public function parseViewId(string $viewID): array
    {
        $result = [];
        $key_List = explode(';', urldecode($viewID));
        foreach ($key_List as $item) {
            $split = explode('=', $item);
            $result[$split[0]] = $split[1];
        }
        return $result;
    }

    /**
     * @param array $id_Map
     * @return string
     */
    public function generateViewId(array $id_Map): string
    {
        $result = [];
        foreach ($id_Map as $key => $value) {
            $result[] = "$key=$value";
        }
        return urlencode(implode(';', $result));
    }


}
