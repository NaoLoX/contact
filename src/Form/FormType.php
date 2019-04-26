<?php

namespace App\Form;

use App\Entity\Expediteurs;
use App\Repository\DepartementsRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormType extends AbstractType
{
    /**
     * @var DepartementsRepository
     */
    private $repository;

    public function __construct(DepartementsRepository $repository){
        $this->repository=$repository;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('mail',EmailType::class)
            ->add('message',TextAreaType::class)
            ->add('departement', ChoiceType::class,[
                'choices'=> $this->getChoices()
            ])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Expediteurs::class,
        ]);
    }

    /**
     * Fonction qui permet de génerer la liste déroulante dynamiquement
     * @return array
     */
    public function  getChoices(){
        $choices = $this->repository->findAll();
        $temp =[];
        $output =[];
        $i=1;
        foreach ($choices as $k){
           $temp[$i]=$k->getTitle();
           $i++;
        }
        foreach ($temp as $k =>$v){
            $output[$v]=$k;
        }
        return $output;

    }

}
