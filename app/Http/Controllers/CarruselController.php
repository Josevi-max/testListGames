<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helpers\Api;
class CarruselController extends Controller
{
    use Api;
    public function load($category) {
        $sizePage = 10;
        $dataCarrusel = $this->search($category,$sizePage);
        return redirect()->route('home.index')->with("dataCarrusel",$dataCarrusel); ;
    }
}
