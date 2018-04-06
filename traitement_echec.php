<?php
session_start();

include_once('class.piece.php');
include_once('class.echequier.php');
 require 'class.roi.php';
 require 'class.reine.php';
 require 'class.fou.php'; 
 require 'class.cavalier.php';
 require 'class.tour.php';
 require 'class.pion.php'; 
 require 'class.ordinateur.php'; 

 
if(isset($_POST['cancel']))
{
	// On supprime toutes les variables session
	unset($_SESSION['Jeu']);
	unset($_SESSION['deplacementColonne']);
	unset($_SESSION['deplacementLigne']);
	unset($_SESSION['ligne']);
	unset($_SESSION['colonne']);
	unset($_SESSION['piece']);
	unset($_SESSION['prendreColonne']);
	unset($_SESSION['prendreLigne']);
	unset($_SESSION['pageActuelle']);
	unset($_SESSION['page']);
	unset($_SESSION['Historique']);
	unset($_SESSION['tailleHistorique']);
}
// On crée un nouvel échequier
$echequier=new Echequier();
// En fonction des differentes variables session qui sont crées dans le fichier redirecton.php on effectue differentes actions prie d'une piece roque ...

if(isset($_SESSION['ordinateur']))
{
	$ordinateur=new Ordinateur($_SESSION['ordinateur']);
	$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
	$echequier->afficherPoubelle();
	unset($_SESSION['ordinateur']);
	
}
// Si on veut utiliser l'historique pour faire un retour en arrière
elseif(isset($_SESSION['page']))
{
	// $_SESSON['pageActuelle'] contient le numero de la page dans l'historique
	if($_SESSION['page']==-1)
	{	
		unset($_SESSION['ligne']);
		unset($_SESSION['colonne']);
		unset($_SESSION['piece']);	
		$_SESSION['pageActuelle']--;
		transformationListe();
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
		$echequier->afficherPoubelle();
	}
	if($_SESSION['page']==1)
	{
		$_SESSION['pageActuelle']++;
		transformationListe();
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
		$echequier->afficherPoubelle();
	}
	
unset($_SESSION['page']);	
}

elseif(isset($_SESSION['deplacementColonne']) and isset($_SESSION['deplacementLigne']) and isset($_SESSION['ligne']) and isset($_SESSION['colonne']) and isset($_SESSION['piece']))
  {	
	// La fonction creation piece permet d'instancer la classe de la pièce dont il est question pion reine ... il utilise la variable $_SESSION['piece']
	$piece=creationPiece();
	$deplacementPossibles=$piece->deplacementPossible();
	// On vérifie que les variables session sont exactes (ceci devrait être dans recirecton.php)
	$position=$_SESSION['ligne'].''.$_SESSION['colonne'];
	$verification;
	$positionDeplacement=$_SESSION['deplacementLigne'].''.$_SESSION['deplacementColonne'];
	for ($i=2;$i<=$deplacementPossibles[1];$i++)
	{
		if($deplacementPossibles[$i]==$positionDeplacement and $_SESSION['Jeu'][$position]==$_SESSION['piece'])
		{
			$verification=true;
		}
	}
	if(isset($verification) and $verification )
	{
		// On met la pièce a la nomvelle position et on suprime la pièce de son ancien emplacement
		$_SESSION['Jeu'][$_SESSION['deplacementLigne'].''.$_SESSION['deplacementColonne']]=$_SESSION['piece'];
		$_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]="";
		// Pour que l'on ne puisse pas chequer après que un des roi ou la tour ait été déplacé
		$echequier->mouvement($_SESSION['piece']);
		$echequier->promotionPion();
		$_SESSION['tailleHistorique']++;
		$_SESSION['pageActuelle']++;
		$_SESSION['positionRoi']=positionRoi($piece->couleur);
		$_SESSION['Historique'][$_SESSION['tailleHistorique']]=$_SESSION['Jeu'];
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
		$echequier->afficherPoubelle();
	}
	else
	{
		echo'erreur URL';
	}
	// On suprime les variables seession pour ne pas boucler sur la même action
	unset($_SESSION['deplacementColonne']);
	unset($_SESSION['deplacementLigne']);
	unset($_SESSION['ligne']);
	unset($_SESSION['colonne']);
	unset($_SESSION['ligne']);
	unset($_SESSION['piece']);
}

