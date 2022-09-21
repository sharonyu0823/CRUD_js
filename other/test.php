<?php
$p=isset($_GET['p'])?$_GET['p']:1;//取得目前所在分頁 頁次 若無參數 則停在 第一頁
echo 'Total:'.$total=68;echo '<br/>';//資料總筆數 -----#可變動
echo 'Pageofone:'.$pageofone=2;echo '<br/>';//幾筆分成一頁 -----#可變動
echo 'Pages:'.$pages=ceil($total/$pageofone);echo '<br/>';//計算出總共有幾頁
echo 'Showpage:'.$showpage=9;echo '<br/>';//每次要顯示幾筆分頁 只能設為 單數 1 3 5 7 9 若設為 雙數一樣會加1 ex 設為 2 最終顯示還是3 -----#可變動
echo $cut=floor($showpage/2);//以目前所在頁次 為中心 往左右各顯示幾個頁次 以無條件捨去
echo '<hr/>';
for ($i=1;$i<=$pages; $i++) {//原頁次顯示 對照用
	echo '<li '.($p==$i?'style="color:green;"':'').'><a href="?p='.$i.'">'.$i.'</a></li>';
}
echo '<hr/>';
$left=1;//預設從第一筆開始
$right=$pages;//預設到最後一筆結束
if($pages>$showpage){//若總頁數大於 每次要顯示幾筆分頁 才要執行以下片段
	if($p<=$cut ){$left=$p-1;}else{$left=$cut;}//若所在頁面小於分割數
	if($p>$pages-$cut ){
		$right=($p==$pages?0:1);
		$left+=$left-$right;
	}else{$right=$cut+($cut-$left);}//若所在頁面小於 總分頁數-分割數
	$left=$p-$left;//以目前頁次為中心點 往左要顯示多少頁面
	$right=$p+$right;//以目前頁次為中心點 往右要顯示多少頁面
}
for ($i=$left;$i<=$right; $i++) {
	echo '<li '.($p==$i?'style="color:green;"':'').'><a href="?p='.$i.'">'.$i.'</a></li>';
}
?>