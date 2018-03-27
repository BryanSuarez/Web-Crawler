<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Articles;

class ScrapController extends Controller
{
    /**
     * Define my $vars
    */
    private $client;
    public $url;
    public $crawler;

    public function __construct(Articles $articles)
    {
        $this->articles = $articles;
    }

    public function index()
    {
        $articles  = collect($this->articles->getData());
        return view('crawler',compact('articles'));
    }

}
