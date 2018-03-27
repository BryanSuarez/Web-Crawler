<?php
/**
 * Created by PhpStorm.
 * User: BRYAN SUAREZ
 * Date: 27/3/2018
 * Time: 0:18
 */

namespace App\Repositories;
use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;

class Articles
{
    public function getData()
    {
        $url = 'http://news.ycombinator.com/';
        $client = new Client();
        $crawler = $client->request('GET', $url);

        $titles = $crawler->filter('.title > .storylink')->each( function (Crawler $node) {
            return $node->text();
        });

        $rankings = $crawler->filter('span.rank')->each(function ($node) {
            return "#Order:".' '. $node->text();
        });

        $scores = $crawler->filter('td.subtext > span.score')->each(function ($node) {
            return "score". ' ' . $node->text();
        });

        $comments = $crawler->filter('td.subtext')->each(function ($node) {
            //delete strings to get only comments
            $onlyComment = trim(substr($node->text(), 50));
            $comment = trim(substr ($onlyComment, 0, strlen($onlyComment) - 10));
            //dd($onlyComment);
            return  $comment;
        });

        $posts = [];
        for ($i = 0; $i < count($titles); $i++){
            $posts[$i] = (object) [
                //'score'   => $scores[$i],
                'rank'    =>  $rankings[$i],
                'title'   =>  $titles[$i],
                'comments'   => $comments[$i],
            ];
        }

        return $posts;
    }
}