// Si on veut prendre une autre pièce
elseif(isset($_SESSION['prendreColonne']) and isset($_SESSION['prendreLigne']) and isset($_SESSION['ligne']) and isset($_SESSION['colonne'])and isset($_SESSION['ligne']) and isset($_SESSION['piece']))
{
	// $_SESSION['prendreLigne'] correspond au numero de la ligne de la pièce que l'on prend 
	// $_SESSION['prendreColonne'] correspond au numero de la colonn de la pièce que l'on prend
	$piece=creationPiece();
	$piecePrenable=$piece->piecePrenable(1);
	$position=$_SESSION['ligne'].''.$_SESSION['colonne'];
	$positionPrise=$_SESSION['prendreLigne'].''.$_SESSION['prendreColonne'];
	for ($i=2;$i<=$piecePrenable[1];$i++)
	{
		if($piecePrenable[$i]==$positionPrise and $_SESSION['Jeu'][$position]==$_SESSION['piece'])
		{
			$verification=true;
		}
	}
	if(isset($verification) and $verification )
	{
		// On modifie la poubelle, et $_SESSION['Poubelle'][1] correpond au nombre d'éléments dans cette liste
		$taillePoubelle=$_SESSION['Poubelle'][1];
		$_SESSION['Poubelle'][$taillePoubelle+1]=$_SESSION['Jeu'][$_SESSION['prendreLigne'].''.$_SESSION['prendreColonne']];
		$_SESSION['Poubelle'][1]+=1;
		
		// On met la pièce a la nouvelle position et on suprime la pièce de son ancien emplacement
		$_SESSION['Jeu'][$_SESSION['prendreLigne'].''.$_SESSION['prendreColonne']]=$_SESSION['piece'];
		$_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]="";
		
		// Pour que l'on ne puisse pas chequer après que un des roi ou la tour ait été déplacé
		$echequier->mouvement($_SESSION['piece']);
		$_SESSION['tailleHistorique']++;
		$_SESSION['pageActuelle']++;
		$_SESSION['Historique'][$_SESSION['tailleHistorique']]=$_SESSION['Jeu'];
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
		$echequier->afficherPoubelle();
		
	}
	else{
		echo'Erreur URL';
	}
	unset($_SESSION['prendreColonne']);
	unset($_SESSION['prendreLigne']);
	unset($_SESSION['ligne']);
	unset($_SESSION['colonne']);
	unset($_SESSION['piece']);	
}
// Si on veur Roquer
elseif(isset($_SESSION['roque']))
{
	// $_SESSION['roque'] contient le numero du roque possible 
	if($_SESSION['roque']==1)
	{
			$_SESSION['Jeu'][13]="RN";
			$_SESSION['Jeu'][14]="TN1";
			$_SESSION['Jeu'][11]="";
			$_SESSION['Jeu'][15]="";
			$_SESSION['deplacementRN']++;
			$_SESSION['deplacementTN1']++;
	}
	elseif($_SESSION['roque']==2)
	{
			$_SESSION['Jeu'][17]="RN";
			$_SESSION['Jeu'][16]="TN2";
			$_SESSION['Jeu'][18]="";
			$_SESSION['Jeu'][15]="";
			$_SESSION['deplacementRN']++;
			$_SESSION['deplacementTN2']++;
	}
		
	
	elseif($_SESSION['roque']==3)
	{
			$_SESSION['Jeu'][83]="RB";
			$_SESSION['Jeu'][84]="TB1";
			$_SESSION['Jeu'][81]="";
			$_SESSION['Jeu'][85]="";
			$_SESSION['deplacementRB']++;
			$_SESSION['deplacementTB1']++;
	}
		
	elseif($_SESSION['roque']==4)
	{
			$_SESSION['Jeu'][86]="TB2";
			$_SESSION['Jeu'][87]="RB";
			$_SESSION['Jeu'][88]="";
			$_SESSION['Jeu'][85]="";
			$_SESSION['deplacementRB']++;
			$_SESSION['deplacementTB2']++;
		
	}
	unset($_SESSION['roque']);
		$_SESSION['tailleHistorique']++;
		$_SESSION['pageActuelle']++;
		$_SESSION['Historique'][$_SESSION['tailleHistorique']]=$_SESSION['Jeu'];
	$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
	$echequier->afficherPoubelle();
	
}

