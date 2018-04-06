<?php
class echequier
{
	// $_SESSION['Jeu'][Ligne.''.Colonne];
	public function __construct()
	{
		if(isset($_SESSION['Jeu']))
		{
		
		}
		else
		{
			// On met les pièces a leur position pour commencer une partie
			$_SESSION['Jeu'][11]="TN1";
			$_SESSION['Jeu'][12]="CN";
			$_SESSION['Jeu'][13]="FN";
			$_SESSION['Jeu'][14]="DN";
			$_SESSION['Jeu'][15]="RN";
			$_SESSION['Jeu'][16]="FN";
			$_SESSION['Jeu'][17]="CN";
			$_SESSION['Jeu'][18]="TN2";
			
			$_SESSION['Jeu'][81]="TB1";
			$_SESSION['Jeu'][82]="CB";
			$_SESSION['Jeu'][83]="FB";
			$_SESSION['Jeu'][84]="DB";
			$_SESSION['Jeu'][85]="RB";
			$_SESSION['Jeu'][86]="FB";
			$_SESSION['Jeu'][87]="CB";
			$_SESSION['Jeu'][88]="TB2";
			 
			 // On initialise la poubelle
			$_SESSION['Poubelle']=array();
			$_SESSION['Poubelle'][1]=1;
			// $_SESSION['Poubelle'][1] Contient le nombre d'élément présents dans cette liste
			// On met les pions
			for($i=1;$i<=8;$i++)
			{
				$_SESSION['Jeu']['2'.$i]='PN';
				$_SESSION['Jeu']['7'.$i]='PB';
			}
			
			// On initialise le nombre de déplacements des differentes tour et rois pour pouvoir effectuer des tesst su ceux-ci pour roquer
			$_SESSION['deplacementTN1']=0;
			$_SESSION['deplacementTN2']=0;
			$_SESSION['deplacementRN']=0;
			$_SESSION['deplacementTB1']=0;
			$_SESSION['deplacementTB2']=0;
			$_SESSION['deplacementRB']=0;
			
			// On initialise les variables pour la gestion de l'historique
			$_SESSION['pageActuelle']=1;
			$_SESSION['tailleHistorique']=1;
			$_SESSION['Historique']=array();
			$_SESSION['Historique'][1]=$_SESSION['Jeu'];
			
			
		}
	}
	
	public function afficher($deplacementPossible,$piecePrenable,$validationRoquer)
	{
		if($_SESSION['pageActuelle']>1)
		{
		?><a href='redirecton.php?page=-1'><img src="pagePrecedente.png" class="image"/></a><?php
		}
		if($_SESSION ['pageActuelle']<$_SESSION['tailleHistorique'])
		{
		?><a href='redirecton.php?page=1'><img src="pageSuivante.jpg" class="image"/></a><?php
		}
		
		?><table><?php
		
		$lettre=['a','b','c','d','e','f','g','h'];
		
		// Boucle sur les lignes
		for($i=1;$i<=9;$i++)
		{?><tr><?php
			// Boucle sur les colonnes
			for($j=1;$j<=9;$j++)
				// Si on est sur la dernière ligne on affiche des lettres a,b,c...
				if($i==9 and $j!=9)
				{
					?><td class="colonne"><span class="poositionementCase" > <?php echo $lettre[$j-1]; ?> </span></td> <?php
				}
				elseif($i!=9 and $j==9)
				{
					?><td class="ligne"><span class="poositionementCase"> <?php echo 9-$i; ?> </span></td> <?php
				}
				else
				{	
					
					// Premet d'afficher un damier en utilisant les css
					if(($i+$j)%2==1 )
					{
						
						?><td class="noir"> <?php  $this->afficherPiece($i,$j,"Jeu"); $this->afficherDeplacement($i,$j,$deplacementPossible); $this->afficherPrenable($i,$j,$piecePrenable); ?> </td><?php
					}
					else
					{
						?><td> <?php $this->afficherPiece($i,$j,"Jeu"); $this->afficherDeplacement($i,$j,$deplacementPossible); $this->afficherPrenable($i,$j,$piecePrenable); ?> </td><?php
					}
				}
				
			}
		?></tr><?php
		
		
		?></table><?php
		// On affiche si elle existe la possibilité roquer
		for($i=1;$i<=4;$i++)
		{
		if($validationRoquer==$i)
		{
			?><a href="redirecton.php?roque=<?php echo $i; ?>"><img src="roque<?php echo $i;?>.png" class="roque"> </a><?php
		}
		}
		
	}
	
