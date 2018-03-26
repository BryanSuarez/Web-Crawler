<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use Session;

class ScrapController extends Controller
{
    /**
     * Define my $vars
    */
    private $client;
    public $url;
    public $crawler;
    public $filters;
    public $content = array();

    /*public function __construct(Client $client)
    {
        $this->client = $client;
    }*/

    public function index()
    {
        $url = 'http://news.ycombinator.com/';
        $client = new Client();
        $crawler = $client->request('GET', $url);


        /*$posts = $crawler->filter('.title a')->each(function (Crawler $node) {
            $title = $node->text()."\n";
            print $title;
            //code
            //endcode
        });*/

        /*$rank = $crawler->filter('span.rank')->each(function ($node) {
            print "Pedido:". ' ' .$node->text()."\n";
        });
        $titles = $crawler->filter('.title > a')->each(function ($node) {
            print "titulo". ' ' .$node->text()."\n";
        });
        $score = $crawler->filter('span.score')->each(function ($node) {
            print "score". ' ' . $node->text()."\n";
        });*/
        $comments = $crawler->filter('td.subtext')->each(function ($node) {
            print "comentarios". ' ' . $node->text()."\n";
        });
        //dd
        //dd($posts);


        return view('crawler',compact('comments'));
    }

}
