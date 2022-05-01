<?php

namespace App\View\Components;

use Illuminate\View\Component;

class games extends Component
{
    public $search=[];
    public $sizePage;
    public $listsUser = [];
    public $actualPage;
    public $specialSearch;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($search,$sizePage,$listsUser,$actualPage = '',$specialSearch='')
    {
        $this->search=$search;
        $this->sizePage=$sizePage;
        $this->listsUser=$listsUser;
        $this->actualPage=$actualPage;
        $this->specialSearch=$specialSearch;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.show-games');
    }
}
