<?php
class Piece

{
	protected $lgn;
	protected $col;
	protected $piece;
	public $couleur;

	
	public function __construct($lgn,$col,$piece)
	{
		
		$this->lgn=$lgn;
		$this->col=$col;
		$this->piece=$piece;
		$this->couleur=$this->getCouleur($lgn,$col);
	}
	
	protected function getCouleur($lgn,$col)
	{
		if(isset($_SESSION['Jeu'][$lgn.''.$col]) and ($_SESSION['Jeu'][$lgn.''.$col]=="TB1" or $_SESSION['Jeu'][$lgn.''.$col]=="TB2"or 
		$_SESSION['Jeu'][$lgn.''.$col]=="CB" or	$_SESSION['Jeu'][$lgn.''.$col]=="DB" or $_SESSION['Jeu'][$lgn.''.$col]=="RB" 
		or $_SESSION['Jeu'][$lgn.''.$col]=="FB" or $_SESSION['Jeu'][$lgn.''.$col]=="PB" ))
		{
			return'B';
		}
		elseif(isset($_SESSION['Jeu'][$lgn.''.$col]))
		{
			return'N';
			
		}
	}
	public function roquer()
	{
		$TN1=new tour(1,1,'TN1');
		$TN2=new tour(1,8,'TN2');
		$RN=new roi(1,5,'RN');
		$TB1=new tour(8,1,'TB1');
		$TB2=new tour(8,8,'TB2');
		$RB=new roi(8,5,'RB');
		
		if($_SESSION['piece']=="TN1" and $_SESSION['Jeu'][15]=="RN")
		{
			if($_SESSION['deplacementTN1']==0 and $_SESSION['deplacementRN']==0)
			{
				if(isset($_SESSION['Jeu'][13]) and !empty($_SESSION['Jeu'][13]) or (isset($_SESSION['Jeu'][14]) and !empty($_SESSION['Jeu'][14])))
				{
					
				}
				elseif ($TN1->prenableEnemi('1','4','TN1',1) and $RN->prenableEnemi('1','3','RN',1))
				{
				return 1;	
				}
				
			}
		}
		elseif($_SESSION['piece']=="TN2" and $_SESSION['Jeu'][15]=="RN")
		{
			if($_SESSION['deplacementTN2']==0 and $_SESSION['deplacementRN']==0)
			{
				if((isset($_SESSION['Jeu'][17]) and $_SESSION['Jeu'][17]!="") or (isset($_SESSION['Jeu'][16]) and !empty($_SESSION['Jeu'][16])))
				{
					
				}
				elseif ($TN2->prenableEnemi('1','6','TN2',1) and $RN->prenableEnemi('1','7','RN',1))
				{
					return 2;
				}
				
			}
				
		}
		elseif($_SESSION['piece']=="RN" )
		{		
			if($_SESSION['deplacementTN1']==0 and $_SESSION['deplacementRN']==0)
			{
				if(isset($_SESSION['Jeu'][13]) and $_SESSION['Jeu'][13]!="" or( isset($_SESSION['Jeu'][14]) and $_SESSION['Jeu'][14]!="") and 
				$_SESSION['Jeu'][11]!="TN1" )
				{
					
				}
				elseif ($TN1->prenableEnemi('1','4','TN1',1) and $RN->prenableEnemi('1','3','RN',1))
				{
					return 1;
				}
			}
			if($_SESSION['deplacementTN2']==0 and $_SESSION['deplacementRN']==0)
			{
				if(isset($_SESSION['Jeu'][17]) and $_SESSION['Jeu'][17]!="" or(isset($_SESSION['Jeu'][16]) and $_SESSION['Jeu'][16]!="") and $_SESSION['Jeu']
				[18]!="TN2")
				{
					
				}
				elseif ($TN2->prenableEnemi('1','6','TN2',1) and $RN->prenableEnemi('1','7','RN',1))
				{
					return 2;
				}
			}
				
		}
		elseif($_SESSION['piece']=="TB1" and $_SESSION['Jeu'][85]=="RB")
		{
			if($_SESSION['deplacementTB1']==0 and $_SESSION['deplacementRB']==0)
			{
				if(isset($_SESSION['Jeu'][83]) and $_SESSION['Jeu'][83]!="" or(isset($_SESSION['Jeu'][84]) and $_SESSION['Jeu'][84]!=""))
				{
					
				}
				
				elseif ($TB1->prenableEnemi('8','4','TB1',1) and $RB->prenableEnemi('8','3','RB',1))
				{
					return 3;
				}
			}
				
		}
		elseif($_SESSION['piece']=="TB2" and $_SESSION['Jeu'][85]=="RB")
		{
			if($_SESSION['deplacementTB2']==0 and $_SESSION['deplacementRB']==0)
			{
				if(isset($_SESSION['Jeu'][87]) and $_SESSION['Jeu'][87]!="" or(isset($_SESSION['Jeu'][86]) and $_SESSION['Jeu'][86]!=""))
				{
					
				}
				elseif ($TB2->prenableEnemi('8','6','TB2',1) and $RB->prenableEnemi('8','7','RB',1))
				{
					return 4;
				}
			}
				
		}
			
		elseif($_SESSION['piece']=="RB")
		{
			if($_SESSION['deplacementTB1']==0 and $_SESSION['deplacementRB']==0)
			{
				if(isset($_SESSION['Jeu'][83]) and $_SESSION['Jeu'][83]!="" or(isset($_SESSION['Jeu'][84]) and $_SESSION['Jeu'][84]!="") and $_SESSION['Jeu'][81]!='TB1')
				{
					
				}
				elseif ($TB1->prenableEnemi('8','4','TB1',1) and $RB->prenableEnemi('8','3','RB',1))
				{
					return 3;
				}
			}
			
			if($_SESSION['deplacementTB2']==0 and $_SESSION['deplacementRB']==0)
			{
				if(isset($_SESSION['Jeu'][87]) and $_SESSION['Jeu'][87]!="" or(isset($_SESSION['Jeu'][86]) and $_SESSION['Jeu'][86]!="") and $_SESSION['Jeu'][81]!='TB2s')
				{
					
				}
				elseif ($TB2->prenableEnemi('8','6','TB2',1) and $RB->prenableEnemi('8','7','RB',1))
				{
					return 4;
				}
			}
				
		 }
	}
	
