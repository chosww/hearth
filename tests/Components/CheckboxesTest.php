<?php

namespace Hearth\Tests\Components;

use Hearth\Components\Checkboxes;
use Hearth\Tests\TestCase;

class CheckboxesTest extends TestCase
{
    public function test_checkboxes_component_renders()
    {
        $view = $this->withViewErrors([])
            ->component(
                Checkboxes::class,
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => 'Vanilla',
                        'chocolate' => 'Chocolate',
                    ],
                ],
            );

        $view->assertSee('id="flavour-chocolate"', false);
        $view->assertSee('id="flavour-vanilla"', false);
    }

    public function test_checkboxes_component_references_hint()
    {
        $view = $this->withViewErrors([])
            ->component(
                Checkboxes::class,
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => 'Vanilla',
                        'chocolate' => 'Chocolate',
                    ],
                    'hinted' => true,
                ],
            );

        $view->assertSee('aria-describedby="flavour-hint"', false);
    }

    public function test_checkboxes_component_references_custom_hint()
    {
        $view = $this->withViewErrors([])
            ->component(
                Checkboxes::class,
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => 'Vanilla',
                        'chocolate' => 'Chocolate',
                    ],
                    'hinted' => 'favourite-flavour-hint',
                ],
            );

        $view->assertSee('aria-describedby="favourite-flavour-hint"', false);
    }

    public function test_checkboxes_reference_individual_hints()
    {
        $view = $this->withViewErrors([])
            ->component(
                Checkboxes::class,
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => [
                            'label' => 'Vanilla',
                            'hint' => 'Rich and delicate.',
                        ],
                        'chocolate' => [
                            'label' => 'Chocolate',
                            'hint' => 'Decadent and delicious.',
                        ],
                    ],
                    'hinted' => 'favourite-flavour-hint',
                ],
            );

        $view->assertSee('aria-describedby="flavour-chocolate-hint favourite-flavour-hint"', false);
        $view->assertSee('aria-describedby="flavour-vanilla-hint favourite-flavour-hint"', false);
    }

    public function test_checkboxes_component_includes_attribute()
    {
        $view = $this->withViewErrors([])
            ->blade(
                '<x-hearth-checkboxes :name="$name" :options="$options" x-model="flavours" />',
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => 'Vanilla',
                        'chocolate' => 'Chocolate',
                    ],
                ],
            );

        $view->assertSee('x-model="flavours"', false);
    }

    public function test_checkboxes_component_includes_checked_item()
    {
        $view = $this->withViewErrors([])
            ->blade(
                '<x-hearth-checkboxes :name="$name" :options="$options" :checked="$checked" />',
                [
                    'name' => 'flavour',
                    'options' => [
                        'vanilla' => 'Vanilla',
                        'chocolate' => 'Chocolate',
                    ],
                    'checked' => ['vanilla'],
                ],
            );

        $view->assertSee('value="vanilla"  checked', false);
        $view->assertDontSee('value="chocolate"  checked', false);
    }
}
