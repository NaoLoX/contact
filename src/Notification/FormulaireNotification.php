<?php

namespace App\Notification;

use App\Entity\Expediteurs;
use Twig\Environment;
use App\Entity\departements;

class FormulaireNotification{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Environment
     */
    private $renderer;

    /**
     * FormulaireNotification constructor.
     * @param \Swift_Mailer $mailer
     * @param Environment $renderer
     */
    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->mailer=$mailer;
        $this->renderer=$renderer;
    }

    /**
     * @param Expediteurs $expediteurs
     * @param departements $departements
     */
    public function notify(Expediteurs $expediteurs, Departements $departements){
        $message = (new \Swift_Message('Formulaire de contact'))
            ->setFrom($expediteurs->getMail())
            ->setTo($departements->getMail1())
            ->setReplyTo($expediteurs->getMail())
            ->setBody(
                $this->renderer->render('emails/mail.html.twig',[
                    "expediteur"=>$expediteurs
                ]),'text/html');
            $this->mailer->send($message);
    }
}