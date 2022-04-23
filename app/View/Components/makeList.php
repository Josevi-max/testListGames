<?php

namespace App\View\Components;

use Illuminate\View\Component;

class makeList extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

     public $id;
     public $listsUser = [];
     public $actualPage;
     public $specialSearch;
     public $sizePage;
    public function __construct($id,$listsUser,$actualPage = '', $specialSearch = '', $sizePage = '')
    {
        $this->id = $id;
        $this->listsUser = $listsUser;
        $this->actualPage=$actualPage;
        $this->specialSearch=$specialSearch;
        $this->sizePage=$sizePage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.make-list');
    }
}
