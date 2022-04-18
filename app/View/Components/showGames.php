<?php

namespace App\View\Components;

use Illuminate\View\Component;

class showGames extends Component
{
    public $search=[];
    public $sizePage;
    public $listsUser = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($search,$sizePage,$listsUser)
    {
        $this->search=$search;
        $this->sizePage=$sizePage;
        $this->listsUser=$listsUser;
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
