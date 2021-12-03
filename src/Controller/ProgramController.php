<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Entity\Episode;


/**
 * @Route("/program", name="program_")
 */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     * 
     * @Route("/", name="index")
     * @return Response A response instance
     */

    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render('program/index.html.twig', [
            'programs' => $programs
         ]);
    }

    /**
     * Getting a program by id
     * @Route("/show/{id}/" , name="show")
     */

    public function show(Program $program): Response
    {
        $seasons = $this->getDoctrine()
        ->getRepository(Season::class)
        ->findBy(['program' => $program->getId()]);

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }

    /**
     * Getting a program and a season
     * @Route("/{program}/seasons/{season}", methods={"GET"} , name="season_show")
     */
    public function showSeason(Program $program, Season $season): Response
    {
        $episodes = $this->getDoctrine()
        ->getRepository(Episode::class)
        ->findBy(['season' => $season->getId()]);

        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episodes' => $episodes,
        ]);
    }

        /**
     * Getting a program, season and episode
     * @Route("/{program}/seasons/{season}/episode/{episode}", methods={"GET"} , name="episode_show")
     */
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {
        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }

}
