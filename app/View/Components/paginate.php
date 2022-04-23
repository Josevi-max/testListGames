<?php

namespace App\View\Components;

use Illuminate\View\Component;

class paginate extends Component
{

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $search = [];
    public $specialSearch;
    public $sizePage;
    public $actualPage;
    public function __construct($search, $specialSearch, $sizePage, $actualPage)
    {
        $this->search=$search;
        $this->specialSearch=$specialSearch;
        $this->sizePage=$sizePage;
        $this->actualPage=$actualPage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.paginate');
    }
}
