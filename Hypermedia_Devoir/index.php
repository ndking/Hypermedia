
<style> 
	/*css de la page avec la barre de recherche, le bouton , etc*/
/*lien vers internet pour la police d'ecriture*/
@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  display: flex;

}

.searchTerm {
  width: 100%;
  border: 3px solid #00B4CC;
  border-right: none;
  padding: 5px;
  height: 20px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9DBFAF;
  height: 600%;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  width: 80px;
  height: 30px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

/*css pour changer la barre de recherche*/
.wrap{
  width: 30%;
  position: absolute;
  top: 25%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/*h1 {

	top: -65%;
	left: 38%;
	position: absolute;
}

*/
</style>

<div class="wrap">

	<h1>MY Search </h1>
   <form class="search" method ="POST">
      <input type="text" class="searchTerm" placeholder="Rechercher..." name="txt">
      <button type="submit" class="searchButton">
        valider 
     </button>
   </form>
 <ol> 


    

<?php
//Appel aux modules d'indexation :  pour des .txt

//On appel le module indexation 3.php 
include 'indexation3.php';

//Augmentation du temps
//d'exécution de ce script
set_time_limit (500);
$path= "docs";

explorerDir($path);

function explorerDir($path)
{
	if (isset($_POST["txt"]) and !preg_match("#^\s*$#",$_POST['txt'])) {
		echo "Résultat pour le mot ( ". $_POST["txt"]." ) :";
		echo "<BR>";
		echo "<BR>";
	
	

	$folder = opendir($path);
	while($entree = readdir($folder))
	{
		//On ignore les entrées
		if($entree != "." && $entree != "..")
		{
			// On vérifie si il s'agit d'un répertoire
			if(is_dir($path."/".$entree))
			{
				$sav_path = $path;
				
				// Construction du path jusqu'au nouveau répertoire
				$path .= "/".$entree;
				
				// On parcours le nouveau répertoire
				explorerDir($path);
				$path = $sav_path;
			}
			else
			{
				//C'est un fichier .txt ou pas
				$path_source = $path."/".$entree;
				
				//Si c'est un .txt
				//On appelle la fonction indexationTEXTE($source);
				//dans le script/module indexationTEXTE.php : présent ici par un include
				if(stripos($path_source, '.txt'))
				{
					
					indexationTEXTE($path_source,$_POST['txt']);
				}
			
			}
		}
	}
	closedir($folder);
}
}
?>

</ol>
</div>
<script type="text/javascript">
	
var items = $('.alphaList > li').get();
items.sort(function(a,b){
  var keyA = $(a).text();
  var keyB = $(b).text();

  if (keyA < keyB) return -1;
  if (keyA > keyB) return 1;
  return 0;
});
var ul = $('.alphaList');
$.each(items, function(i, li){
  ul.append(li); /* This removes li from the old spot and moves it */
});
	
</script>
