<?php
class Pion extends Piece
{
	public function deplacementPossible()
	{
		$deplacement=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$piece=$this->piece;
		$deplacement[1]=3;
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col]) and $_SESSION['Jeu'][1+$lgn.''.$col]!="" and $piece=="PN" )
		{
			$deplacement[2]="";	
		}
		elseif($piece=="PN" and $this->prenableEnemi(1+$lgn,$col,$this->piece,1))
		{
			$deplacement[2]=1+$lgn.''.$col;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col]) and $_SESSION['Jeu'][-1+$lgn.''.$col]!="" and $piece=="PB")
		{
			$deplacement[2]="";	
		}
		elseif($piece=="PB" and $this->prenableEnemi(-1+$lgn,$col,$this->piece,1))
		{
			$deplacement[2]=-1+$lgn.''.$col;
		}
		
		if((isset($_SESSION['Jeu'][-2+$lgn.''.$col]) and $_SESSION['Jeu'][-2+$lgn.''.$col]!="") or (isset($_SESSION['Jeu'][-1+$lgn.''.$col]) and $_SESSION['Jeu'][-1+$lgn.''.$col]!="") and $piece=="PB" )
		{
			$deplacement[3]="";	
		}
		elseif($piece=="PB" and $lgn==7 and $this->prenableEnemi(-1+$lgn,$col,$this->piece,1))
		{
			$deplacement[3]=-2+$lgn.''.$col;
		}
		elseif(isset($_SESSION['Jeu'][2+$lgn.''.$col]) and $_SESSION['Jeu'][2+$lgn.''.$col]!="" or (isset($_SESSION['Jeu'][1+$lgn.''.$col]) and $_SESSION['Jeu'][1+$lgn.''.$col]!="") and $piece=="PN" )
		{
			$deplacement[3]="";	
			
		}
		elseif($piece=="PN" and $lgn==2 and $this->prenableEnemi(2+$lgn,$col,$this->piece,1))
		{
			$deplacement[3]=2+$lgn.''.$col;
		}
		else
		{
			$deplacement[3]="";
		}
		return $deplacement;
		
		
	}
	public function piecePrenable($nombreRecursivite)
	{
		$prenable=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$couleur=$this->getCouleur($lgn,$col);
		$prenable[1]=5;
	if(isset($_SESSION['Jeu'][-1+$lgn.''.$col+1]) and $_SESSION['Jeu'][-1+$lgn.''.$col+1]!="" and $_SESSION['Jeu'][$lgn.''.$col]=="PB"
		and $couleur!= $this->getCouleur(-1+$lgn,$col+1) and $this->prenableEnemi(-1+$lgn,$col+1,$this->piece,$nombreRecursivite)) 
	{
			$prenable[2]=-1+$lgn.''.$col+1;
	}
	else
	{
		$prenable[2]="";
	}
	if(isset($_SESSION['Jeu'][-1+$lgn.''.$col-1]) and $_SESSION['Jeu'][-1+$lgn.''.$col-1]!="" and $_SESSION['Jeu'][$lgn.''.$col]=="PB"
		and $couleur!= $this->getCouleur(-1+$lgn,$col-1) and $this->prenableEnemi(-1+$lgn,$col-1,$this->piece,$nombreRecursivite))
	{
			$prenable[3]=-1+$lgn.''.$col-1;
	}
	else
	{
		$prenable[3]="";
	}
	if(isset($_SESSION['Jeu'][1+$lgn.''.$col+1]) and $_SESSION['Jeu'][1+$lgn.''.$col+1]!="" and $_SESSION['Jeu'][$lgn.''.$col]=="PN"
		and $couleur!= $this->getCouleur(1+$lgn,$col+1)and $this->prenableEnemi(1+$lgn,$col+1,$this->piece,$nombreRecursivite))
	{
			$prenable[4]=1+$lgn.''.$col+1;
	}
	else
	{
		$prenable[4]="";
	}
	if(isset($_SESSION['Jeu'][1+$lgn.''.$col-1]) and $_SESSION['Jeu'][1+$lgn.''.$col-1]!="" and $_SESSION['Jeu'][$lgn.''.$col]=="PN" 
		and $couleur!= $this->getCouleur(1+$lgn,$col-1) and $this->prenableEnemi(1+$lgn,$col-1,$this->piece,$nombreRecursivite))
	{
			
			$prenable[5]=1+$lgn.''.$col-1;
	}
	else
	{
		$prenable[5]="";
	}
	
	return $prenable;
	
}
}
?>