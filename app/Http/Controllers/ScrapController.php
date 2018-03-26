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

        $titles = $crawler->filter('.title > .storylink')->each( function (Crawler $node) {
            return $node->text();
        });

        $rankings = $crawler->filter('span.rank')->each(function ($node) {
            return "Pedido:".' '. $node->text();
        });


        $scores = $crawler->filter('td.subtext > span.score')->each(function ($node) {
            return "score". ' ' . $node->text();
        });

        //dd($scores);

        $comments = $crawler->filter('td.subtext')->each(function ($node) {
            //delete strings to gen only comments
            $onlyComment = substr($node->text(), 55);
            $comment = trim(substr ($onlyComment, 0, strlen($onlyComment) - 22));
            return "comentarios".' '. $comment;
        });

        /*$posts = (object) [
            'titles'   => collect($titles),
        ];
        $ranks = (object)[
            'rankings' => collect($rankings)
        ];*/

        $posts = [];
        for ($i = 0; $i < count($titles); $i++){
          $posts[$i] = [
              //'score'   => $scores[$i],
              'rank'    =>  $rankings[$i],
              'title'   =>  $titles[$i],
              'comments'   => $comments[$i],
          ];
          //dd($posts[$i]);
        }

        dd(collect($posts));

        return view('crawler',compact('posts'));
    }

}
