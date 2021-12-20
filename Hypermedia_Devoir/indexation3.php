<?php
 



function indexationTEXTE ($source,$mots)
{
	try 
    {
        $bdd = new PDO("mysql:host=127.0.0.1;dbname=test;charset=utf8", "root", "");
        
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }

	// 1
	//lecture du fichier sous forme d'une seule
	//chaine de caractères
	$texte = file_get_contents ($source);
	
	// 2
	//les séparateurs à enrichir pour la fragmentation du texte
	//avec le filtrage des mots <=2 et tous les les éléments vides (mots)
	$separateurs =  "’. ,…][(«»)" ;
	$tab_toks = explode_bis($texte, $separateurs);

	// 4
	//filtrage les doublons par calcule les occurrences
	$tab_new_mots_occurrences = array_count_values ($tab_toks);
    
	// 5
	//ici on affihe juste les résultats du traitement précédent / ou à mettre dans  une BDD
	//on a : le nom de la source (document) et  les mots-clés_occurrences	
	 
	 // si il y a un mot qu'on recherche dans la table on l'insert dans la bdd
	 if (isset($tab_new_mots_occurrences[$mots])) {     
	 	$insert = $bdd->prepare('INSERT INTO hypermedia(Document, Mot, Ocurrence) VALUES(:Document, :Mot, :Ocurrence)');
                            $insert->execute(array( 
                                'Document' => $source,
                                'Mot' => $mots,
                                'Ocurrence' => $tab_new_mots_occurrences[$mots]
                        
                            ));                 
	 }
	 
     $t= $bdd->prepare('SELECT distinct Document, Mot, Ocurrence FROM hypermedia  WHERE Mot = $mots ORDER BY Ocurrence');
	 $tt= $t->execute();
	 $result = $t->fetchAll(\PDO::FETCH_ASSOC);
	 //print_r($result);

  


                        
                        
	// 6
	//affichage des traces de l'indexation en tableau/résumé
	//print_datas($source,$tab_mots_occurrences ) ;
	// while ($tt= $t->fetch()) {
    //var_dump($tt);

	foreach ($tab_new_mots_occurrences  as $indice => $valeur)
	{
		if ($indice==$mots) {

			echo "<li> <a href=".$source.">  $source </a>: $indice  ($valeur)", '</li> <br>';
		}
		
	}


}
?>


<?php
//Version avancée de la fragmentation/tokenisation
//avec strtok et plusieurs séparateurs à la fois
function explode_bis($texte, $separateurs)
{
	$tok =  strtok($texte, $separateurs);
	if(strlen($tok) > 2)$tab_tok[] = $tok;

	while ($tok !== false) 
	{
		$tok = strtok($separateurs);
		if(strlen($tok) > 2)$tab_tok[] = $tok;
	}
	return $tab_tok;
}
	

?>