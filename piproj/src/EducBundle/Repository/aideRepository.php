<?php

namespace EducBundle\Repository;

/**
 * aideRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class aideRepository extends \Doctrine\ORM\EntityRepository
{

    public function returnAll(){
        $query=$this->getEntityManager()
            ->createQuery("SELECT `idPub` ,`datepub`,`description` ,`document` ,`section` ,`matiere` ,`idUsr` ,'aide'as type FROM aide
UNION 
SELECT `titre` ,`DESCRIPTION` ,`LIEU` ,`LOYERMENSUEL` ,`NBCHAMBRE` ,`DATEDISPONIBILITE` ,'', 'colocation' 
from Colocation
UNION
SELECT `ID_PUB` ,`LIEUDEPART` ,`LIEUARRIVE` ,`DATEDEPART` ,`DESCRIPTION` ,`NBPLACE` ,`PRIX`, 'covoiturage'as type 
from covoiturage
UNION
SELECT `ID_PUB` ,`DESCRIPTION` ,`NOM_EVENT` ,`place_dispo` ,`LIEU` ,`DATEDEBUT` ,`DATEFIN` , 'evenement' as type
from evenements");
return $query->getResult();
    }

    public function findEquipeDql($mot){

        $query=$this->getEntityManager()
            ->createQuery("Select e From EducBundle:Aide e 
                Where e.description Like :mot 
                OR e.document LIKE :mot
                OR e.section LIKE :mot
                OR e.matiere LIKE :mot  ")
            ->setParameter('mot','%'.$mot.'%');
        return $query->getResult();

    }
}

