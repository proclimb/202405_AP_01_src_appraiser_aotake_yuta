<?php
//
//物件管理画面
//
function subArticle()
{
	$conn = fnDbConnect();
	//var_dump($conn);
	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	//var_dump($sDel);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	//var_dump($sArticle);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	//var_dump($sRoom);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	//var_dump($sKeyPlace);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	//var_dump($sArticleNote);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	//var_dump($sKeyBox);
	$sDrawing     = htmlspecialchars($_REQUEST['sDrawing']);
	//var_dump($sDrawing);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);
	//var_dump($sSellCharge);

	$orderBy = $_REQUEST['orderBy'];
	//var_dump($orderBy);
	$orderTo = $_REQUEST['orderTo'];
	//var_dump($orderTo);
	$sPage   = $_REQUEST['sPage'];
	//var_dump($sPage);

	if ($sDel == '') {
		$sDel = 1;
		//var_dump($sDel);
	}

	if (!$sPage) {
		$sPage = 1;
		//var_dump($sPage);
	}


	if (!$orderBy) {
		$orderBy = 'ARTICLENO';
		//var_dump($orderBy);
		$orderTo = 'DESC';
		//var_dump($orderTo);
	}


	subMenu();
?>

	<h1>物件管理一覧</h1>

	<form name="form" id="form" action="index.php" method="post">
		<input type="hidden" name="act" value="articleSearch" />
		<input type="hidden" name="orderBy" value="<?php print $orderBy; ?>" />
		<input type="hidden" name="orderTo" value="<?php print $orderTo; ?>" />
		<input type="hidden" name="sPage" value="<?php print $sPage; ?>" />
		<input type="hidden" name="articleNo" />
		<input type="hidden" name="sName" />
		<input type="hidden" name="sRoom" />

		<a href="javascript:form.act.value='articleEdit';form.submit();"><img src="./images/btn_enter.png"></a>

		<div class="search">
			<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<th>除外</th>
					<td><input type="checkbox" name="sDel" value="0" <?php if ($sDel == 0) print ' checked="checked"'; ?> /></td>
					<th>備考</th>
					<td><input type="text" name="sArticleNote" value="<?php print $sArticleNote; ?>" size="50" /></td>
				</tr>
				<tr>
					<th>物件名</th>
					<td><input type="text" name="sArticle" value="<?php print $sRoom; ?>" size="50" /></td>
					<th>キーBox番号</th>
					<td><input type="text" name="sKeyBox" value="<?php print $sKeyBox; ?>" size="30" /></td>
				</tr>
				<tr>
					<th>部屋番号</th>
					<td><input type="text" name="sRoom" value="<?php print $sArticle; ?>" size="30" /></td>
					<th>3Dパース</th>
					<td><input type="text" name="sDrawing" value="<?php print $sDrawing; ?>" size="30" /></td>
				</tr>
				<tr>
					<th>鍵場所</th>
					<td><input type="text" name="sKeyPlace" value="<?php print $sKeyPlace; ?>" size="30" /></td>
					<th>営業担当者</th>
					<td><input type="text" name="sSellCharge" value="<?php print $sSellCharge; ?>" /></td>
				</tr>
			</table>
		</div>

		<input type="image" src="./images/btn_search.png" onclick="form.act.value='articleSearch';form.sPage.value=1;form.submit();" />

		<hr />

		<?php
		if ($_REQUEST['act'] == 'article') {
			return;
		}
		//var_dump($_REQUEST);
		$sql = fnSqlArticleList(0, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo);
		//var_dump($sql);
		$res = mysqli_query($conn, $sql);
		//var_dump($res);
		$row = mysqli_fetch_array($res);
		//var_dump($row);

		$count = $row[0];
		//var_dump($count);

		$sPage = fnPage($count, $sPage, 'articleSearch');
		//var_dump($sPage);
		?>

		<div class="list">
			<table border="0" cellpadding="5" cellspacing="1">
				<tr>
					<th class="list_head">物件名<?php fnOrder('ARTICLE', 'articleSearch'); ?></th>
					<th class="list_head">部屋<?php fnOrder('ROOM', 'articleSearch'); ?></th>
					<th class="list_head">鍵場所<?php fnOrder('KEYPLACE', 'articleSearch'); ?></th>
					<th class="list_head">備考<?php fnOrder('ARTICLENOTE', 'articleSearch'); ?></th>
					<th class="list_head">書類</th>
					<th class="list_head">キーBox番号<?php fnOrder('KEYBOX', 'articleSearch'); ?></th>
					<th class="list_head">3Dパース<?php fnOrder('DRAWING', 'articleSearch'); ?></th>
					<th class="list_head">営業担当者<?php fnOrder('SELLCHARGE', 'articleSearch'); ?></th>
				</tr>
				<?php
				$sql = fnSqlArticleList(1, $sDel, $sArticle, $sRoom, $sKeyPlace, $sArticleNote, $sKeyBox, $sDrawing, $sSellCharge, $sPage, $orderBy, $orderTo);
				//var_dump($sql);
				$res = mysqli_query($conn, $sql);
				//var_dump($res);
				$i = 0;
				//var_dump($i);
				while ($row = mysqli_fetch_array($res)) {
					$articleNo   = htmlspecialchars($row[0]);
					//var_dump($articleNo);
					$article     = htmlspecialchars($row[1]);
					//var_dump($article);
					$room        = htmlspecialchars($row[3]);
					//var_dump($room);
					$keyPlace    = htmlspecialchars($row[4]);
					//var_dump($keyPlace);
					$articleNote = htmlspecialchars($row[5]);
					//var_dump($articleNote);
					$keyBox      = htmlspecialchars($row[6]);
					//var_dump($keyBox);
					$drawing     = htmlspecialchars($row[7]);
					//var_dump($drawing);
					$sellCharge  = htmlspecialchars($row[8]);
					//var_dump($sellCharge);
				?>
					<tr>
						<td class="list_td<?php print $i; ?>"><a href="javascript:form.act.value='articleEdit';form.articleNo.value='<?php print $articleNo ?>';form.submit();"><?php print $article ?></a></td>
						<td class="list_td<?php print $i; ?>"><?php print $room; ?></td>
						<td class="list_td<?php print $i; ?>"><?php print $keyPlace; ?></td>
						<td class="list_td<?php print $i; ?>"><?php print $articleNote; ?></td>
						<td class="list_td<?php print $i; ?>"><a href="javascript:form.act.value='stock';form.sName.value='<?php print $article; ?>';form.sRoom.value='<?php print $room ?>';form.submit();">表示</a></td>
						<td class="list_td<?php print $i; ?>"><?php print $keyBox; ?></td>
						<td class="list_td<?php print $i; ?>"><?php print $drawing; ?></td>
						<td class="list_td<?php print $i; ?>"><?php print $sellCharge; ?></td>
					</tr>
				<?php
					$i = ($i + 1) % 2;
					//var_dump($i);
				}
				//var_dump($row);
				?>
			</table>
		</div>
	</form>
<?php
}




