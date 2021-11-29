<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    /**
     * @Route("/program/", name="program_index")
     */

    public function index(): Response
    {
        return $this->render('program/index.html.twig', [
         ]);
        /*return new Response(
            '<html><style> body{background-color:black; color:white;}</style><body>Wild Series Index</body></html>'
        );*/
    }
}
