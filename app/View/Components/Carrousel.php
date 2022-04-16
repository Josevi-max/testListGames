<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Http;
class Carrousel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $actualDate = date('Y-m-d');
        $lastYear = date('Y')-1;
        $callApi= Http::get("https://api.rawg.io/api/games?key=6c89b42c4215483c8ab7488dcafe2f2a&dates=${lastYear}-01-01,${actualDate}&ordering=-added");
        $listGames=$callApi->json();
        return view('components.carrousel', compact("listGames"));
    }
}
