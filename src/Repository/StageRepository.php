<?php

namespace App\Repository;

use App\Entity\Stage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Stage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stage[]    findAll()
 * @method Stage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stage::class);
    }

     /**
      * @return Stage[] Returns an array of Stage objects
      */
    
    public function fetchByEntreprise($nomEntreprise)
    {
        return $this->createQueryBuilder('s')
            ->join('s.entreprise','e')
            ->where('e.nom = :nomEntreprise')
            ->setParameter('nomEntreprise', $nomEntreprise)
            ->getQuery()
            ->getResult()
        ;
    }

    public function fetchByFormation($nomFormation)
    {
        //Récuperation du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        //Construction de la requète
        $requete = $gestionnaireEntite->createQuery(
                    'SELECT s
                    FROM App\Entity\Stage s
                    JOIN s.formations f
                    WHERE f.nomComplet = nomFormation');

                    $requete->setParameter('nomFormation',$nomFormation);

                    return $requete->execute();
                    
    }
    public function fetchStageEtEntreprise()
    {
        //Récuperation du gestionnaire d'entité
        $gestionnaireEntite = $this->getEntityManager();

        //Construction de la requète
        $requete = $gestionnaireEntite->createQuery(
                    'SELECT s,e,f
                    FROM App\Entity\Stage s
                    JOIN s.entreprise e
                    JOIN s.formations f
                    ORDER BY s.id');
        
            return $requete->execute();
                    
    }
    

    /*
    public function findOneBySomeField($value): ?Stage
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