//
//物件管理編集画面
//
function subArticleEdit()
{
	$conn = fnDbConnect();
	//var_dump($conn);

	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	//var_dump($sDel);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	//var_dump($sArticle);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	//var_dump($sRoom);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	//var_dump($sKeyPlace);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	//var_dump($sArticleNote);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	//var_dump($sKeyBox);
	$sDueDTFrom   = htmlspecialchars($_REQUEST['sDueDTFrom']);
	//var_dump($sDueDTFrom);
	$sDueDTTo     = htmlspecialchars($_REQUEST['sDueDTTo']);
	//var_dump($sDueDTTo);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);
	//var_dump($sSellCharge);

	$orderBy = $_REQUEST['orderBy'];
	//var_dump($orderBy);
	$orderTo = $_REQUEST['orderTo'];
	//var_dump($orderTo);
	$sPage   = $_REQUEST['sPage'];
	//var_dump($sPage);

	$articleNo = $_REQUEST['articleNo'];
	//var_dump($articleNo);

	if ($articleNo) {
		$sql = fnSqlArticleEdit($articleNo);
		//var_dump($sql);
		$res = mysqli_query($conn, $sql);
		//var_dump($res);
		$row = mysqli_fetch_array($res);
		//var_dump($row);

		$article     =  htmlspecialchars($row[0]);
		//var_dump($article);
		$room        =  htmlspecialchars($row[1]);
		//var_dump($room);
		$keyPlace    =  htmlspecialchars($row[2]);
		//var_dump($keyPlace);
		$address     =  htmlspecialchars($row[3]);
		//var_dump($address);
		$articleNote =  htmlspecialchars($row[4]);
		//var_dump($articleNote);
		$keyBox      =  htmlspecialchars($row[5]);
		//var_dump($keyBox);
		$drawing     =  htmlspecialchars($row[6]);
		//var_dump($drawing);
		$sellCharge  =  htmlspecialchars($row[7]);
		//var_dump($sellCharge);
		$del         =  htmlspecialchars($row[8]);
		//var_dump($del);

		$purpose  = '更新';
		//var_dump($purpose);
		$btnImage = 'btn_load.png';
		//var_dump($btnImage);
	} else {
		$purpose = '登録';
		//var_dump($purpose);
		$btnImage = 'btn_enter.png';
		//var_dump($btnImage);
	}
	//var_dump($articleNo);
	subMenu();
?>
	<script type="text/javascript" src="./js/article.js"></script>

	<h1>物件<?php print $purpose ?></h1>

	<form name="form" id="form" action="index.php" method="post">
		<input type="hidden" name="act" />
		<input type="hidden" name="sDel" value="<?php print $sDel; ?>" />
		<input type="hidden" name="sArticle" value="<?php print $sArticle; ?>" />
		<input type="hidden" name="sRoom" value="<?php print $sRoom; ?>" />
		<input type="hidden" name="sKeyPlace" value="<?php print $sKeyPlace; ?>" />
		<input type="hidden" name="sArticleNote" value="<?php print $sArticleNote; ?>" />
		<input type="hidden" name="sKeyBox" value="<?php print $sKeyBox; ?>" />
		<input type="hidden" name="sDueDTFrom" value="<?php print $sDueDTFrom; ?>" />
		<input type="hidden" name="sDueDTTo" value="<?php print $sDueDTTo; ?>" />
		<input type="hidden" name="sSellCharge" value="<?php print $sSellCharge; ?>" />
		<input type="hidden" name="orderBy" value="<?php print $orderBy; ?>" />
		<input type="hidden" name="orderTo" value="<?php print $orderTo; ?>" />
		<input type="hidden" name="sPage" value="<?php print $sPage; ?>" />
		<input type="hidden" name="articleNo" value="<?php print $articleNo; ?>" />

		<table border="0" cellpadding="5" cellspacing="1">
			<tr>
				<th>除外</th>
				<?php if ($articleNo) { ?>
					<td>
						<input type="radio" name="del" value="1" checked="checked" /> 非除外
						<input type="radio" name="del" value="0" <?php if ($del == '0') print ' checked="checked"'; ?> /> 除外
					</td>
				<?php } ?>
			</tr>
			<tr>
				<th>物件名<span class="red">（必須）</span></th>
				<td><input type="text" name="article" value="<?php print $article; ?>" /></td>
			</tr>
			<tr>
				<th>部屋番号</th>
				<td><input type="text" name="room" value="<?php print $room; ?>" /></td>
			</tr>
			<tr>
				<th>鍵場所</th>
				<td><textarea name="keyPlace" cols="50" rows="10"><?php print $keyPlace; ?></textarea></td>
			</tr>
			<tr>
				<th>住所</th>
				<td><input type="text" name="address" value="<?php print $address; ?>" /></td>
			</tr>
			<tr>
				<th>備考</th>
				<td><textarea name="articleNote" cols="50" rows="10"><?php print $articleNote; ?></textarea></td>
			</tr>
			<tr>
				<th>キーBox番号</th>
				<td><input type="text" name="keyBox" value="<?php print $keyBox; ?>" /></td>
			</tr>
			<tr>
				<th>3Dパース</th>
				<td><input type="text" name="drawing" value="<?php print $drawing; ?>" /></td>
			</tr>
			<tr>
				<th>営業担当者</th>
				<td><input type="text" name="sellCharge" value="<?php print $sellCharge; ?>" /></td>
			</tr>
		</table>

		<a href="javascript:fnArticleEditCheck();"><img src="./images/<?php print $btnImage; ?>" /></a>　
		<a href="javascript:form.act.value='articleSearch';form.submit();"><img src="./images/btn_return.png" /></a>　
		<?php if ($articleNo) {
		?>
			<a href="javascript:fnArticleDeleteCheck(<?php print $articleNo; ?>);"><img src="./images/btn_del.png" /></a>
		<?php
		}
		//var_dump($articleNo);
		?>

	</form>
<?php
}




