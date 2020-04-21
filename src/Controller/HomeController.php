<?php

namespace App\Controller;

use App\Model\KittenManager;
use App\Model\PartyManager;

class HomeController extends AbstractController
{

    public function index()
    {
        $kittenManager = new KittenManager();
        $kittens = $kittenManager->selectAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if(count($_POST['checkbox']) === 2 ){
                
                $party = [
                    'player_1_id' => $_POST['checkbox'][0],
                    'player_2_id' => $_POST['checkbox'][1],
                ];
                $partyManager = new PartyManager;
                $party = $partyManager->insert($party);
                return $this->twig->render('Home/party.html.twig', ['party' => $party]);
            }
        }

        return $this->twig->render('Home/index.html.twig', ['kittens' => $kittens]);
    }

    public function stats($id)
    {
        $kittenManager = new KittenManager();
        $stats = $kittenManager->selectKittenStats($id);
        return $this->twig->render('Home/stats.html.twig', ['stats' => $stats]);
    }
}
