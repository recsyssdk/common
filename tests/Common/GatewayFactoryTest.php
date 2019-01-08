<?php
/**
 * Created by PhpStorm.
 * User: lenovo
 * Date: 1/8/2019
 * Time: 11:12 AM
 */

namespace Recsys\Tests\Common;

use Mockery as m;
use Recsys\Common\GatewayFactory;
use Recsys\Tests\TestCase;

class GatewayFactoryTest extends TestCase
{
    public static function setUpBeforeClass()
    {
        m::mock('alias:Recsys\\Advance\\TestGateway');
    }
    public function setUp()
    {
        $this->factory = new GatewayFactory;
    }

    public function testReplace()
    {
        $gateways = ['Foo'];
        $this->factory->replace($gateways);
        $this->assertSame($gateways, $this->factory->all());
    }
    public function testRegister()
    {
        $this->factory->register('Bar');
        $this->assertSame(['Bar'], $this->factory->all());
    }
    public function testRegisterExistingGateway()
    {
        $this->factory->register('Milky');
        $this->factory->register('Bar');
        $this->factory->register('Bar');
        $this->assertSame(['Milky', 'Bar'], $this->factory->all());
    }
    public function testCreateShortName()
    {
        $gateway = $this->factory->create('Advance_Test');
        $this->assertInstanceOf('\\Recsys\\Advance\\TestGateway', $gateway);
    }
    public function testCreateFullyQualified()
    {
        $gateway = $this->factory->create('\\Recsys\\Advance\\TestGateway');
        $this->assertInstanceOf('\\Recsys\\Advance\\TestGateway', $gateway);
    }
    /**
     * @expectedException \Recsys\Common\Exception\RuntimeException
     * @expectedExceptionMessage Class '\Recsys\Invalid\Gateway' not found
     */
    public function testCreateInvalid()
    {
        $gateway = $this->factory->create('Invalid');
    }
}
