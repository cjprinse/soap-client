<?php

namespace spec\Phpro\SoapClient\CodeGenerator\Config;

use Phpro\SoapClient\CodeGenerator\Config\Config;
use Phpro\SoapClient\CodeGenerator\Config\ConfigInterface;
use Phpro\SoapClient\CodeGenerator\Rules\RuleSet;
use Phpro\SoapClient\Exception\InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

/**
 * Class ConfigSpec
 *
 * @package spec\Phpro\SoapClient\CodeGenerator\Config
 * @mixin Config
 */
class ConfigSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(Config::class);
    }
    
    function it_is_a_config_class()
    {
        $this->shouldImplement(ConfigInterface::class);
    }

    function it_has_a_namespace()
    {
        $this->setNamespace($value = 'MyNamespace');
        $this->getNamespace()->shouldReturn($value);
    }

    function it_has_a_wsdl()
    {
        $this->setWsdl($value = 'http://myservice/some.wsdl');
        $this->getWsdl()->shouldReturn($value);
    }

    function it_requires_a_wsdl()
    {
        $this->shouldThrow(InvalidArgumentException::class)->duringGetWsdl();
    }

    function it_has_a_destination()
    {
        $this->setDestination($value = 'destination/folder');
        $this->getDestination()->shouldReturn($value);
    }

    function it_requires_a_destination()
    {
        $this->shouldThrow(InvalidArgumentException::class)->duringGetDestination();
    }

    function it_has_a_ruleset()
    {
        $this->setRuleSet($value = new RuleSet([]));
        $this->getRuleSet()->shouldBe($value);
    }

    function it_had_soap_options()
    {
        $this->getSoapOptions()->shouldBe([
            'trace' => false,
            'exceptions' => true,
            'keep_alive' => true,
            'cache_wsdl' => WSDL_CACHE_NONE,
        ]);

        $this->setSoapOptions($value = []);
        $this->getSoapOptions()->shouldBe($value);

        $this->addSoapOption('key', 'value');
        $this->getSoapOptions()->shouldBe(['key' => 'value']);
    }

    function it_has_a_generate_types_command_class_name()
    {
        $this->setGenerateTypesCommandClassName($value = '\Vendor\Package\Console\Command\GenerateTypesCommand');
        $this->getGenerateTypesCommandClassName()->shouldReturn($value);
    }

    function it_has_a_generate_classmap_command_class_name()
    {
        $this->setGenerateClassmapCommandClassName($value = '\Vendor\Package\Console\Command\GenerateClassmapCommand');
        $this->getGenerateClassmapCommandClassName()->shouldReturn($value);
    }
}
