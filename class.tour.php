<?php
class Tour extends Piece 
{
	
	public function deplacementPossible()
	{
		$deplacement=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$taille=1;
		// $taille correspond au nombre de déplacement pouvant être effectué par la tour
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col]!=""))
			{
			
				$i=8;
			}
			elseif(-$i+$lgn>0 and $this->prenableEnemi(-$i+$lgn,$col,$this->piece,1))
			{
				$taille++;
				$deplacement[$taille]=-$i+$lgn.''.$col;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col-$i]) and ($_SESSION['Jeu'][$lgn.''.$col-$i]!=""))
			{
				$i=8;
			}
			elseif($col-$i>0 and $this->prenableEnemi($lgn,$col-$i,$this->piece,1))
			{
				$taille++;
				$deplacement[$taille]=$lgn.''.$col-$i;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col]) and ($_SESSION['Jeu'][$i+$lgn.''.$col]!=""))
			{
			$i=8;
			}
			elseif($i+$lgn<=8 and $this->prenableEnemi($i+$lgn,$col,$this->piece,1))
			{
			$taille++;
			$deplacement[$taille]=$i+$lgn.''.$col;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col+$i]) and ($_SESSION['Jeu'][$lgn.''.$col+$i]!=""))
			{	
			$i=8;			
			}
			elseif($col+$i<=8 and $this->prenableEnemi($lgn,$col+$i,$this->piece,1))
			{
			$taille++;
			$deplacement[$taille]=$lgn.''.$col+$i;
			}	
		}
		
		$deplacement[1]=$taille;
		return $deplacement;
	}
	public function piecePrenable($nombreRecursivite)
	{
		$prenable=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$couleur=$this->getCouleur($lgn,$col);
		$prenable[1]=5;  $prenable[2]="";$prenable[3]="";$prenable[4]="";$prenable[5]="";
		
	for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col]!="") and -$i+$lgn>0)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur(-$j+$lgn,$col)and $this->prenableEnemi(-$j+$lgn,$col,$this->piece,$nombreRecursivite))
				{
				$prenable[2]=-$j+$lgn.''.$col;
				}
			}

		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col-$i]) and ($_SESSION['Jeu'][$lgn.''.$col-$i]!="") and $col-$i>0)
			{	$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($lgn,$col-$j)and $this->prenableEnemi($lgn,$col-$j,$this->piece,$nombreRecursivite))
				{
				$prenable[3]=$lgn.''.$col-$j;
		
				}
			}

		
		}
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col]) and ($_SESSION['Jeu'][$i+$lgn.''.$col]!="") and $i+$lgn<=8)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($j+$lgn,$col) and $this->prenableEnemi($j+$lgn,$col,$this->piece,$nombreRecursivite))
				{
				$prenable[4]=$j+$lgn.''.$col;
		
				}
			}

		}
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col+$i]) and ($_SESSION['Jeu'][$lgn.''.$col+$i]!="") and $col+$i<=8)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($lgn,$col+$j)and $this->prenableEnemi($lgn,$col+$j,$this->piece,$nombreRecursivite))
				{
				$prenable[5]=$lgn.''.$col+$j;
		
				}
			}
	
		}
		return $prenable;
		
		
	}
	
}
?>