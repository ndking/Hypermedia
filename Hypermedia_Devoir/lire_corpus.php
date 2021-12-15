
<P>
<B>DEBUTTTTTT DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>
<?php

//Appel aux modules d'indexation :  pour des .txt
//include 'indexationTEXTE.php';

//Augmentation du temps
//d'ex�cution de ce script
set_time_limit (500);
$path= "docs";

explorerDir($path);

function explorerDir($path)
{
	$folder = opendir($path);
	while($entree = readdir($folder))
	{
		//On ignore les entr�es
		if($entree != "." && $entree != "..")
		{
			// On v�rifie si il s'agit d'un r�pertoire
			if(is_dir($path."/".$entree))
			{
				$sav_path = $path;
				
				// Construction du path jusqu'au nouveau r�pertoire
				$path .= "/".$entree;
				echo "DOSSIER = ", $path, "<BR>";
				// On parcours le nouveau r�pertoire
				explorerDir($path);
				$path = $sav_path;
			}
			else
			{
				//C'est un fichier .txt ou pas
				$path_source = $path."/".$entree;
				
				//Si c'est un .txt
				//On appelle la fonction indexationTEXTE($source);
				//dans le script/module indexationTEXTE.php : pr�sent ici par un include
				if(stripos($path_source, '.txt'))
				{
					echo $path_source, '<br>';
					//indexationTEXTE($path_source);
				}
			
			}
		}
	}
	closedir($folder);
}
?>
<P>
<B>FINNNNNN DU PROCESSUS :</B>
<BR>
<?php echo " ", date ("h:i:s"); ?>
</P>
