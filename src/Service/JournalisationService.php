<?php


namespace App\Service;


use App\Entity\Journal;
use Doctrine\ORM\EntityManagerInterface;

class JournalisationService
{
    private $em;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->em = $manager;
    }

    public function journaliser($msg){

        $journal = new Journal();
        $date = new \DateTime();
        $result = $date->format('Y-m-d H:i:s');
        $journal->setMessage( "[$result] " . $msg );

        $this->em->persist( $journal );
        $this->em->flush();
    }
}