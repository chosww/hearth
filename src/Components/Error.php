<?php

namespace Hearth\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class Error extends Component
{
    /**
     * The name of the associated form input.
     *
     * @var string
     */
    public $for;

    /**
     * The name of the field which produces the error, if different than the form input name.
     *
     * @var string
     */
    public $field;

    /**
     * The error bag to search for errors.
     *
     * @var string
     */
    public $bag;

    /**
     * Create a new component instance.
     *
     * @param string $for The name of the associated form input.
     * @param string $bag The error bag.
     *
     * @return void
     */
    public function __construct($for, $bag = 'default', $field = null)
    {
        $this->for = $for;
        $this->field = $field ?? $for;
        $this->bag = $bag;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('hearth::components.error');
    }
}
