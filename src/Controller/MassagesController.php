<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Massages;

class MassagesController extends AbstractController
{
    #[Route('/massages', name: 'app_massages')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        
        // $entityManager = $this->getDoctrine()->getManager();

        // // Massage 1
        // $massage1 = new Massages();
        // $massage1->setName('Abdominal Massage');
        // $massage1->setDescription('Le massage abdominal post-partum offre plusieurs avantages essentiels pour les femmes après l\'accouchement. Il favorise la réduction de l\'enflure abdominale, soulage les tensions musculaires post-partum, améliore la circulation sanguine dans la région pelvienne, et contribue à la réparation des tissus abdominaux. De plus, ce massage favorise une meilleure relaxation et réduit le stress, contribuant ainsi au rétablissement global de la nouvelle maman.');
        // $massage1->setPrice(30.00);
        // $massage1->setPhoto('/images/abdos.jpg');
        // $massage1->setDuration(new \DateTime('00:30:00')); // 30 seconds
        // $entityManager->persist($massage1);

        // // Massage 2
        // $massage2 = new Massages();
        // $massage2->setName('Womb Massage');
        // $massage2->setDescription('Le massage de l\'utérus post-partum offre de multiples bienfaits aux nouvelles mères. Il contribue à réduire l\'enflure utérine, apaise les douleurs après l\'accouchement, et favorise l\'élimination des déchets utérins. En stimulant les contractions utérines, il encourage un retour plus rapide à la forme normale de l\'utérus. De plus, il aide à relâcher le stress et la tension, favorisant ainsi la détente des mamans en période post-partum.');
        // $massage2->setPrice(30.00);
        // $massage2->setPhoto('/images/wombmassage.jpg');
        // $massage2->setDuration(new \DateTime('00:45:00')); // 45 seconds
        // $entityManager->persist($massage2);

        // // Massage 3
        // $massage3 = new Massages();
        // $massage3->setName('Lymphatic Massage');
        // $massage3->setDescription('Un massage lymphatique post-partum est une technique de massage spécialisée et qui vise à stimuler le système lymphatique pour réduire le gonflement, favoriser la circulation lymphatique, aider à l\'élimination des toxines et accélérer le processus de récupération post-partum. Ce type de massage peut contribuer à soulager le gonflement et l\'inconfort post-accouchement et est souvent recherché par les femmes pendant la période post-partum.');
        // $massage3->setPrice(30.00);
        // $massage3->setPhoto('/images/lymph.jpg');
        // $massage3->setDuration(new \DateTime('01:00:00')); // 1 minute
        // $entityManager->persist($massage3);

        // // Massage 4
        // $massage4 = new Massages();
        // $massage4->setName('Himalayan Salt Massage');
        // $massage4->setDescription('Le massage au sel de l\'Himalaya présente plusieurs bienfaits, notamment l\'exfoliation naturelle de la peau, éliminant les cellules mortes et améliorant la texture de la peau. Les minéraux présents dans le sel de l\'Himalaya nourrissent la peau et peuvent aider à restaurer son équilibre naturel. Ce type de massage favorise la détente, réduit le stress et apporte une sensation de bien-être. De plus, il stimule la circulation sanguine, contribuant à une peau plus saine.');
        // $massage4->setPrice(30.00);
        // $massage4->setPhoto('/images/sel.jpg');
        // $massage4->setDuration(new \DateTime('00:45:00')); // 45 seconds
        // $entityManager->persist($massage4);

        // // Flush to save the massages to the database
        // $entityManager->flush();


        $massages = $entityManager->getRepository(Massages::class)->findAll();
        return $this->render('massages/massage.html.twig', ['massage' => $massages]);
    }


}