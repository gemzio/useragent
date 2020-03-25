<?php

namespace Gemz\Useragent;

use DeviceDetector\DeviceDetector;

class Useragent
{
    /** DeviceDetector */
    protected $parser;

    /** @var string  */
    protected $useragent;

    public static function agent(string $useragent)
    {
        return new static($useragent);
    }

    public function __construct(string $useragent)
    {
        $this->useragent = $useragent;
        $this->parser = new DeviceDetector();
    }

    public function for(string $useragent): self
    {
        $this->useragent = $useragent;

        return $this;
    }

    public function parser(): DeviceDetector
    {
        $this->parse();

        return $this->parser;
    }

    protected function parse(): void
    {
        $this->parser->setUserAgent($this->useragent);
        $this->parser->parse();
    }

    public function result(): array
    {
        $this->parse();

        return $this->resultResolver();
    }

    protected function resultResolver(): array
    {
        $client = $this->parser->getClient();
        $os = $this->parser->getOs();

        return [
            // is this a bot?
            'isBot' => $this->parser->isBot(),

            // browser
            'browserType' => $client !== null
                ? ($client['type'] ?? '')
                : '',

            // browser engine
            'browserEngine' => $client !== null
                ? ($client['engine'] ?? '')
                : '',

            // browser name like Chrome, Safari, Firefox etc.
            'browserName' => $client !== null
                ? ($client['name'] ?? '')
                : '',

            // browser version
            'browserVersion' => $client !== null
                ? ($client['version'] ?? '')
                : '',

            // device name
            'device' => $this->parser->getDeviceName(),

            // device model if applicable
            'deviceModel' => $this->parser->getModel(),

            // device brand if applicable
            'deviceBrand' => $this->parser->getBrandName(),

            // operating system
            'os' => $os !== null
                ? ($os['name'] ?? '')
                : '',

            // is mobile?
            'isMobile' => $this->parser->isMobile(),
        ];
    }

}
