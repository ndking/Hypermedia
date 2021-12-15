<?php

//chaine de caractères
$texte = "Bonjour tout le monde.";

//Version basique de la fragmentation du texte 
//en éléments/mots sur la base du séparateeur " "
$tab_tok = explode(" ", $texte); 
	
//print_r($tab_tok);


foreach ($tab_tok  as $indice => $mot)
{
	if(strlen($mot) > 2) echo "$indice : $mot", '<br>';
}


?>