	private function afficherPiece($i,$j,$nomliste)
	{
		// $nomliste vaudra Jeu ou Poubelle en fonction de ce que l'on veut lire
		if(isset($_SESSION['Jeu'][$i.''.$j]) and $nomliste=="Jeu")
		{
			$piece=$_SESSION['Jeu'][$i.''.$j];
			if(isset($piece))
			{
				if($piece=="PN")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=PN"><img src="PN.png" class="piece" /> </a><?php
				}
				elseif($piece=="TN1")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=TN1"><img src="TN.png" class="piece" /> </a><?php
				}
				elseif($piece=="TN2")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=TN2"><img src="TN.png" class="piece" /> </a><?php
				}
				elseif($piece=="CN")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=CN"><img src="CN.png" class="piece" /> </a><?php
				}
				elseif($piece=="FN")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=FN"><img src="FN.png" class="piece" /> </a><?php
				}
				elseif($piece=="DN")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=DN"><img src="DN.png" class="piece" /> </a><?php
				}
				elseif($piece=="RN")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=RN"><img src="RN.png" class="piece" /> </a><?php
				}
				elseif($piece=="PB")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=PB"><img src="PB.png" class="piece" /> </a><?php
				}
				elseif($piece=="TB1")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=TB1"><img src="TB.png" class="piece" /> </a><?php
				}
				elseif($piece=="TB2")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=TB2"><img src="TB.png" class="piece" /> </a><?php
				}	
				elseif($piece=="CB")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=CB"><img src="CB.png" class="piece" /> </a><?php
				}
				elseif($piece=="FB")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=FB"><img src="FB.png" class="piece" /> </a><?php
				}
				elseif($piece=="DB")
				{
				?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=DB"><img src="DB.png" class="piece" /> </a><?php
				}
				elseif($piece=="RB")
				{
					?><a href="redirecton.php?colonne=<?php echo $j ;?>&ligne=<?php echo $i;?>&piece=RB"><img src="RB.png" class="piece" /> </a><?php
				}
			}
		}
		// Dans le cas de la lecture de poubelle on n'indexe Poubelle que grâce à un $j
		elseif(isset($_SESSION['Poubelle']) and $nomliste=="PoubelleB")
		{
			$piece=$_SESSION['Poubelle'][$j];
			if(isset($piece))
			{
				if($piece=="PB")
				{
					?><img src="PB.png" class="piece" /><?php
				}
				elseif($piece=="TB1")
				{
					?><img src="TB.png" class="piece" /><?php
				}
				elseif($piece=="TB2")
				{
					?><img src="TB.png" class="piece" /><?php
				}
				elseif($piece=="CB")
				{
					?><img src="CB.png" class="piece" /><?php
				}
				elseif($piece=="FB")
				{
					?><img src="FB.png" class="piece" /><?php
				}
				elseif($piece=="DB")
				{
				?><img src="DB.png" class="piece" /><?php
				}
				elseif($piece=="RB")
				{
					?><img src="RB.png" class="piece" /><?php
				}
			}
					
		
		}
		elseif(isset($_SESSION['Poubelle']) and $nomliste=="PoubelleN")
		{
			$piece=$_SESSION['Poubelle'][$j];
			if(isset($piece))
			{
				if($piece=="PN")
				{
					?><img src="PN.png" class="piece" /><?php
				}
				elseif($piece=="TN1")
				{
					?><img src="TN.png" class="piece" /><?php
				}
				elseif($piece=="TN2")
				{
					?><img src="TN.png" class="piece" /><?php
				}
				elseif($piece=="CN")
				{
					?><img src="CN.png" class="piece" /><?php
				}
				elseif($piece=="FN")
				{
					?><img src="FN.png" class="piece" /><?php
				}
				elseif($piece=="DN")
				{
				?><img src="DN.png" class="piece" /><?php
				}
				elseif($piece=="RN")
				{
					?><img src="RN.png" class="piece" /><?php
				}
			}
				
		}
	}
	
	private function afficherDeplacement($lgn,$col,$deplacement)
	{
		$position=$lgn.''.$col;
		
		if(isset($deplacement[1]))
		{
			
			if(isset($_SESSION['Jeu'][$position]) and !empty($_SESSION['Jeu'][$position]))
			{
				
			}

			elseif(in_array($position,$deplacement))
			{
				
				 ?><span class="deplacementPossible"><a href="redirecton.php?deplacementColonne=<?php echo $col;?>&deplacementLigne=<?php echo $lgn;?>"><img src="deplacement.png" class="imageIndication"/></a> </span><?php
			}
		}
		}
				
	
	private function afficherPrenable($lgn,$col,$prenable)
	{
		$position=$lgn.''.$col;
		
		if(isset($prenable[1]))
		{	
			for($i=2;$i<=$prenable[1];$i++)
			{
				if($prenable[$i]==$position)
				{
					?><span class="deplacementPossible"><a href="redirecton.php?prendreColonne=<?php echo $col;?>&prendreLigne=<?php echo $lgn;?>"><span class="prenable"> <img src="prise.png" class="imageIndication"/></span></a> </span><?php
				}
			}
		}
	}
	public function mouvement($piece)
	{
		if($piece=="TN1")
		{
			$_SESSION['deplacementTN1']++;
		}
		elseif($piece=="TN2")
		{
			$_SESSION['deplacementTN2']++;
		}
		elseif($piece=="RN")
		{
			$_SESSION['deplacementRN']++;
		}
		if($piece=="TB1")
		{
			$_SESSION['deplacementTB1']++;
		}
		elseif($piece=="TB2")
		{
			$_SESSION['deplacementTB2']++;
		}
		elseif($piece=="RB")
		{
			$_SESSION['deplacementRB']++;
		}
	}
	public function afficherPoubelle()
	{
		// Deux boucles pour afficher les de manière séparée les pièces B ou N de Poubelle
		?><h3 class="titrePoubelle"></h3><span class="poubelle"><?php //?????
		for ($i=1;$i<=$_SESSION['Poubelle'][1];$i++)
		{
			 $this->afficherPiece(0,$i,"PoubelleN"); 
		}
		for ($i=1;$i<=$_SESSION['Poubelle'][1];$i++)
		{
			 $this->afficherPiece(0,$i,"PoubelleB"); 
		}
		?></span><?php
	}
	
	public function promotionPion()
	{
		if(isset($_SESSION['deplacementLigne']) and isset($_SESSION['colonne']) and isset($_SESSION['piece']))
		{
			if($_SESSION['piece']=="PB" and $_SESSION['deplacementLigne']==1)
			{
					?>
					<h3>Promotion du pion</h3>
					<table>
					<td><a href="redirecton.php?promotion=TB1&ligne=1&piece=<?php echo $_SESSION['piece'];?>&colonne=<?php echo $_SESSION['colonne']; ?>"> <img src="tourBlanche.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=DB&ligne=1&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>"> <img src="reineBlanche.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=CB&ligne=1&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>">  <img src="cavalierBlanc.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=FB&ligne=1&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>"> <img src="fouBlanc.png" class="piece"/></a></td>
					<?php
			}
			if($_SESSION['piece']=="PN" and $_SESSION['deplacementLigne']==8)
			{
				?>
				<h3>Promotion du pion</h3>
					<table>
					<td><a href="redirecton.php?promotion=TN1&ligne=8&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>">  <img src="tourNoir.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=DN&ligne=8&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>">  <img src="reineNoir.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=CN&ligne=8&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>">  <img src="cavalierNoir.png" class="piece"/></a></td>
					<td><a href="redirecton.php?promotion=FN&ligne=8&piece=<?php echo $_SESSION['piece']; ?>&colonne=<?php echo $_SESSION['colonne']; ?>">  <img src="fouNoir.png" class="piece"/></a></td>
					<?php
			}
				
			}
		}
	}
	

?>