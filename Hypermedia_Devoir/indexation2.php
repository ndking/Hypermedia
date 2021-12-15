<?php

//Lecture du fichier texte sous forme d'une seule
$texte = file_get_contents ("doc1.txt");

//Version avancée de la fragmentation/tokenisation
//avec strtok et plusieurs séparateurs à la fois

$separateurs =  "’. ,…][(«»)" ;
$tab_tok[] = $tok =  strtok($texte, $separateurs);
while ($tok !== false) 
{
	$tab_tok[] = $tok = strtok($separateurs);
}
	
//Affiche la liste des mots
foreach ($tab_tok  as $indice => $mot)
{
	echo "$indice : $mot", '<br>';
}

?>