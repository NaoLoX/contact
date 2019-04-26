<?php
namespace App\Controller;

use App\Entity\Expediteurs;
use App\Form\FormType;
use App\Notification\FormulaireNotification;
use App\Repository\DepartementsRepository;
use App\Repository\ExpediteursRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FormulaireController extends AbstractController {
    /**
     * @var ExpediteursRepository
     */
    private $Erepository;

    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * @var DepartementsRepository
     */
    private $Drepository;

    /**
     * FormulaireController constructor.
     * @param ExpediteursRepository $Erepository
     * @param ObjectManager $em
     * @param DepartementsRepository $Drepository
     */
    public function __construct(ExpediteursRepository $Erepository, ObjectManager $em, DepartementsRepository $Drepository)
    {
        $this->Erepository=$Erepository;
        $this->em=$em;
        $this->Drepository=$Drepository;
    }


    /**
     * @param Request $request
     * @param FormulaireNotification $notification
     * @return Response
     */
    public function index(Request $request, FormulaireNotification $notification):Response{

        $expediteur = new Expediteurs();

        $form = $this->createForm(FormType::class, $expediteur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->em->persist($expediteur);
            $this->em->flush();
            $this->addFlash('success','Votre formulaire à été envoyé avec succés' );
            $departement= $this->Drepository->find($expediteur->getDepartement());
            $notification->notify($expediteur,$departement);
        }


        return $this->render('pages/formulaire.html.twig',[
            'form' => $form->createView()
        ]);
    }
}