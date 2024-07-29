<?php
//
//物件管理リスト
//
function fnSqlArticleList($flg, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo)
{
	switch ($flg) {
		case 0:
			$sql  = "SELECT COUNT(*)";
			//var_dump($sql);
			break;
		case 1:
			$sql  = "SELECT ARTICLENO, ARTICLE, ROOM, KEYPLACE, ARTICLENOTE, KEYBOX, DRAWING, SELLCHARGE";
			//var_dump($sql);
			break;
	}
	//var_dump($flg);
	$sql .= " FROM TBLARTICLE";
	//var_dump($sql);
	$sql .= " WHERE DEL = $sDel";
	//var_dump($sql);
	if ($sArticle) {
		$sql .= " AND ARTICLE LIKE '%$sArticle$%'";
		//var_dump($sql);
	}
	//var_dump($sArticle);
	if ($sRoom) {
		$sql .= " AND ROOM LIKE '%$sRoom%'";
		//var_dump($sql);
	}
	//var_dump($sRoom);
	if ($sKeyPlace) {
		$sql .= " AND KEYPLACE LIKE '%$sKeyPlace%'";
		//var_dump($sql);
	}
	//var_dump($sKeyPlace);
	if ($sArticleNote) {
		$sql .= " AND ARTICLENOTE LIKE '%$sArticleNote%'";
		//var_dump($sql);
	}
	//var_dump($sKeyPlace);
	if ($sKeyBox) {
		$sql .= " AND KEYBOX LIKE '%l$sKeyBox%'";
		//var_dump($sql);
	}
	//var_dump($sKeyBox);
	if ($sDrawing) {
		$sql .= " AND DRAWING LIKE '%$sDrawing%'";
		//var_dump($sql);
	}
	//var_dump($sDrawing);
	if ($sSellCharge) {
		$sql .= " AND SELLCHARGE LIKE '%$sSellCharge%'";
		//var_dump($sql);
	}
	//var_dump($sDrawing);
	if ($orderBy) {
		$sql .= " ORDER BY $orderBy $orderTo";
		//var_dump($sql);
	}
	//var_dump($orderBy);
	if ($flg) {
		$sql .= " LIMIT " . (($sPage - 1) * PAGE_MAX) . ", " . PAGE_MAX;
		//var_dump($sql);
	}
	//var_dump($flg);
	return ($sql);
	//var_dump($sql);
}
//var_dump($flg, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo);


//
//物件管理情報
//
function fnSqlArticleEdit($articleNo)
{
	$sql  = "SELECT ARTICLE,ROOM,KEYPLACE,ADDRESS,ARTICLENOTE,KEYBOX,DRAWING,SELLCHARGE,DEL";
	//var_dump($sql);
	$sql .= " FROM TBLARTICLE";
	//var_dump($sql);
	$sql .= " WHERE ARTICLENO = $articleNo";
	//var_dump($sql);

	return ($sql);
	//var_dump($sql);
}
//var_dump($articleNo);


//
//物件管理情報更新
//
function fnSqlArticleUpdate($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del)
{
	$sql  = "UPDATE TBLARTICLE";
	//var_dump($sql);
	$sql .= " SET ARTICLE = '$article'";
	//var_dump($sql);
	$sql .= ",ROOM = '$room'";
	//var_dump($sql);
	$sql .= ",KEYPLACE = '$keyPlace'";
	//var_dump($sql);
	$sql .= ",ADDRESS = '$address";
	//var_dump($sql);
	$sql .= ",ARTICLENOTE = '$articleNote'";
	//var_dump($sql);
	$sql .= ",KEYBOX = '$keyBox'";
	//var_dump($sql);
	$sql .= ",DRAWING = '$drawing'";
	//var_dump($sql);
	$sql .= ",SELLCHARGE = '$sellCharge'";
	//var_dump($sql);
	$sql .= ",DEL = '$del'";
	//var_dump($sql);
	$sql .= " WHERE ARTICLENO = $articleNo";
	//var_dump($sql);

	return ($sql);
	//var_dump($sql);
}
//var_dump($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del);


//
//物件管理情報登録
//
function fnSqlArticleInsert($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del)
{
	$sql  = "INSERT INTO TBLARTICLE (";
	var_dump($sql);
	$sql .= "ARTICLENO,ARTICLE,ROOM,KEYPLACE,ADDRESS,ARTICLENOTE,KEYBOX,DUEDT,SELLCHARGE,AREA,YEARS,SELLPRICE,INTERIORPRICE,CONSTTRADER,CONSTPRICE,CONSTADD,CONSTNOTE,PURCHASEDT,WORKSTARTDT,WORKENDDT,LINEOPENDT,LINECLOSEDT,RECEIVE,HOTWATER,SITEDT,LEAVINGFORM,LEAVINGDT,MANAGECOMPANY,FLOORPLAN,FORMEROWNER,BROKERCHARGE,BROKERCONTACT,INTERIORCHARGE,CONSTFLG1,CONSTFLG2,CONSTFLG3,CONSTFLG4,INSDT,UPDT,DEL,DRAWING,LINEOPENCONTACTDT,LINECLOSECONTACTDT,LINECONTACTNOTE,ELECTRICITYCHARGE,GASCHARGE,LIGHTORDER";
	var_dump($sql);
	$sql .= " ) VALUES ( ";
	var_dump($sql);
	$sql .= "'$articleNo','$article','$room','$keyPlace','$address','$articleNote','$keyBox','','$sellCharge','','','','','','','','','','','','','','','','','','','','','','','','','','','','', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,'$del','$drawing','','','','','','' )";
	var_dump($sql);
	return ($sql);
	//var_dump($sql);
}
//var_dump($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del);
//
//物件管理情報削除
//
function fnSqlArticleDelete($articleNo)
{
	$sql  = "UPDATE TBLARTICLE";
	//var_dump($sql);
	$sql .= " SET DEL = 0";
	//var_dump($sql);
	$sql .= ",UPDT = CURRENT_TIMESTAMP";
	//var_dump($sql);
	$sql .= " WHERE ARTICLENO = '$articleNo'";
	//var_dump($sql);

	return ($sql);
	//var_dump($sql);
}
//var_dump($articleNo);
