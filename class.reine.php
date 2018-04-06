<?php
class Dame extends Piece
{
	public function deplacementPossible()
	{
		$deplacement=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$nombreRecursivite=1;
		$taille=1;
		// On fait des boucles pour tester tout les sens et toutes les dirrections possible de déplacement
		for($i=1;$i<=8;$i++)
		{
			// Dès que l'on tombe sur une case occupée on arrête le boucle
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col+$i]) and ($_SESSION['Jeu'][$i+$lgn.''.$col+$i]!=""))
			{
				$i=8;
			}
			// Sinon on continue à entrer les déplacements possibles à la suite
			elseif($i+$lgn<=8 and $col+$i<=8 and $this->prenableEnemi($i+$lgn,$col+$i,$this->piece,1))
			{
				$taille++;
				$deplacement[$taille]=$i+$lgn.''.$col+$i;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col-$i]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col-$i]!=""))
			{
				$i=8;
			}
			elseif($col-$i>0 and -$i+$lgn>0 and $this->prenableEnemi(-$i+$lgn,$col-$i,$this->piece,1))
			{
				$taille++;
				$deplacement[$taille]=-$i+$lgn.''.$col-$i;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col+$i]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col+$i]!=""))
			{
			$i=8;
			}
			elseif(-$i+$lgn>0 and $col+$i<=8 and $this->prenableEnemi(-$i+$lgn,$col+$i,$this->piece,1))
			{
			$taille++;
			$deplacement[$taille]=-$i+$lgn.''.$col+$i;
			}	
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col-$i]) and ($_SESSION['Jeu'][$i+$lgn.''.$col-$i]!=""))
			{	
			$i=8;			
			}
			elseif($col-$i>0 and $i+$lgn<=8 and $this->prenableEnemi($i+$lgn,$col-$i,$this->piece,1))
			{
			$taille++;
			$deplacement[$taille]=$i+$lgn.''.$col-$i;
			}	
		}
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
		$prenable[1]=9; $prenable[2]="";$prenable[3]="";$prenable[4]="";$prenable[5]=""; $prenable[6]="";
		$prenable[7]="";$prenable[8]="";$prenable[9]="";
		// On teste les prises dans tout les sens/directions
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col+$i]) and ($_SESSION['Jeu'][$i+$lgn.''.$col+$i]!="") and $i+$lgn<=8 and $col+$i<=8)
			{
				// Si la case tesée est occupée un récupère la valeur de $i et on arrête la boucle
				$j=$i;
				$i=8;
				// on vérifie alors la pièce sur cette case est d'une couleur différente que la couleur de la pièce qui attaque
				// Le j est une variable intermédiaire car dans le cas ou on rencontre une case non vide $i=8;
				if($couleur!= $this->getCouleur($j+$lgn,$col+$j) and $this->prenableEnemi($j+$lgn,$col+$j,$this->piece,$nombreRecursivite))
				{
				$prenable[2]=$j+$lgn.''.$col+$j;
				}
			}
			
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col-$i]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col-$i]!="") and $col-$i>0 and -$i+$lgn>0) 
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur(-$j+$lgn,$col-$j) and $this->prenableEnemi(-$j+$lgn,$col-$j,$this->piece,$nombreRecursivite))
				{
				$prenable[3]=-$j+$lgn.''.$col-$j;
		
				}
			}
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col+$i]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col+$i]!="") and -$i+$lgn>0 and $col+$i<=8)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur(-$j+$lgn,$col+$j) and $this->prenableEnemi(-$j+$lgn,$col+$j,$this->piece,$nombreRecursivite))
				{
				$prenable[4]=-$j+$lgn.''.$col+$j;
		
				}
			}
		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$i+$lgn.''.$col-$i]) and ($_SESSION['Jeu'][$i+$lgn.''.$col-$i]!="") and $col-$i>0 and $i+$lgn<=8)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($j+$lgn,$col-$j) and $this->prenableEnemi($j+$lgn,$col-$j,$this->piece,$nombreRecursivite))
				{
				$prenable[5]=$j+$lgn.''.$col-$j;
		
				}
			}
		}
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][-$i+$lgn.''.$col]) and ($_SESSION['Jeu'][-$i+$lgn.''.$col]!="") and -$i+$lgn>0)
				{
				$j=$i;
				$i=8;
				if($couleur !=$this->getCouleur(-$j+$lgn,$col)and $this->prenableEnemi(-$j+$lgn,$col,$this->piece,$nombreRecursivite))
				{
				$prenable[6]=-$j+$lgn.''.$col;
				}
			}

		}
		
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col-$i]) and ($_SESSION['Jeu'][$lgn.''.$col-$i]!="") and $col-$i>0)
			{	$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($lgn,$col-$j) and $this->prenableEnemi($lgn,$col-$j,$this->piece,$nombreRecursivite))
				{
				$prenable[7]=$lgn.''.$col-$j;
		
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
				$prenable[8]=$j+$lgn.''.$col;
		
				}
			}

		}
		for($i=1;$i<=8;$i++)
		{
			if(isset($_SESSION['Jeu'][$lgn.''.$col+$i]) and ($_SESSION['Jeu'][$lgn.''.$col+$i]!="") and $col+$i<=8)
			{
				$j=$i;
				$i=8;
				if($couleur!= $this->getCouleur($lgn,$col+$j) and $this->prenableEnemi($lgn,$col+$j,$this->piece,$nombreRecursivite))
				{
				$prenable[9]=$lgn.''.$col+$j;
		
				}
			}
	
		}
		return $prenable;

		
	}
	
}
?>