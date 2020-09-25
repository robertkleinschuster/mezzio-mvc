<?php
namespace Mezzio\Mvc\View;

use ArrayIterator;
use NiceshopsDev\Bean\AbstractBaseBean;
use NiceshopsDev\Bean\BeanException;
use Traversable;

class ComponentDataBean extends AbstractBaseBean
{
    private const SERIALIZE_DATA_TYPE_KEY = "arrDataType";
    private const SELF_REFERENCE_PLACEHOLDER = "__THIS__";


    /**
     * @return ArrayIterator|Traversable
     */
    public function getIterator()
    {
        return new ArrayIterator($this->toArray());
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     * @throws BeanException
     */
    public function offsetExists($offset)
    {
        return $this->hasData($offset) && null !== $this->getData($offset);
    }


    /**
     * @param mixed $offset
     *
     * @return mixed
     * @throws BeanException
     */
    public function offsetGet($offset)
    {
        return $this->getData($offset);
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     *
     * @return $this
     * @throws BeanException
     */
    public function offsetSet($offset, $value)
    {
        return $this->setData($offset, $value);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     * @throws BeanException
     */
    public function offsetUnset($offset)
    {
        return $this->removeData($offset);
    }


    /**
     * NOTE: To implement bean specific data serialization logic use AbstractBean::getDataForSerialization
     *
     * @return array
     * @see AbstractBean::getDataForSerialization()
     */
    public function getSerializeData(): array
    {
        return [
            self::SERIALIZE_DATA_KEY => $this->getDataForSerialization(),
            self::SERIALIZE_DATA_TYPE_KEY => $this->getDataTypeDataForSerialization(),
        ];
    }

    /**
     * @return array
     */
    protected function getDataTypeDataForSerialization(): array
    {
        $arrDataType = $this->getDataType_List();

        foreach ($arrDataType as $key => $dataType) {
            if (is_array($dataType) && !empty($dataType[0]) && $dataType[0] === $this) {
                $arrDataType[$key][0] = self::SELF_REFERENCE_PLACEHOLDER;
            }
        }

        return $arrDataType;
    }

    /**
     * Overwrite to implement bean specific data serialization
     * @return array
     */
    protected function getDataForSerialization(): array
    {
        return $this->toArray();
    }

    /**
     * @return string
     * @throws BeanException
     */
    public function serialize()
    {
        return serialize($this->getSerializeData());
    }

    public function unserialize($serialized)
    {
        return $this->setSerializeData(unserialize($serialized));
    }

    /**
     * NOTE: To implement bean specific data deserialization logic use AbstractBean::setDataFromSerialization
     *
     * @param array $data
     *
     * @return $this
     * @throws BeanException
     * @see AbstractBean::setDataFromSerialization()
     *
     */
    public function setSerializeData(array $data)
    {
        if (!empty($data[self::SERIALIZE_DATA_KEY])) {
            $this->setDataFromSerialization($data[self::SERIALIZE_DATA_KEY]);
        }
        if (!empty($data[self::SERIALIZE_DATA_TYPE_KEY])) {
            $this->setDataTypeDataFromSerialization($data[self::SERIALIZE_DATA_TYPE_KEY]);
        }
        return $this;
    }

    /**
     * Overwrite to implement bean specific data deserialization
     *
     * @param array $data
     *
     * @return ComponentDataBean
     * @throws BeanException
     */
    protected function setDataFromSerialization(array $data)
    {
        $this->setFromArray($data);
        return $this;
    }

    /**
     * @param array $arrDataType
     *
     * @return $this
     * @throws BeanException
     */
    protected function setDataTypeDataFromSerialization(array $arrDataType)
    {
        foreach ($arrDataType as $key => $dataType) {
            if (is_array($dataType) && !empty($dataType[0]) && $dataType[0] === self::SELF_REFERENCE_PLACEHOLDER) {
                $arrDataType[$key][0] = $this;
            }
        }
        foreach ($arrDataType as $key => $item) {
            $this->setDataType($key, $item['name'], $item['nullable'], $item['callback']);
        }

        return $this;
    }

    /**
     * @return int|void
     */
    public function count()
    {
        return count($this->toArray());
    }
}
