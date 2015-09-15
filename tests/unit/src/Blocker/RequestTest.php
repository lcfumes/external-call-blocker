<?php


class RequestTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
        $_SERVER["HTTP_REFERER"] = null;
    }
    public function testIsAllowedShouldReturnTrueWhenExternalCallFromAllowedDomain()
    {
        $domains = [".fumes.com.br"];
        $_SERVER["HTTP_REFERER"] = "www.fumes.com.br/contact";
        $blocker = new \app\Blocker\Request($domains);

        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $result = $blocker->isAllowed($request);

        $this->assertTrue($result);
    }

    public function testIsAllowedShouldReturnFalseWhenExternalCallFromNotAllowedDomains()
    {
        $domains = [".fumes.com.br"];
        $_SERVER["HTTP_REFERER"] = "www.pedalize.com.br/contact";
        $blocker = new \app\Blocker\Request($domains);

        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $result = $blocker->isAllowed($request);

        $this->assertFalse($result);
    }

    public function testIsAllowedShouldReturnTrueWhenExternalCallFromAllowedDomains()
    {
        $domains = [".fumes.com.br", ".pedalize.com.br"];
        $_SERVER["HTTP_REFERER"] = "http://www.pedalize.com.br/contact";
        $blocker = new \app\Blocker\Request($domains);

        $request = \Symfony\Component\HttpFoundation\Request::createFromGlobals();
        $result = $blocker->isAllowed($request);

        $this->assertTrue($result);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCreateInstanceShouldBeThrowInvalidArgumentExceptionWhenInvalidDomains()
    {
        $domains = [8];
        new \app\Blocker\Request($domains);
    }

    public function testSendBlockedResponseShouldReturnResponseWith412StatusCode()
    {
        $domains = [".fumes.com.br", ".pedalize.com.br"];
        $_SERVER["HTTP_REFERER"] = "http://www.anotherdomain.com.br/contact";
        $blocker = new \app\Blocker\Request($domains);
        $result = $blocker->block();
        $expected = \Symfony\Component\HttpFoundation\Response::HTTP_PRECONDITION_FAILED;
        $this->assertEquals($expected, $result->getStatusCode());
    }

}
