<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TvShowsCard extends Component
{
    public $tvShow;

    /**
     * Create a new component instance.
     */
    public function __construct($tvShow)
    {
        $this->tvShow = $tvShow;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tv-shows-card');
    }
}
