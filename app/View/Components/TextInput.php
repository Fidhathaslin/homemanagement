<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class textinput extends Component
{
  
    public function render(): View
    {
        return view('components.text-input');
    }
}
