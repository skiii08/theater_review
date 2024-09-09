<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;


class MovieSearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query', 'ハリーポッター');
        $client = new Client();
        $response = $client->request('GET', 'https://eiga.com/search/?q=' . urlencode($query));
        $html = $response->getBody()->getContents();
        
        $crawler = new Crawler($html);
        dd($crawler);
        $movies = $crawler->filter('.m-unit')->each(function (Crawler $node) {
            
            $title = $node->filter('.m-unit__title')->text();
            
            $link = $node->filter('.m-unit__link')->attr('href');
            return [
                'title' => $title,
                
                'link' => $link,
            ];
        });
        
        return view('scraping_results', ['movies' => $movies]);
}

}
