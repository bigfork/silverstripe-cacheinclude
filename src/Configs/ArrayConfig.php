<?php

namespace Heyday\CacheInclude\Configs;

class ArrayConfig implements ConfigInterface
{
    /**
     * @var array
     */
    protected $config;

    /**
     * @param array|void $config
     */
    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    /**
     * @param array $config
     */
    public function setConfig(array $config)
    {
        if (is_array($config)) {
            $this->config = $config;
        }
    }

    /**
     * @param mixed $id
     * @param mixed $value
     * @throws \Exception
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($id, $value)
    {
        throw new \Exception('Configs are immutable');
    }

    /**
     * @param mixed $id
     * @return mixed
     * @throws \InvalidArgumentException
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($id)
    {
        if (!array_key_exists($id, $this->config)) {
            throw new \InvalidArgumentException(sprintf('Config "%s" is not defined.', $id));
        }

        return $this->config[$id];
    }

    /**
     * @param mixed $id
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($id)
    {
        return isset($this->config[$id]);
    }

    /**
     * @param mixed $id
     * @throws \Exception
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($id)
    {
        throw new \Exception('Configs are immutable');
    }

    /**
     * @return \ArrayIterator
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
    {
        return new \ArrayIterator($this->config);
    }
}
