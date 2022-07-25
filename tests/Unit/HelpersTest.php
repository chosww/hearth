<?php

namespace Hearth\Tests\Unit;

use Hearth\Tests\TestCase;

class HelpersTest extends TestCase
{
    public function test_get_region_name_in_default_locale()
    {
        $result = get_region_name('NS', ['CA']);
        $this->assertEquals('Nova Scotia', $result);
    }

    public function test_get_region_name_in_alternate_locale()
    {
        $result = get_region_name('NS', ['CA'], 'fr');
        $this->assertEquals('Nouvelle-Écosse', $result);
    }

    public function test_get_region_name_returns_null_for_invalid_region()
    {
        $result = get_region_name('NS', ['US']);
        $this->assertNull($result);
    }

    public function test_get_regions_in_default_locale()
    {
        $result = get_regions(['CA']);
        $this->assertContains(['value' => 'NS', 'label' => 'Nova Scotia'], $result);
    }

    public function test_get_regions_in_alternate_locale()
    {
        $result = get_regions(['CA'], 'fr');
        $this->assertContains(['value' => 'NS', 'label' => 'Nouvelle-Écosse'], $result);
    }

    public function test_get_region_codes()
    {
        $result = get_region_codes(['CA']);
        $this->assertContains('NS', $result);
    }

    public function test_get_locale_name()
    {
        $result = get_locale_name('fr');
        $this->assertEquals('French', $result);

        $result = get_locale_name('en', 'fr');
        $this->assertEquals('Anglais', $result);

        $result = get_locale_name('en', 'fr', false);
        $this->assertEquals('anglais', $result);

        $result = get_locale_name('zz');
        $this->assertNull($result);
    }
}
