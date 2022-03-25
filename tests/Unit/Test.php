<?php

namespace Nci\SettingsPackage\Tests\Unit;

use Nci\SettingsPackage\Models\Setting;
use Nci\SettingsPackage\Tests\TestCase;

class Test extends TestCase
{
    /** @test */
    function it_should_return_class_name()
    {
        $this->assertEquals('Setting', class_basename(Setting::class));
    }
}