<?php

namespace dofus\controllers;

use DateTime;
use dofus\models\RSS;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class RssController
{

    public function rss(RequestInterface $request, ResponseInterface $response, $args)
    {
        $withCmntt = ['Update', 'Contest', 'Sondage'];
        $newsRss = RSS::where('cmntt', '=', $args['cmntt'])->get();
        $rss = '<?xml version="1.0" encoding="utf-8"?>';
        $rss .= '<rss version="2.0">';
            $rss .= '<channel>';
                $rss .= '<title>RilynEmu</title>';
                $rss .= '<link>RilynEmu</link>';
                $rss .= '<description>RilynEmu émulateur Dofus 1.29 développé en JAVA</description>';
                foreach ($newsRss as $item) {
                    $rss .= '<item>';
                        $rss .= '<guid>' . $item->id . '</guid>';
                        $rss .= '<title>' . $item->title . '</title>';
                        $rss .= '<link>' . $item->link . '</link>';
                        $rss .= '<icon>News_' . $item->icon . (in_array($item->icon, $withCmntt) ? ('_' . $args['cmntt']) : '') . '</icon>';
                        $rss .= '<pubDate>' . date('r', strtotime($item->created_at)) . '</pubDate>';
                    $rss .= '</item>';
                }
            $rss .= '</channel>';
        $rss .= '</rss>';

        $response = $response->withStatus(200)->withHeader('Content-Type', 'application/rss+xml');
        $body = $response->getBody();
        $body->write($rss);
        return $response->getBody();
    }

}