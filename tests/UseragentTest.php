<?php

namespace Gemz\Useragent\Tests;

use DeviceDetector\DeviceDetector;
use Gemz\Useragent\Useragent;
use PHPUnit\Framework\TestCase;

class UseragentTest extends TestCase
{
    protected $useragents = [
        'desktop' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.130 Safari/537.36',
        'mobile' => 'Mozilla/5.0 (Linux; U; Android 7.0; en-US; SM-G935F Build/NRD90M) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/11.3.8.976 U3/0.8.0 Mobile Safari/534.30'
    ];

    /** @test */
    public function test_result_is_array()
    {
        $result = Useragent::agent($this->useragents['mobile'])
            ->result();

        $this->assertIsArray($result);
    }

    public function test_can_instantiate_static()
    {
        $result = Useragent::agent($this->useragents['mobile'])
            ->result();

        $this->assertIsArray($result);
    }

    public function test_can_instantiate()
    {
        $result = (new Useragent($this->useragents['mobile']))
            ->result();

        $this->assertIsArray($result);
    }

    public function test_can_set_new_useragent()
    {
        $parser = new Useragent($this->useragents['mobile']);

        $result = $parser->result();

        $this->assertIsArray($result);

        $result = $parser->for($this->useragents['desktop'])->result();

        $this->assertIsArray($result);
    }

    public function test_can_use_parser()
    {
        $parser = Useragent::agent($this->useragents['mobile']);
        $parser = $parser->parser();

        $this->assertTrue($parser instanceof DeviceDetector);
    }

    public function test_can_use_simple_string_as_agent()
    {
        $parser = Useragent::agent('symfony');

        $result = $parser->result();

        $this->assertIsArray($result);
    }

    public function test_can_use_empty_string_as_agent()
    {
        $parser = Useragent::agent('symfony');

        $result = $parser->result();

        $this->assertIsArray($result);
    }
}
