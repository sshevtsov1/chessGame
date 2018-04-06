<?php
class Ordinateur
{
	private $couleur;
	private $disipationEnemi;
	private $disipationOrdi;
	private $jeuPossible;
	private $jeuTemporaire;
	
	
	public function __construct($couleurOrdi)
	{
		$this->couleur=$couleurOrdi;
		$this->jeuTemporaire=$_SESSION['Jeu'];
	}
		
	public function choisirCoup()
	{
		
		
	}
	private function getDisipation($type)
	{
		
		
	}
	
	private function getPrenableEnemi()
	{
		// Boucle sur les lignes
		for($i=1;$i<=8;$i++)
		{
			// Boucles sur les colonnes
			for($j=1;$j<=8;$j++)
			{
				$piece= $this->creationPiece($i,$j,$_SESSION['piece']);
				if($piece->couleur!=$couleur)
				{
					
				}
			
			}
		}
		
	}
	private function creationPiece($lgn,$col,$piece)
	{
		if($piece=="PN" or $piece=="PB")
		{		
			return $piece=new Pion($lgn,$col,$piece);
		}
		if($piece=="TN1" or $piece=="TN2" or $piece=="TB1" or $piece=="TB2")
		{
			return $piece=new Tour($lgn,$col,$piece);
		}
		if($piece=="DN" or $piece=="DB")
		{
			return $piece=new Dame($lgn,$col,$piece);
		}
		if($piece=="FN" or $piece=="FB")
		{
			return $piece=new Fou($lgn,$col,$piece);
		}
		if($piece=="CN" or $piece=="CB")
		{
			return $piece=new Cavalier($lgn,$col,$piece);
		}
		if($piece=="RN" or $piece=="RB")
		{
			return $piece=new Roi($lgn,$col,$piece);
		}
		if($piece=="PN" or $piece=="PB")
		{
			return $piece=new Pion($lgn,$col,$piece);
		}
	}

}
?>