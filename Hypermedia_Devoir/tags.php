<?php
//
$motspoids=array(
'climatiques' => 3,
'p�riodes' => 2,
'pr�cipitations' => 10,
's�cheresse' => 11,
'intenses' => 4,
'vagues' => 2,
'chaleur' => 6,
'multipli�es' => 6,
'dix' => 2,
'acidification' => 13,
'oc�ans' => 12,
'd�veloppement' => 4,
'seront' => 2,
'premi�re' => 8,
'ligne' => 2,
'notamment' => 1,
'Afrique' => 1,
'p�nuries' => 1,
'eau' => 1,
'Asie' => 1,
'�l�vation' => 2,
'Toutefois' => 1,
'd�velopp�s' => 1,
'aussi' => 1,
'touch�s' => 1,
's�cheresses' => 2,
);

//Fonction pour g�n�rer le cloud � partir des donn�es fournies
function genererNuage( $data = array() , $minFontSize = 10, $maxFontSize = 36 )
{
	$tab_colors=array("#3087F8", "#7F814E", "#EC1E85","#14E414","#9EA0AB", "#9EA414");
		
	$minimumCount = min( array_values( $data ) );
	$maximumCount = max( array_values( $data ) );
	$spread = $maximumCount - $minimumCount;
	$cloudHTML = '';
	$cloudTags = array();
     
	$spread == 0 && $spread = 1;
	//M�langer un tableau de mani�re al�atoire
	srand((float)microtime()*1000000);
	$mots = array_keys($data);
    shuffle($mots);
	
	foreach( $mots as $tag )
	{	
		$count = $data[$tag];
		
		//La couleur al�atoire
		$color=rand(0,count($tab_colors)-1); 
			
		$size = $minFontSize + ( $count - $minimumCount )
			* ( $maxFontSize - $minFontSize ) / $spread;
		$cloudTags[] ='<a style="font-size: '. 
			floor( $size ) . 
			'px' . 
			'; color:' . 
			$tab_colors[$color]. 
			'; " title="Rechercher le tag ' . 
			$tag . 
			'" href="rechercher.php?q=' . 
			urlencode($tag) .
			'">' . 
			$tag . 
			'</a>';
	}
    return join( "\n", $cloudTags ) . "\n";
}	

?>
<html>
<head>
<title>Tag Cloud</title>
        <style type="text/css">
            #tagcloud {
                width: 300px;
                background:#CFE3FF;
                color:#0066FF;
                padding: 10px;
                border: 1px solid #559DFF;
                text-align:center;
                -moz-border-radius: 4px;
                -webkit-border-radius: 4px;
                border-radius: 4px;
            }

        </style>
</head>
     
<body>

<h1>Exemple Tag Cloud</h1>
<div id="tagcloud">
<?php echo utf8_encode(genererNuage( $motspoids )); ?>
</div>

</body>
</html>
