<?php

namespace WilokeTest\Core;

use PHPUnit\Framework\TestCase;
use Wiloke\Controllers\LoginController;

class TestAccessPrivateProtectedMethod extends TestCase
{
    /**
     * Call protected/private method of a class.
     *
     * @param object &$object     Instantiated object that we will run method on.
     * @param string  $methodName Method name to call
     * @param array   $parameters Array of parameters to pass into method.
     *
     * @return mixed Method return.
     * @throws \ReflectionException
     */
    public function invokeMethod($object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method     = $reflection->getMethod($methodName);
        $method->setAccessible(true);
        
        return $method->invokeArgs($object, $parameters);
    }
    
    public function testPrivateProtectedMethod()
    {
        $oLoginController = new LoginController();
        
        $this->assertEquals(
            md5("admin"),
            $this->invokeMethod($oLoginController, 'cryptPassword', ['admin'])
        );
    }
}
