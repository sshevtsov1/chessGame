


<style>
table{
	margin-left:18%;
    border-collapse: collapse;
	margin-bottom:2%;	
}

td{
    border: 1px solid black;
	padding-top:2px;
	padding-bottom:4px;
	padding-left:6px;
	width:56px;
	height:58px;
}
.noir
{
	  background-color:#000005;
}
.prenable
{
	font-size:17px;
}
.imageIndication
{
	margin-left:15%;
	width:30px;
	height:29px;
}
.roque
{
	height:190px;
	width:220px;
	position:absolute;
	top:37%;
	left:67%;
}
@media screen and (max-width: 1280px)
{
	
	.roque
	{
	height:190px;
	width:220px;
	position:absolute;
	top:153%;
	left:67%;
	}
	table{
	margin-left:1%;
    border-collapse: collapse;
	background-image="IMG_0225.png"";
	margin-bottom:2%;	
	}
	td{
    border: 1px solid black;
	padding-top:2px;
	padding-bottom:4px;
	padding-left:6px;
	width:64px;
	height:66px;
	}
    
}

.poubelle
{
	border:3px black solid;
	background-color:#f1f1f1;
	box-shadow: 7px 7px 10px black;
	float:left;
	margin-left:6%;
	margin-bottom:16px;
}
.image
{
	width:70px;
	height:70px;
	margin-left:11%;
	margin-bottom:1%;
	
}
.titrePoubelle
{

	margin-left:2%;
	
}
.piece
{
	width:52px;
	height:55px;
}
.colonne
{
	background-color:#d6cee2;

}
.ligne
{
	background-color:#d6cee2;
	width:1px;
}
.poositionementCase
{
	padding-left:21px;
	font-size:19px;
}
</style>

<HTML>  
<HEAD>
<META charset="uft8"/> 
<TITLE>Jeu d'Echec</TITLE> 
</HEAD>

<BODY></BODY>
<form method="post" action="index.php">
<input type=submit value="Recommencer" name="cancel" />
</form>
<?php
include('traitement_echec.php');
?>
