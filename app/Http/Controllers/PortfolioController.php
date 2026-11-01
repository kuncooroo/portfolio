<?php

namespace App\Http\Controllers;

use App\Support\PortfolioPage;

class PortfolioController extends Controller
{
    public function index()
    {
        return view('portfolio', PortfolioPage::data());
    }
}
