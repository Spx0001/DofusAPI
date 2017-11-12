<?php

namespace dofus\controllers;

use dofus\models\Gift;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class GiftsController
{

    public function gifts(RequestInterface $request, ResponseInterface $response, $args)
    {
        $gifts = Gift::where('cmntt', '=', $args['cmntt'])->get();
        $str = 'c=' . count($gifts);
        $i = 1;
        foreach ($gifts as $gift) {
            $str .= "&d{$i}={$gift->description}&u{$i}={$gift->url}&g{$i}={$gift->gift}.swf";
            $i++;
        }
        return $str;
    }

}