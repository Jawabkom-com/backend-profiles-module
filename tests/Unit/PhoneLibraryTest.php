<?php

namespace Jawabkom\Backend\Module\Profile\Test\Unit;

use Jawabkom\Backend\Module\Profile\Library\Phone;
use Jawabkom\Backend\Module\Profile\Test\AbstractTestCase;

class PhoneLibraryTest extends AbstractTestCase
{
    private Phone $phoneLib;

    public function setUp(): void
    {
        parent::setUp();
        $this->phoneLib = new Phone();
    }

    public function testParseInvalidPhone()
    {
        $parse = $this->phoneLib->parse('555');
        $this->assertEquals('555', $parse['phone']);
        $this->assertFalse($parse['is_valid']);
        $this->assertNull($parse['country_code']);
    }

    public function testParseNormalizedPhoneNumber()
    {
        $parse = $this->phoneLib->parse('+962788208263');
        $this->assertEquals('+962788208263', $parse['phone']);
        $this->assertTrue($parse['is_valid']);
        $this->assertEquals('JO', $parse['country_code']);
    }

    public function testParseNormalizedPhoneNumber_NoPrefix()
    {
        $parse = $this->phoneLib->parse('962788208263');
        $this->assertEquals('+962788208263', $parse['phone']);
        $this->assertTrue($parse['is_valid']);
        $this->assertEquals('JO', $parse['country_code']);
    }

    public function testLocalPhoneNumberWithInvalidCountryCode()
    {
        $parse = $this->phoneLib->parse('078-8208263', ['IN', 'UK']);
        $this->assertEquals('0788208263', $parse['phone']);
        $this->assertFalse($parse['is_valid']);
        $this->assertNull($parse['country_code']);
    }

    public function testLocalPhoneNumberWithPossibleCountryCodes()
    {
        $parse = $this->phoneLib->parse('078 820 8263', ['SA', 'AE', 'JO']);
        $this->assertEquals('+962788208263', $parse['phone']);
        $this->assertTrue($parse['is_valid']);
        $this->assertEquals('JO', $parse['country_code']);
    }

    public function testArabicLetters_LocalPhoneNumberWithPossibleCountryCodes()
    {
        $parse = $this->phoneLib->parse('٠٧٨٨٢٠٨٢٦٣', ['SA', 'AE', 'JO']);
        $this->assertEquals('+962788208263', $parse['phone']);
        $this->assertTrue($parse['is_valid']);
        $this->assertEquals('JO', $parse['country_code']);
    }
}