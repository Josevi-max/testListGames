<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
use Helpers\Api;
class Carrousel extends Component
{
    use Api;
    public $data = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data = '')
    {
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $sizePage = 10;
        return $this->search('Populares',$sizePage,'','components.carrousel');
    }
}
