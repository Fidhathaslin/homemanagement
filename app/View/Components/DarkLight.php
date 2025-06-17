<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DarkLight extends Component
{
  public function render(): View
    {
        return view('components.dark-light');
    }
}
