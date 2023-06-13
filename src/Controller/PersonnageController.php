<?php

namespace App\Controller;

class PersonnageController extends AbstractController
{
    public function getAllPersonnages()
    {
        $repo = new \App\Repository\PersonnageRepository(
            new \App\Factory\PDOFactory()
        );

        $allPerso = $repo->getAll();
        $data = [];
        if (isset($_GET['status'])) {
            $data['status'] = $_GET['status'];
        }

        $this->render("showAllPerso.php", "coucou les gens", ['data' => $data, "allPerso" => $allPerso]);
//        require_once dirname(__DIR__, 2) . "/templates/showAllPerso.php";
    }

    #[Route("/play/{id}", method: "POST")]
    public function faireBagarre(int $id)
    {
        $repo = new \App\Repository\PersonnageRepository(
            new \App\Factory\PDOFactory()
        );

        $allPerso = $repo->getAll();

        $me = array_filter($allPerso, function ($personnage) {
            return $personnage->getId() == $_GET['id'];
        });


        if (count($me) < 1) {
            throw new Exception("Not found");
        }

        $me = array_pop($me);

        $enemies = array_filter($allPerso, function ($personnage) {
            return $personnage->getId() != $_GET['id'];
        });

        $data = [];
        if (isset($_GET['status'])) {
            $data['status'] = $_GET['status'];
        }

        $this->render("play.php", "coucou les gens", ['data' => $data, "me" => $me, "enemies" => $enemies]);
//        require_once dirname(__DIR__, 2) . "/templates/play.php";
    }
}