// Si on est sur la dernière ligne avec un pion alors on choisit sa promotion(on le transforme en une autre pièce)
elseif(isset($_SESSION['promotion']) and isset($_SESSION['ligne']) and isset($_SESSION['colonne']) and isset($_SESSION['piece']))
{		
		
	if($_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]==$_SESSION['piece'] and $_SESSION['piece']=="PB" and $_SESSION['ligne']==1 and (
	$_SESSION['promotion']=="TB1"or $_SESSION['promotion']=="TB2"or $_SESSION['promotion']=="CB" or $_SESSION['promotion']=="FB" or $_SESSION['promotion']=="DB"))
	{
		$_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]=$_SESSION['promotion'];
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
		$echequier->afficherPoubelle();
	}
	elseif($_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]==$_SESSION['piece'] and $_SESSION['piece']=="PN" and $_SESSION['ligne']==8 and (
	$_SESSION['promotion']=="TN1" or $_SESSION['promotion']=="TN2" or $_SESSION['promotion']=="CN" or $_SESSION['promotion']=="FN" or $_SESSION['promotion']=="DN"))
	{
		$_SESSION['Jeu'][$_SESSION['ligne'].''.$_SESSION['colonne']]=$_SESSION['promotion'];
		$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
	    $echequier->afficherPoubelle();
	}
	else{
		echo'Erreur URL';
	}
	unset($_SESSION['ligne']);
	unset($_SESSION['colonne']);
	unset($_SESSION['promotion']);
	unset($_SESSION['piece']);
}
	
// Si on a cliquer sur une pièce alors on affiche les déplaement possibles et les pièces prenables
elseif(isset($_SESSION['piece']) and isset($_SESSION['ligne']) and isset($_SESSION['colonne']))
{
	// On crée un objet pièce
	$piece=creationPiece();
	$_SESSION['positionRoi']=positionRoi($piece->couleur);
	// On appele la methode deplacementPosssible, elle utilise d'ailleurs $_SESSION['positionRoi']
	$deplacementPossibles=$piece->deplacementPossible();
	$piecePrenable=$piece->piecePrenable(1);
	// roquer est une méthode renvoyant le nomero du roque possible
	$validationRoquer=$piece->roquer();
	$echequier->afficher($deplacementPossibles,$piecePrenable,$validationRoquer);
	// poubelle contient les pièces qui ont été prises
	$echequier->afficherPoubelle();

}
	
// Si on veut juste afficher l'echequier
else
{
	$echequier->afficher($deplacementPossible="",$piecePrenable="",$validationRoquer="");
	$echequier->afficherPoubelle();
}




function creationPiece()
{

	if($_SESSION['piece']=="PN" or $_SESSION['piece']=="PB")
	{		
		return $piece=new Pion($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="TN1" or $_SESSION['piece']=="TN2" or $_SESSION['piece']=="TB1" or $_SESSION['piece']=="TB2")
	{
		return $piece=new Tour($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="DN" or $_SESSION['piece']=="DB")
	{
		return $piece=new Dame($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="FN" or $_SESSION['piece']=="FB")
	{
		return $piece=new Fou($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="CN" or $_SESSION['piece']=="CB")
	{
		return $piece=new Cavalier($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="RN" or $_SESSION['piece']=="RB")
	{
		return $piece=new Roi($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
	if($_SESSION['piece']=="PN" or $_SESSION['piece']=="PB")
	{
		return $piece=new Pion($_SESSION['ligne'],$_SESSION['colonne'],$_SESSION['piece']);
	}
}
// Cette fonction permet de passer d'une page de l'historique à une autre 
function transformationListe()
{
	unset($_SESSION['Jeu']);
	for($i=1;$i<=8;$i++)
	{
		for($j=1;$j<=8;$j++)
		{
			if(isset($_SESSION['Historique'][$_SESSION['pageActuelle']][$i.''.$j]))
			{
			$_SESSION['Jeu'][$i.''.$j]=$_SESSION['Historique'][$_SESSION['pageActuelle']][$i.''.$j];
			}
		}
	}
	return true;
}
//cette fonction permet de déterminer la position du roi
function positionRoi($couleur)
{
	for($i=1;$i<=8;$i++)
	{
		for($j=1;$j<=8;$j++)
		{
			if(isset($_SESSION['Jeu'][$i.''.$j]))
			{
				if($_SESSION['Jeu'][$i.''.$j]=='RN' and $couleur=='N')
				{
					return $i.''.$j;
				}
				elseif($_SESSION['Jeu'][$i.''.$j]=='RB' and $couleur=='B')
				{
					return $i.''.$j;
				}
			}
		}
	}
	
}

?>