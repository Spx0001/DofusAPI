<?php

namespace dofus\controllers;

use dofus\models\ServerStatus;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class ServersController
{

    /**
     * STATUS_EVENT_1 : Problème résolu
     * STATUS_EVENT_2 : Redémarrage des serveurs
     * STATUS_PROBLEM_1 : Maintenance planifiée
     * STATUS_PROBLEM_2 : Latence élevée
     * STATUS_PROBLEM_3 : File d\'attente
     * STATUS_PROBLEM_4 : Crash serveur
     * STATUS_PROBLEM_5 : Coupure hébergeur
     * STATUS_STATE_1 : En traitement
     * STATUS_STATE_2 : Résolu
     * STATUS_STATE_3 : Résolu à la prochaine mise à jour
    */
    public function serverStatus(RequestInterface $request, ResponseInterface $response, $args)
    {
        $serverStatus = ServerStatus::where('cmntt', '=', $args['cmntt'])->get();
        $xml = '<?xml version="1.0" encoding="utf-8"?>';
        $xml .= '<serverstatus>';
            foreach ($serverStatus as $status) {
                $xml .= '<error id="' . $status->id . '" date="' . date('Ymd', strtotime($status->updated_at)) . '" state="' . $status->state . '" type="' . $status->type . '" visible="' . (($status->visible == 1) ? 'true' : 'false') . '">';
                    $all = (strcmp($status->servers, "all") == 0);
                    $xml .= '<servers cnx="' . (($status->cnx == 1) ? 'true' : 'false') . '" all="' . ($all ? 'true' : 'false') . '">';
                    if (!$all) 
                    {
                        $servers = explode(',', $status->servers);
                        foreach ($servers as $server)
                        {
                            $xml .= '<server name="' . $server . '" />';    
                        }
                    }
                    $xml .= '</servers>';

                    $problems = $status->getProblems()->get();
                    if (count($problems) > 0) 
                    {
                        $xml .= '<problems>';
                            foreach ($problems as $problem) 
                            {
                                $strtotime = strtotime($problem->updated_at);
                                $hours = (date('H', $strtotime) * 3600);
                                $minutes = (date('i', $strtotime) * 36);
                                $xml .= '<problem timestamp="' . (($hours + $minutes) * 1000) . '" id="' . $problem->event . '" translated="' . (($problem->translated == 1) ? 'true' : 'false') . '">';
                                    $xml .= $problem->comment;
                                $xml .= '</problem>';
                            }
                        $xml .= '</problems>';
                    }
                $xml .= '</error>';
            }
        $xml .= '</serverstatus>';

        $response = $response->withStatus(200)->withHeader('Content-Type', 'application/xml');
        $body = $response->getBody();
        $body->write($xml);
        return $response->getBody();
    }

}