<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Alert extends Component
{
    public $type;
    public $message;
    public $class;
    public $dismiss;

    /**
     * Create a new component instance.
     */
    public function __construct($type, $message, $class = null, $dismiss = null)
    {
        $this->type = $type;
        $this->message = $message;
        $this->class = $class;
        $this->dismiss = $dismiss;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alert');
    }
}



