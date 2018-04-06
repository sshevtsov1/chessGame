<?php
session_start();
// Si on est pas sur une page precedente
// header('location:index.php');
	echo $_SESSION['pageActuelle'];
	echo $_SESSION['tailleHistorique'];

if($_SESSION['pageActuelle']==$_SESSION['tailleHistorique'])
{
	// Faire jouer l'ordinateur
	if(isset($_GET['ordinateur']) and $_GET['ordinateur']=='N')
	{
		$_SESSION['ordinateur']='N';
		header('location:index.php');
	}
	// Promotion du pion
	elseif(isset($_GET['promotion']) and isset($_GET['ligne']) and isset($_GET['colonne']) and isset($_GET['piece']))
	{
		$_SESSION['promotion']=$_GET['promotion'];
		$_SESSION['ligne']=$_GET['ligne'];
		$_SESSION['colonne']=$_GET['colonne'];
		$_SESSION['piece']=$_GET['piece'];
		header('location:index.php');
	}
	// Selection d'une piece
	elseif(isset($_GET['piece']) and isset($_GET['colonne']) and isset($_GET['ligne']) and empty ($_SESSION['page']))
	{	
		$_SESSION['piece']=$_GET['piece'];
		$_SESSION['colonne']=$_GET['colonne'];
		$_SESSION['ligne']=$_GET['ligne'];
		header('location:index.php');	
	}
	// Deplacement d'une piece
	elseif(isset($_GET['deplacementColonne']) and isset($_GET['deplacementLigne']))
	{
		$_SESSION['deplacementLigne']=$_GET['deplacementLigne'];
		$_SESSION['deplacementColonne']=$_GET['deplacementColonne'];
		header('location:index.php');	
	}
	// Prendre une autre piece
	elseif(isset($_GET['prendreColonne']) and isset($_GET['prendreLigne']))
	{
		$_SESSION['prendreLigne']=$_GET['prendreLigne'];
		$_SESSION['prendreColonne']=$_GET['prendreColonne'];
		header('location:index.php');		
	}	
	// Roquer
	elseif(isset($_GET['roque']))
	{
		$_SESSION['roque']=$_GET['roque'];
		header('location:index.php');
	}
}
// Retour en arrière sur le coups precedents
if(isset($_GET['page']))
{ 
	if(($_SESSION['pageActuelle']===1 and $_GET['page']==-1) or ($_SESSION['pageActuelle']==$_SESSION['tailleHistorique'] and $_GET['page']==1) 
		or($_GET['page']!=1 and $_GET['page']!=-1))
	{
		
		echo'Erreur Url';
	}
	else
	{
	$_SESSION['page']=$_GET['page'];
	header('location:index.php');
	
	}
}
// Si aucun parametre n'est entré en url
else
{
	header('location:index.php');	
}

