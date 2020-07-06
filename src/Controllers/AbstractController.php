<?php
namespace Wiloke\Controllers;

class AbstractController
{
    /**
     * @param $name
     * @param $arguments
     *
     * @throws \Exception
     */
    public function __call($name, $arguments)
    {
        if (!method_exists($this, $name)) {
            throw new \Exception(sprintf("Sorry, the method %s in the class %s does not exist", $name, __CLASS__));
        }
    }
}
