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
    public function __construct($id,$listsUser)
    {
        $this->id = $id;
        $this->listsUser = $listsUser;
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
