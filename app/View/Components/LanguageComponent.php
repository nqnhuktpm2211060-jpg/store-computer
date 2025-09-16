<?php

namespace App\View\Components;

use App\Models\Language;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LanguageComponent extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $languages = Language::OrderBy('name')->get();
        return view('components.language-component', compact('languages'));
    }
}