//
//物件管理編集完了処理
//
function subArticleEditComplete()
{
	$conn = fnDbConnect();
	//var_dump($conn);

	$sDel         = htmlspecialchars($_REQUEST['sDel']);
	//var_dump($sDel);
	$sArticle     = htmlspecialchars($_REQUEST['sArticle']);
	//var_dump($sArticle);
	$sRoom        = htmlspecialchars($_REQUEST['sRoom']);
	//var_dump($sRoom);
	$sKeyPlace    = htmlspecialchars($_REQUEST['sKeyPlace']);
	//var_dump($sKeyPlace);
	$sArticleNote = htmlspecialchars($_REQUEST['sArticleNote']);
	//var_dump($sArticleNote);
	$sKeyBox      = htmlspecialchars($_REQUEST['sKeyBox']);
	//var_dump($sKeyBox);
	$sDueDTFrom   = htmlspecialchars($_REQUEST['sDueDTFrom']);
	//var_dump($sDueDTFrom);
	$sDueDTTo     = htmlspecialchars($_REQUEST['sDueDTTo']);
	//var_dump($sDueDTTo);
	$sSellCharge  = htmlspecialchars($_REQUEST['sSellCharge']);
	//var_dump($sSellCharge);

	$orderBy = $_REQUEST['orderBy'];
	//var_dump($orderBy);
	$orderTo = $_REQUEST['orderTo'];
	//var_dump($orderTo);
	$sPage   = $_REQUEST['sPage'];
	//var_dump($sPage);

	$articleNo   = mysqli_real_escape_string($conn, $_REQUEST['articleNo']);
	//var_dump($articleNo);
	$article     = mysqli_real_escape_string($conn, $_REQUEST['article']);
	//var_dump($article);
	$room        = mysqli_real_escape_string($conn, $_REQUEST['room']);
	//var_dump($room);
	$keyPlace    = mysqli_real_escape_string($conn, $_REQUEST['keyPlace']);
	//var_dump($keyPlace);
	$address     = mysqli_real_escape_string($conn, $_REQUEST['address']);
	//var_dump($address);
	$articleNote = mysqli_real_escape_string($conn, $_REQUEST['articleNote']);
	//var_dump($articleNote);
	$keyBox      = mysqli_real_escape_string($conn, $_REQUEST['keyBox']);
	//var_dump($keyBox);
	$drawing     = mysqli_real_escape_string($conn, $_REQUEST['drawing']);
	//var_dump($drawing);
	$sellCharge  = mysqli_real_escape_string($conn, $_REQUEST['sellCharge']);
	//var_dump($sellCharge);
	$del         = mysqli_real_escape_string($conn, $_REQUEST['del']);
	//var_dump($del);

	if ($articleNo) {
		// 編集
		$sql = fnSqlArticleUpdate($articleNo, $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del);
		//var_dump($sql);
		$res = mysqli_query($conn, $sql);
		//var_dump($res);
	} else {
		// 新規登録
		$sql = fnSqlArticleInsert(fnNextNo('ARTICLE'), $article, $room, $keyPlace, $address, $articleNote, $keyBox, $drawing, $sellCharge, $del);
		//var_dump($sql);
		$res = mysqli_query($conn, $sql);
		//var_dump($res);
		/* $sql = fnSqlFManagerInsert(fnNextNo('FM'),$article,$room,$articleNote,$del);
			$res = mysqli_query($conn,$sql); */
	}
	//var_dump($articleNo);
	$_REQUEST['act'] = 'articleSearch';
	//var_dump($_REQUEST);
	subArticle();
}


//
//物件管理削除処理
//
function subArticleDelete()
{
	$conn = fnDbConnect();
	//var_dump($conn);

	$articleNo = $_REQUEST['articleNo'];
	//var_dump($articleNo);

	$sql = fnSqlArticleDelete($articleNo);
	//var_dump($sql);
	$res = mysqli_query($conn, $sql);
	//var_dump($res);

	$_REQUEST['act'] = 'articleSearch';
	//var_dump($_REQUEST);
	subArticle();
}
?>