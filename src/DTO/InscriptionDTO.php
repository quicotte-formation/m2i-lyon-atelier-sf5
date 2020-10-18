<?php


namespace App\DTO;


use Symfony\Component\Validator\Constraints as Assert;

class InscriptionDTO
{
    /**
     * @Assert\NotBlank
     * @Assert\NotNull
     * @Assert\Length(min="4", max="6")
     */
    private $mdp1;


    private $mdp2;
    private $pseudo;

    /**
     * @return mixed
     */
    public function getMdp1()
    {
        return $this->mdp1;
    }

    /**
     * @param mixed $mdp1
     */
    public function setMdp1($mdp1): void
    {
        $this->mdp1 = $mdp1;
    }

    /**
     * @return mixed
     */
    public function getMdp2()
    {
        return $this->mdp2;
    }

    /**
     * @param mixed $mdp2
     */
    public function setMdp2($mdp2): void
    {
        $this->mdp2 = $mdp2;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }

    /**
     * @param mixed $pseudo
     */
    public function setPseudo($pseudo): void
    {
        $this->pseudo = $pseudo;
    }


}