	public function prenableEnemi($lgn,$col,$piece,$numeroRecursivite)
	{
		// Cette methode teste si pour le deplacement d'une piece n'implique pas la mise en échec du roi
		// Elle renvoie true si le roi n'est PAS mis en échec
		// $numerorecursivite correspond au nombre de fois que la metode a été appelé et doit en dehors des classes des differeente piece être égale à 1
		// ????
		if($numeroRecursivite=='2')
		{
			return true;
		}
		elseif($numeroRecursivite=='1')
		{	
			$taille=0;
			$couleur=$this->getCouleur($_SESSION['ligne'],$_SESSION['colonne']);
			$jeuTemporaire=$_SESSION['Jeu'];
			
		if($piece=='RN' or $piece=='RB')
		{
			$positionRoiTemporaire=$_SESSION['positionRoi'];
			$_SESSION['positionRoi']=$lgn.''.$col;
		}
		$_SESSION['Jeu'][$lgn.''.$col]=$piece;
		$_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]="";
		$prenableEnemi=array();
		$prenableEnemi[0]=1;
		// On teste toutes les case de l'échéquier pour savoir si elles contiennent une piece énemi
		for($i=1;$i<=8;$i++)
		{
			for($j=1;$j<=8;$j++)
			{
				if(isset($_SESSION['Jeu'][$i.''.$j]) and ($_SESSION['Jeu'][$i.''.$j]!="")  and $couleur!=$this->getCouleur($i,$j) )
				{	
					if($this->getCouleur($i,$j)=='N')
					{
						switch($_SESSION['Jeu'][$i.''.$j])
						{
							case "PN":
								$element =new Pion($i,$j,"PN");
							break;
							case "CN":
								$element =new Cavalier($i,$j,"CN");
							break;
							case "DN":
								$element =new Dame($i,$j,"DN");
							break;
							case "RN":
								$element =new Roi($i,$j,"RN");
							break;
							case "FN":
								$element =new Fou($i,$j,"FN");
							break;
							case "TN1":
								$element =new Tour($i,$j,"TN1");
							break;
							case "TN2":
								$element =new Tour($i,$j,"TN2");
							break;
							default:
								echo 'Erreur prenableEnemi';
							break;
						}
					}	
					elseif($this->getCouleur($i,$j)=='B')
					{
						switch($_SESSION['Jeu'][$i.''.$j])
						{
							case "PB":
								$element =new Pion($i,$j,"PB");
							break;
							case "CB":
								$element =new Cavalier($i,$j,"CB");
							break;
							case "DB":
								$element =new Dame($i,$j,"DB");
							break;
							case "RB":
								$element =new Roi($i,$j,"RB");
							break;
							case "FB":
								$element =new Fou($i,$j,"FB");
							break;
							case "TB1":
								$element =new Tour($i,$j,"TB1");
							break;
							case "TB2":
								$element =new Tour($i,$j,"TB2");
							break;
							default:
								echo 'Erreur PrenableEnemi';
							break;
						}
					}
				// Si la position du roi est dans les piece prenable par l'énemi on stope la boucle 
				if(in_array($_SESSION['positionRoi'],$element->piecePrenable(2)))
				{
					$i=8;
					$j=8;
					$echec=true;
				}
	
				}
			}
		}
	$_SESSION['Jeu']=$jeuTemporaire;
	if($piece=='RN' or $piece=='RB')
	{
		$_SESSION['positionRoi']=$positionRoiTemporaire;
	}
	if(isset($echec) and $echec==true)
	{	
		false;
	}
	else
	{
		$_SESSION['Jeu']=$jeuTemporaire;
		return true;
	}


	}
else
{
	// echo 'Erreur $nombreRecursivite';
}
}
}


?>