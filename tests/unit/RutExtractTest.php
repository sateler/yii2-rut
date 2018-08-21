<?php

use sateler\rut\Rut;

class RutExtractTest extends \Codeception\Test\Unit
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
        $rut = Rut::extractNumber(null);
        $this->assertNull($rut);
        $rut = Rut::extractDV(null);
        $this->assertNull($rut);
    }

    public function testEmptyInputYieldsEmpty()
    {
        $rut = Rut::extractNumber('');
        $this->assertNotNull($rut);
        $this->assertEmpty($rut);
        $rut = Rut::extractDV('');
        $this->assertNotNull($rut);
        $this->assertEmpty($rut);
    }
}
