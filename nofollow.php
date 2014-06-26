<?php
function nofollow($data){
	$data = str_replace("<a","<a rel=\"nofollow\" target=\"_blank\"",$data); //alle urls rel en target toevoegen (a in kleine letter)
	$data = str_replace("<A","<A rel=\"nofollow\" target=\"_blank\"",$data); //alle urls rel en target toevoegen (a in hoofdletters)
	return $data;
}

//test voorbeeld:
$content = 'Hoi ga maar naar <a href="//google.com">google</a> Of naar<A href="//google.com">google</A>';
echo nofollow($content);
?>