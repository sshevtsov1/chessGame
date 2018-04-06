<?php
class Cavalier extends Piece
{
	public function deplacementPossible()
	{
		$deplacement=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$deplacement[1]=9;
		$deplacement[2]="";$deplacement[3]="";$deplacement[4]="";$deplacement[5]="";$deplacement[6]="";$deplacement[7]="";
		$deplacement[8]="";$deplacement[9]="";
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col+2]) and !empty($_SESSION['Jeu'][1+$lgn.''.$col+2]))
		{

			$deplacement[2]="";	
		}
		elseif($this->prenableEnemi(1+$lgn,$col+2,$this->piece,1))
		{
			$deplacement[2]=1+$lgn.''.$col+2;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col+2]) and !empty($_SESSION['Jeu'][-1+$lgn.''.$col+2]))
		{

			$deplacement[3]="";	
		}
		elseif($this->prenableEnemi(-1+$lgn,$col+2,$this->piece,1))
		{
			$deplacement[3]=-1+$lgn.''.$col+2;
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col-2]) and !empty($_SESSION['Jeu'][1+$lgn.''.$col-2]))
		{

			$deplacement[4]="";	
		}
		elseif($this->prenableEnemi(1+$lgn,$col-2,$this->piece,1))
		{
			$deplacement[4]=1+$lgn.''.$col-2;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col-2]) and !empty($_SESSION['Jeu'][-1+$lgn.''.$col-2]))
		{

			$deplacement[5]="";	
		}
		elseif($this->prenableEnemi(-1+$lgn,$col-2,$this->piece,1))
		{
			$deplacement[5]=-1+$lgn.''.$col-2;
		}
		if(isset($_SESSION['Jeu'][2+$lgn.''.$col+1]) and !empty($_SESSION['Jeu'][2+$lgn.''.$col+1]))
		{

			$deplacement[6]="";	
		}
		elseif($this->prenableEnemi(2+$lgn,$col+1,$this->piece,1))
		{
			$deplacement[6]=2+$lgn.''.$col+1;
		}
		if(isset($_SESSION['Jeu'][-2+$lgn.''.$col+1]) and !empty($_SESSION['Jeu'][-2+$lgn.''.$col+1]))
		{

			$deplacement[7]="";	
		}
		elseif($this->prenableEnemi(-2+$lgn,$col+1,$this->piece,1))
		{
			$deplacement[7]=-2+$lgn.''.$col+1;
		}
		if(isset($_SESSION['Jeu'][2+$lgn.''.$col-1]) and !empty($_SESSION['Jeu'][2+$lgn.''.$col-1]))
		{

			$deplacement[8]="";	
		}
		elseif($this->prenableEnemi(2+$lgn,$col-1,$this->piece,1))
		{
			$deplacement[8]=2+$lgn.''.$col-1;
		}
	
		if(isset($_SESSION['Jeu'][-2+$lgn.''.$col-1]) and !empty($_SESSION['Jeu'][-2+$lgn.''.$col-1]))
		{
			
			$deplacement[9]="";	
		}
		elseif($this->prenableEnemi(-2+$lgn,$col-1,$this->piece,1))
		{
			$deplacement[9]=-2+$lgn.''.$col-1;
		}
		return $deplacement;
		
	}
	public function piecePrenable($nombreRecursivite)
	{
		$position=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$couleur=$this->getCouleur($lgn,$col);
		$position[1]=9;
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col+2]) and !empty($_SESSION['Jeu'][1+$lgn.''.$col+2]) 
			and $couleur!= $this->getCouleur(1+$lgn,$col+2) and $this->prenableEnemi(1+$lgn,$col+2,$this->piece,$nombreRecursivite))
		{

			$position[2]=1+$lgn.''.$col+2;	
		}
		else
		{
			$position[2]="";
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col+2]) and !empty($_SESSION['Jeu'][-1+$lgn.''.$col+2])
			and $couleur!= $this->getCouleur(-1+$lgn,$col+2)and $this->prenableEnemi(-1+$lgn,$col+2,$this->piece,$nombreRecursivite))
		{

			$position[3]=-1+$lgn.''.$col+2;	
		}
		else
		{
			$position[3]="";
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col-2]) and !empty($_SESSION['Jeu'][1+$lgn.''.$col-2])
			and $couleur!= $this->getCouleur(1+$lgn,$col-2)and $this->prenableEnemi(1+$lgn,$col-2,$this->piece,$nombreRecursivite))
		{

			$position[4]=1+$lgn.''.$col-2;	
		}
		else
		{
			$position[4]="";
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col-2]) and !empty($_SESSION['Jeu'][-1+$lgn.''.$col-2])
			and $couleur!= $this->getCouleur(-1+$lgn,$col-2)and $this->prenableEnemi(-1+$lgn,$col-2,$this->piece,$nombreRecursivite))
		{

			$position[5]=-1+$lgn.''.$col-2;	
		}
		else
		{
			$position[5]="";
		}
		if(isset($_SESSION['Jeu'][2+$lgn.''.$col+1]) and  !empty($_SESSION['Jeu'][2+$lgn.''.$col+1])
			and $couleur!= $this->getCouleur(2+$lgn,$col+1)and $this->prenableEnemi(2+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{

			$position[6]=2+$lgn.''.$col+1;	
		}
		else
		{
			$position[6]="";
		}
		if(isset($_SESSION['Jeu'][-2+$lgn.''.$col+1]) and !empty($_SESSION['Jeu'][-2+$lgn.''.$col+1])
			and $couleur!= $this->getCouleur(-2+$lgn,$col+1)and $this->prenableEnemi(-2+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{

			$position[7]=-2+$lgn.''.$col+1;	
		}
		else
		{
			$position[7]="";
		}
		if(isset($_SESSION['Jeu'][2+$lgn.''.$col-1]) and !empty($_SESSION['Jeu'][2+$lgn.''.$col-1])
			and $couleur!= $this->getCouleur(2+$lgn,$col-1)and $this->prenableEnemi(2+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{

			$position[8]=2+$lgn.''.$col-1;	
		}
		else
		{
			$position[8]="";
		}
	
		if(isset($_SESSION['Jeu'][-2+$lgn.''.$col-1]) and !empty($_SESSION['Jeu'][-2+$lgn.''.$col-1])
			and $couleur!= $this->getCouleur(-2+$lgn,$col-1) and $this->prenableEnemi(-2+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			
			$position[9]=-2+$lgn.''.$col-1;	
		}
		else
		{
			$position[9]="";
		}
		return $position;
		
	}
}
?>