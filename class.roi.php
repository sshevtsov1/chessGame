<?php
class Roi extends Piece
{
	public function deplacementPossible()
	{
		$deplacement=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$nombreRecursivite=1;
		// $deplacement[1] correspond au nombre de déplacement permis pour la pièce +1
		// $deplacement--->ouest,sud-ouest,sud,sud-est,est,nord-est,nord,nord-ouest;
		$deplacement[1]=9;
		$deplacement[2]='';$deplacement[3]='';$deplacement[4]='';$deplacement[5]='';$deplacement[6]='';
		$deplacement[7]='';$deplacement[8]='';$deplacement[9]='';
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col+1]) and ($_SESSION['Jeu'][1+$lgn.''.$col+1]!=""))
		{

				$deplacement[2]="";
		}
		elseif($this->prenableEnemi(1+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{
			$deplacement[2]=1+$lgn.''.$col+1;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col-1]) and $_SESSION['Jeu'][-1+$lgn.''.$col-1]!="" )
		{
				$deplacement[3]="";
		}
		elseif($this->prenableEnemi(-1+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			
			$deplacement[3]=-1+$lgn.''.$col-1;
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col-1]) and $_SESSION['Jeu'][1+$lgn.''.$col-1]!="" )
		{
			$deplacement[4]="";	
		}
		elseif($this->prenableEnemi(1+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{

			$deplacement[4]=1+$lgn.''.$col-1;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col+1]) and $_SESSION['Jeu'][-1+$lgn.''.$col+1]!="")
		{
				$deplacement[5]="";	
		} 
		elseif($this->prenableEnemi(-1+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{
			$deplacement[5]=-1+$lgn.''.$col+1;
		}
		if(isset($_SESSION['Jeu'][$lgn.''.$col+1]) and $_SESSION['Jeu'][$lgn.''.$col+1]!="")
		{
			$deplacement[6]="";
		}
		elseif($this->prenableEnemi($lgn,$col+1,$this->piece,$nombreRecursivite))
		{
			$deplacement[6]=$lgn.''.$col+1;	
		}
		if(isset($_SESSION['Jeu'][$lgn.''.$col-1]) and $_SESSION['Jeu'][$lgn.''.$col-1]!="")
		{
			$delpacement[7]="";
		}
		elseif($this->prenableEnemi($lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			$deplacement[7]=$lgn.''.$col-1;	
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col]) and $_SESSION['Jeu'][1+$lgn.''.$col]!="")
		{
			$deplacement[8]="";
		}
		elseif($this->prenableEnemi(1+$lgn,$col,$this->piece,$nombreRecursivite))
		{
			$deplacement[8]=1+$lgn.''.$col;
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col]) and $_SESSION['Jeu'][-1+$lgn.''.$col]!="")
		{
			$deplacement[9]="";	
		}
		elseif($this->prenableEnemi(-1+$lgn,$col,$this->piece,$nombreRecursivite))
		{
			$deplacement[9]=-1+$lgn.''.$col;
		}
		return $deplacement;
	}
	
	public function piecePrenable($nombreRecursivite)
	{
		$prenable=array();
		$lgn=$this->lgn;
		$col=$this->col;
		$couleur=$this->getCouleur($lgn,$col);
		// $prenable[1] correspond au nombre de déplacement permis +1 , $prenable[1] correspond donc au nombre d'éléments dans prenable
		// $prenable--->ouest,sud-ouest,sud,sud-est,est,nord-est,nord,nord-ouest;
		$prenable[1]=9;	
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col+1]) and ($_SESSION['Jeu'][1+$lgn.''.$col+1]!="") and $couleur!= $this->getCouleur(1+$lgn,$col+1) and
			$this->prenableEnemi(1+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{
	
			$prenable[2]=1+$lgn.''.$col+1;	
		}
		else
		{
			$prenable[2]="";
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col-1]) and $_SESSION['Jeu'][-1+$lgn.''.$col-1]!="" and $couleur!= $this->getCouleur(-1+$lgn,$col-1) and
		$this->prenableEnemi(-1+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			$prenable[3]=-1+$lgn.''.$col-1;	
		}
		else
		{
			$prenable[3]="";
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col-1]) and $_SESSION['Jeu'][1+$lgn.''.$col-1]!="" and $couleur!= $this->getCouleur(1+$lgn,$col-1) and 
		$this->prenableEnemi(1+$lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			$prenable[4]=1+$lgn.''.$col-1;	
		}
		else
		{
			$prenable[4]="";
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col+1]) and $_SESSION['Jeu'][-1+$lgn.''.$col+1]!="" and $couleur!= $this->getCouleur(-1+$lgn,$col+1) and
		$this->prenableEnemi(-1+$lgn,$col+1,$this->piece,$nombreRecursivite))
		{
			$prenable[5]=-1+$lgn.''.$col+1;	
		}
		else
		{
			$prenable[5]="";
		}
		if(isset($_SESSION['Jeu'][$lgn.''.$col+1]) and $_SESSION['Jeu'][$lgn.''.$col+1]!="" and $couleur!= $this->getCouleur($lgn,$col+1) and
		$this->prenableEnemi($lgn,$col+1,$this->piece,$nombreRecursivite))
		{
			$prenable[6]=$lgn.''.$col+1;	
		}
		else
		{
			$prenable[6]="";
		}
		if(isset($_SESSION['Jeu'][$lgn.''.$col-1]) and $_SESSION['Jeu'][$lgn.''.$col-1]!="" and $couleur!= $this->getCouleur($lgn,$col-1) and
		$this->prenableEnemi($lgn,$col-1,$this->piece,$nombreRecursivite))
		{
			$prenable[7]=$lgn.''.$col-1;	
		}
		else
		{
			$prenable[7]="";
		}
		if(isset($_SESSION['Jeu'][1+$lgn.''.$col]) and $_SESSION['Jeu'][1+$lgn.''.$col]!="" and $couleur!= $this->getCouleur(1+$lgn,$col) and 
		$this->prenableEnemi(1+$lgn,$col,$this->piece,$nombreRecursivite))
		{
			$prenable[8]=1+$lgn.''.$col;
		}
		else
		{
			$prenable[8]="";
		}
		if(isset($_SESSION['Jeu'][-1+$lgn.''.$col]) and $_SESSION['Jeu'][-1+$lgn.''.$col]!="" and $couleur!= $this->getCouleur(-1+$lgn,$col) and
		$this->prenableEnemi(-1+$lgn,$col,$this->piece,$nombreRecursivite))
		{
			$prenable[9]=-1+$lgn.''.$col;	
		}
		else
		{
			$prenable[9]="";
		}
		return $prenable;
		
	}
}
?>