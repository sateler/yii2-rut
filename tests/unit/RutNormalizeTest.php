<?php

use sateler\rut\Rut;

class RutNormalizeTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testNullInputYieldsNull()
    {
        $rut = Rut::normalize(null);
        $this->assertNull($rut);
    }

    public function testEmptyInputYieldsEmpty()
    {
        $rut = Rut::normalize('');
        $this->assertNotNull($rut);
        $this->assertEmpty($rut);
    }

    public function test0InputYields00()
    {
        $rut = Rut::normalize('0');
        $this->assertEquals($rut, '00');
        $rut = Rut::normalize('00');
        $this->assertEquals($rut, '00');
        $rut = Rut::normalize('000000');
        $this->assertEquals($rut, '00');
        $rut = Rut::normalize('000000');
        $this->assertEquals($rut, '00');
    }

    public function testLeft0AreTrimmed()
    {
        $rut = Rut::normalize('0123123');
        $this->assertEquals($rut, '123123');
        $rut = Rut::normalize('000000000123123');
        $this->assertEquals($rut, '123123');
    }

    public function testkDigitIsUppercased()
    {
        $rut = Rut::normalize('123123k');
        $this->assertEquals($rut, '123123K');
    }

    public function testInvalidLettersAreStripped()
    {
        $rut = Rut::normalize('123123kasdf');
        $this->assertEquals($rut, '123123K');
        $rut = Rut::normalize('....-123 123kasdf');
        $this->assertEquals($rut, '123123K');
    }
}
