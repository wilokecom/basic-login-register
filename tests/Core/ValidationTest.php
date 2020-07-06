<?php

namespace WilokeTest\Core;

use PHPUnit\Framework\TestCase;
use Wiloke\Core\Validation;

class ValidationTest extends TestCase
{
    //    public function testPassedAllConditional()
    //    {
    //        $aConditionals = [
    //            'isTest'
    //        ];
    //
    //        $oValidation = new Validation();
    //        $this->assertFalse($oValidation->passedAllConditional($aConditionals));
    //    }
    
    /**
     *
     * @dataProvider providerConditionals
     */
    public function testPassedAllConditional($aConditionals, $params)
    {
        $oValidation = new Validation();
        $oValidation->make($params);
        $this->assertTrue($oValidation->passedConditional($aConditionals), implode(',', $oValidation->getErrors()));
    }
    
    public function providerConditionals()
    {
        return [
            [
                [
                    ['isHasOne', 'isHasTwo'],
                    ['isAlwaysTrue']
                ],
                [
                    [1, 2, 3]
                ]
            ],
            [['isAlwaysTrue'], []],
            [['isHasOne', 'isHasTwo'], [[1, 2, 3]]],
            [['!isAlwaysTrue'], [[1, 2, 3]]]
        ];
    }
}
