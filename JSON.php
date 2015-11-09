<?php 

require_once 'ldb.php';

$ids = array(16218, 5179, 31874);
$x = getMatFunc ($ids);
print_r($x);

function getMatFunc($ids=array()){
	
	$idsString= implode(", ", $ids);
	
	//get all genres
	$query = mysql_query("SELECT * FROM shared_genre");
	$genres = array();
	while ($row = mysql_fetch_assoc($query)){
		$genres[$row['idGenre']] = $row['eng'];
	}
	
	
	//get all langs
	$query = mysql_query("SELECT * FROM shared_language");
	$langs = array();
	while ($row = mysql_fetch_assoc($query)){
		$langs[$row['idLanguage']] = $row['language_fullname'];
	}
	
	
	//get all Ratings
	$query = mysql_query("SELECT * FROM material_rating_mpaa");
	$ratings = array();
	while ($row = mysql_fetch_assoc($query)){
		$ratings[$row['mpaa_id']] = $row['mpaa_alias'];
	}
	
	
	//get all People
	$query = mysql_query("SELECT * FROM material_people_new");
	$peopleEng = array();
	$peopleAr = array();
	while ($row = mysql_fetch_assoc($query)){
		$peopleEng[$row['idPeople']] = $row['name_2'] . ' ' . $row['surname_2'];
		$peopleAr[$row['idPeople']] = $row['name_1'] . ' ' . $row['surname_1'];
	}
	
	$query = mysql_query ("SELECT material_material.idMaterial, gTitle, gPlot, idPeople,
	 idRole, genre, container_filename, material_image.order, published, mat_language, 
	 mpaa, rating_id, material_material.keywords, material_localdescriptor.idLanguage, Runtime, 
	 ProdYear, parent, material_seasonNum, episodic 
	 FROM material_material LEFT JOIN material_localdescriptor
	 	ON  material_material.idMaterial=material_localdescriptor.idMaterial
	 LEFT JOIN material_image
	 	ON  material_material.idMaterial=material_image.material_id AND image_type='Poster' AND published=1
	 LEFT JOIN material_cast
	 	ON material_material.idMaterial=material_cast.idMaterial
	 WHERE material_material.idMaterial IN ($idsString)
	 ORDER BY material_material.idMaterial,idPeople");
	
	$mats  = array();
	while ($row = mysql_fetch_assoc($query)){
		if ( ! $mats[$row['idMaterial']]['id'] ) $mats[$row['idMaterial']]['id']="";
		if ( ! $mats[$row['idMaterial']]['ArTitle'])  $mats[$row['idMaterial']]['ArTitle']="";
		if ( ! $mats[$row['idMaterial']]['ArSynopsis'])  $mats[$row['idMaterial']]['ArSynopsis']="";
		if ( ! $mats[$row['idMaterial']]['EngTitle'])  $mats[$row['idMaterial']]['EngTitle']="";
		if ( ! $mats[$row['idMaterial']]['EngSynopsis']) $mats[$row['idMaterial']]['EngSynopsis']="";
		if ( ! $mats[$row['idMaterial']]['genres'])  $mats[$row['idMaterial']]['genres']="";
		if ( ! $mats[$row['idMaterial']]['lang'])  $mats[$row['idMaterial']]['lang']="";
		if ( ! $mats[$row['idMaterial']]['Poster'])  $mats[$row['idMaterial']]['Poster']="";
		if ( ! $mats[$row['idMaterial']]['rating'])  $mats[$row['idMaterial']]['rating']="";
		if ( ! $mats[$row['idMaterial']]['keywords']) $mats[$row['idMaterial']]['keywords']="";
		if ( ! $mats[$row['idMaterial']]['Runtime']) $mats[$row['idMaterial']]['Runtime']="";
		if ( ! $mats[$row['idMaterial']]['ProdYear']) $mats[$row['idMaterial']]['ProdYear']="";
		if ( ! $mats[$row['idMaterial']]['EngActors'])  $mats[$row['idMaterial']]['EngActors']="";
		if ( ! $mats[$row['idMaterial']]['ArActors']) $mats[$row['idMaterial']]['ArActors']="";
		if ( ! $mats[$row['idMaterial']]['EngDirectors']) $mats[$row['idMaterial']]['EngDirectors']="";
		if ( ! $mats[$row['idMaterial']]['ArDirectors']) $mats[$row['idMaterial']]['ArDirectors']="";
		if ( ! $mats[$row['idMaterial']]['EngProducers']) $mats[$row['idMaterial']]['EngProducers']="";
		if ( ! $mats[$row['idMaterial']]['ArProducers']) $mats[$row['idMaterial']]['ArProducers']="";
		if ( ! $mats[$row['idMaterial']]['parentArTitle']) $mats[$row['idMaterial']]['parentArTitle']="";
		if ( ! $mats[$row['idMaterial']]['parentEngTitle']) $mats[$row['idMaterial']]['parentEngTitle']="";
		if ( ! $mats[$row['idMaterial']]['parentArSynopsis']) $mats[$row['idMaterial']]['parentArSynopsis']="";
		if ( ! $mats[$row['idMaterial']]['parentEngSynopsis'])  $mats[$row['idMaterial']]['parentEngSynopsis']="";
		if ( ! $mats[$row['idMaterial']]['parentID'])  $mats[$row['idMaterial']]['parentID']="";
		if ( ! $mats[$row['idMaterial']]['episodic'])  $mats[$row['idMaterial']]['episodic']="";
		if ( ! $mats[$row['idMaterial']]['seasonNum'])  $mats[$row['idMaterial']]['seasonNum']="";
			
		$mats[$row['idMaterial']]['id'] = $row['idMaterial'];
		
		if ($row['idLanguage'] == 1) {
			$mats[$row['idMaterial']]['ArTitle'] = $row['gTitle'];
			$mats[$row['idMaterial']]['ArSynopsis'] = $row['gPlot'];
		}
		if ($row['idLanguage'] == 2) {
			$mats[$row['idMaterial']]['EngTitle'] = $row['gTitle'];
			$mats[$row['idMaterial']]['EngSynopsis'] = $row['gPlot'];
		}
		
		if ($row['genre']){
			$row['genre'] = trim($row['genre'],'[');
			$row['genre'] = trim($row['genre'],']');
			$row['genre'] = str_replace('][', ',', $row['genre']);
			$genresArr = explode(',', $row['genre']);
			foreach ($genresArr as $key=>$value){
				$genresArr[$key] = $genres[$value];
			}
			$genresString = implode(', ', $genresArr);
			$mats[$row['idMaterial']]['genres'] = $genresString;
		}
		
		if ($row['mat_language'] > 0)
			$mats[$row['idMaterial']]['lang'] = $langs[$row['mat_language']];
		
		$path="";
		if ($row['container_filename']) {
	//		$path = "../../../images-babeleye.com/images/mat/poster/";
	//		$extention = substr ( $row['container_filename'], strripos ($row['container_filename'], "." ) + 1, 3 ) ;
	//		$path .=  $row['idMaterial'].'_'.$row['order'].'.'.$extention;
			$mats[$row['idMaterial']]['Poster'] = "https://s3-eu-west-1.amazonaws.com/babeleye/programs/".$row['idMaterial'].".jpg";
		}
		
		if ($row['mpaa'])
			$mats[$row['idMaterial']]['rating'] = $ratings[$row['mpaa']];
		
		if ($row['keywords']) {
			$row['keywords'] = trim($row['keywords'],'[');
			$row['keywords'] = trim($row['keywords'],']');
			$row['keywords'] = str_replace('][', ', ', $row['keywords']);
			$mats[$row['idMaterial']]['keywords'] = $row['keywords'];
		}
			
		if ($row['Runtime'])
			$mats[$row['idMaterial']]['Runtime'] = $row['Runtime'];
		
		if ($row['ProdYear'])
			$mats[$row['idMaterial']]['ProdYear'] = $row['ProdYear'];
		
		if ($row['idRole'] == 1){
			if ($actor != $row['idPeople']) {
				$mats[$row['idMaterial']]['EngActors'] .= $peopleEng[$row['idPeople']] . ', ';
				$mats[$row['idMaterial']]['ArActors'] .= $peopleAr[$row['idPeople']] . ', ';
				$actor = $row['idPeople'];
			}
		}
			
		if ($row['idRole'] == 2){
			if ($director != $row['idPeople']) {
				$mats[$row['idMaterial']]['EngDirectors'] .= $peopleEng[$row['idPeople']] . ', ';
				$mats[$row['idMaterial']]['ArDirectors'] .= $peopleAr[$row['idPeople']] . ', ';
				$director = $row['idPeople'];
			}
		}
		
		if ($row['idRole'] == 3){
			if ($producer != $row['idPeople']) {
				$mats[$row['idMaterial']]['EngProducers'] .= $peopleEng[$row['idPeople']] . ', ';
				$mats[$row['idMaterial']]['ArProducers'] .= $peopleAr[$row['idPeople']] . ', ';
				$producer = $row['idPeople'];
			}
		}
		
		if ($row['parent'] > 0) {
			
			$mats[$row['idMaterial']]['parentID'] = $row['parent'];
			$mats[$row['idMaterial']]['episodic'] = $row['episodic'];
			$parentQuery = mysql_query("SELECT material_material.idMaterial, gTitle, gPlot, idPeople,
			 idRole, genre, container_filename, material_image.order, published, mat_language, 
			 mpaa, rating_id, material_material.keywords, material_localdescriptor.idLanguage, Runtime, 
			 ProdYear, parent, material_seasonNum, episodic 
			 FROM material_material LEFT JOIN material_localdescriptor
			 	ON  material_material.idMaterial=material_localdescriptor.idMaterial
			 LEFT JOIN material_image
			 	ON  material_material.idMaterial=material_image.material_id AND image_type='Poster' AND published=1
			 LEFT JOIN material_cast
			 	ON material_material.idMaterial=material_cast.idMaterial
			WHERE material_material.idMaterial='$row[parent]' AND idLanguage='$row[idLanguage]'
			ORDER BY material_material.idMaterial,idPeople");
	
			while ($parentRow = mysql_fetch_assoc($parentQuery)){
				if ($row['idLanguage'] == 1) {
					$mats[$row['idMaterial']]['parentArTitle'] = $parentRow['gTitle'];
					$mats[$row['idMaterial']]['parentArSynopsis'] = $parentRow['gPlot'];
				}
				if ($row['idLanguage'] == 2) {
					$mats[$row['idMaterial']]['parentEngTitle'] = $parentRow['gTitle'];
					$mats[$row['idMaterial']]['parentEngSynopsis'] = $parentRow['gPlot'];
				}
				
				$mats[$row['idMaterial']]['seasonNum'] = $parentRow['material_seasonNum'];
				
				if ($parentRow['idRole'] == 1){
					if (! strstr($mats[$row['idMaterial']]['EngActors'], $peopleEng[$parentRow['idPeople']])) {
						$mats[$row['idMaterial']]['EngActors'] .= $peopleEng[$parentRow['idPeople']] . ', ';
						$mats[$row['idMaterial']]['ArActors'] .= $peopleAr[$parentRow['idPeople']] . ', ';
					}
				}
					
				if ($parentRow['idRole'] == 2){
					if (! strstr($mats[$row['idMaterial']]['EngDirectors'], $peopleEng[$parentRow['idPeople']])) {
						$mats[$row['idMaterial']]['EngDirectors'] .= $peopleEng[$parentRow['idPeople']] . ', ';
						$mats[$row['idMaterial']]['ArDirectors'] .= $peopleAr[$parentRow['idPeople']] . ', ';
					}
				}
				
				if ($parentRow['idRole'] == 3){
					if (! strstr($mats[$row['idMaterial']]['EngProducers'], $peopleEng[$parentRow['idPeople']])) {
						$mats[$row['idMaterial']]['EngProducers'] .= $peopleEng[$parentRow['idPeople']] . ', ';
						$mats[$row['idMaterial']]['ArProducers'] .= $peopleAr[$parentRow['idPeople']] . ', ';
					}
				}
				
				if ($parentRow['genre']){
					$parentRow['genre'] = trim($parentRow['genre'],'[');
					$parentRow['genre'] = trim($parentRow['genre'],']');
					$parentRow['genre'] = str_replace('][', ',', $parentRow['genre']);
					$genresArr = explode(',', $parentRow['genre']);
					foreach ($genresArr as $key=>$value){
						$genresArr[$key] = $genres[$value];
					}
					$genresString = implode(', ', $genresArr);
					$mats[$row['idMaterial']]['genres'] = $genresString;
				}
				
				if ($parentRow['mat_language'] > 0)
					$mats[$row['idMaterial']]['lang'] = $langs[$parentRow['mat_language']];
				
				$path="";
				if ($parentRow['container_filename']) {
	//				$path = "../../../images-babeleye.com/images/mat/poster/";
	//				$extention = substr ( $parentRow['container_filename'], strripos ($parentRow['container_filename'], "." ) + 1, 3 ) ;
	//				$path .=  $parentRow['idMaterial'].'_'.$parentRow['order'].'.'.$extention;
					$mats[$row['idMaterial']]['Poster'] = "https://s3-eu-west-1.amazonaws.com/babeleye/programs/".$parentRow['idMaterial'].".jpg";
				}
				
				if ($parentRow['mpaa'])
					$mats[$row['idMaterial']]['rating'] = $ratings[$parentRow['mpaa']];
				
				if ($parentRow['keywords']) {
					$parentRow['keywords'] = trim($parentRow['keywords'],'[');
					$parentRow['keywords'] = trim($parentRow['keywords'],']');
					$parentRow['keywords'] = str_replace('][', ', ', $parentRow['keywords']);
					$mats[$row['idMaterial']]['keywords'] = $parentRow['keywords'];
				}
					
				if ($parentRow['Runtime'])
					$mats[$row['idMaterial']]['Runtime'] = $parentRow['Runtime'];
				
				if ($parentRow['ProdYear'])
					$mats[$row['idMaterial']]['ProdYear'] = $parentRow['ProdYear'];
			}
			
		}
		
	
	}
	
	foreach($mats as $key=>$value){
		$mats[$key]['EngProducers'] = trim($mats[$key]['EngProducers'] , ", ");
		$mats[$key]['ArProducers'] = trim($mats[$key]['ArProducers'] , ", ");
		$mats[$key]['EngDirectors'] = trim($mats[$key]['EngDirectors'] , ", ");
		$mats[$key]['ArDirectors'] = trim($mats[$key]['ArDirectors'] , ", ");
		$mats[$key]['EngActors'] = trim($mats[$key]['EngActors'] , ", ");
		$mats[$key]['ArActors'] = trim($mats[$key]['ArActors'] , ", ");
	}
	
//		$fp = fopen("a.csv", 'w');
//		fputcsv($fp, array_keys($mats[$ids[0]]));
//		foreach ($mats as $fields) {
//		    fputcsv($fp, $fields);
//		}
//		fclose($fp);
	//print_r($mats);
	
	$jsonArr = array();
	foreach ($mats as $id=>$data) {
		$title = $data['EngTitle'];
		if ($data['parentID'] > 0){
			$s = ($data['seasonNum'])? " S".$data['seasonNum'] : "";
			$ep = ($data['episodic'])? " Ep".$data['episodic'] : "";
			$title = $data['parentEngTitle'] . $s . $ep;
		}
		$jsonArr[$title] = json_encode($data);
	}
	return $jsonArr;
}
?>