<?php

namespace Oro\Bundle\WindowsBundle\Tests\Manager;

use Oro\Bundle\WindowsBundle\Manager\WindowsStateRequestManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;

class WindowsStateRequestManagerTest extends \PHPUnit\Framework\TestCase
{
    /** @var WindowsStateRequestManager */
    protected $manager;

    /** @var \PHPUnit\Framework\MockObject\MockObject|RequestStack */
    protected $requestStack;

    protected function setUp()
    {
        $this->requestStack = $this->getMockBuilder('Symfony\Component\HttpFoundation\RequestStack')
            ->disableOriginalConstructor()
            ->getMock();

        $this->manager = new WindowsStateRequestManager($this->requestStack);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing $request
     */
    public function testGetDataMissingRequest()
    {
        $this->requestStack->expects($this->once())->method('getCurrentRequest')->willReturn(null);
        $this->manager->getData();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing data in $request
     */
    public function testGetDataMissingData()
    {
        $request = new Request();
        $this->requestStack->expects($this->once())->method('getCurrentRequest')->willReturn($request);
        $this->manager->getData();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Missing url in $data
     */
    public function testGetDataMissingUrl()
    {
        $request = new Request([], ['data' => []]);
        $this->requestStack->expects($this->once())->method('getCurrentRequest')->willReturn($request);
        $this->manager->getData();
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage $cleanUrl is empty
     */
    public function testCleanUrlIsEmpty()
    {
        $request = new Request([], ['data' => ['url' => 'localhost']], [], [], [], ['SCRIPT_NAME' => 'localhost']);
        $this->requestStack->expects($this->once())->method('getCurrentRequest')->willReturn($request);
        $this->manager->getData();
    }

    public function testGetData()
    {
        $request = new Request([], ['data' => ['url' => 'localhost/path']], [], [], [], ['SCRIPT_NAME' => 'localhost']);
        $this->requestStack->expects($this->once())->method('getCurrentRequest')->willReturn($request);
        $this->assertEquals(['url' => 'localhost/path', 'cleanUrl' => '/path'], $this->manager->getData());
    }

    /**
     * @dataProvider uriDataProvider
     * @param string $expected
     * @param array $data
     */
    public function testGetUri($expected, array $data)
    {
        $this->assertStringStartsWith($expected, $this->manager->getUri($data));
    }

    /**
     * @return array
     */
    public function uriDataProvider()
    {
        return [
            'simple path' => ['/path', ['cleanUrl' => '/path']],
            'autogenerated wid' => ['/path?_widgetContainer=form&_wid=', ['cleanUrl' => '/path', 'type' => 'form']],
            'predefined wid' => [
                '/path?_widgetContainer=form&_wid=123456',
                ['cleanUrl' => '/path', 'type' => 'form', 'wid' => '123456'],
            ],
            'url contains container' => [
                '/path?_widgetContainer=container',
                ['cleanUrl' => '/path?_widgetContainer=container', 'type' => 'form', 'wid' => '123456'],
            ],
            'query' => [
                '/path?param=value&_widgetContainer=form&_wid=123456',
                ['cleanUrl' => '/path?param=value', 'type' => 'form', 'wid' => '123456'],
            ],
        ];
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage cleanUrl is missing
     */
    public function testDataEmpty()
    {
        $this->manager->getUri([]);
    }
}
