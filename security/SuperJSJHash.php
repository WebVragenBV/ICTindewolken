<?php 







		function SuperJSJHash($password){
				$hash1 = hexdec(hash('ripemd128', $password));
				$hash3 = hexdec(hash('haval128,3',$password));
				$hash4 = (($hash3)*($hash1));
				$hash5 = hash('whirlpool',hash('sha512',$hash4));
				$hash8 = divide2JSJ($hash5);
				$hash9 = hash('sha512',hash('whirlpool',$hash8));
				$hash10 = divide4JSJ($hash9);
				$hash11=hash('sha512',hash('tiger192,4',hash('whirlpool',$hash10.$hash1)));
				$hash12 = divide4JSJ(divide2JSJ(divide4JSJ($hash11)));
				$hash13 = divide8JSJ($hash12);
				$hash14 = divide8JSJ(divide4JSJ(divide2JSJ($hash13)));
				$hash15 = divide32JSJ($hash14);
				$hashtotal = $hash15;
				return $hashtotal;
			}
		function divide2JSJ($hash){
				$lengt = (strlen($hash)/2);
				$hash6sub1 = substr($hash,0,$lengt);
				$hash6sub2 = substr($hash,$lengt,$lengt);
				$hash7sub1 = hash('sha512',$hash6sub1);
				$hash7sub2 = hash('whirlpool',$hash6sub2);
				$hash7sub2 = divide4JSJ($hash7sub2);
				$hash7sub1 = divide4JSJ($hash7sub1);
				$hash8 = $hash7sub1.$hash7sub2;
			return $hash8;
		}
		function divide4JSJ($hash){
				$lengt = (strlen($hash)/4);
				$sub1= substr($hash,0,$lengt);
				$sub2= substr($hash,$lengt,$lengt);
				$sub3= substr($hash,($lengt*2),$lengt);
				$sub4= substr($hash,($lengt*3),$lengt);
				$hashsub1=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub1)));
				$hashsub2=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub2)));
				$hashsub3=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub3)));
				$hashsub4=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub4)));
				$hashall = $hashsub1.$hashsub2.$hashsub3.$hashsub4;
			return $hashall;
		}
		function divide8JSJ($hash){
				$lengt = (strlen($hash)/8);
				$sub1= substr($hash,0,$lengt);
				$sub2= substr($hash,$lengt,$lengt);
				$sub3= substr($hash,($lengt*2),$lengt);
				$sub4= substr($hash,($lengt*3),$lengt);
				$sub5= substr($hash,($lengt*4),$lengt);
				$sub6= substr($hash,($lengt*5),$lengt);
				$sub7= substr($hash,($lengt*6),$lengt);
				$sub8= substr($hash,($lengt*7),$lengt);
				$hashsub1=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub1)));
				$hashsub2=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub2)));
				$hashsub3=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub3)));
				$hashsub4=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub4)));
				$hashsub5=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub5)));
				$hashsub6=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub6)));
				$hashsub7=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub7)));
				$hashsub8=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub8)));
				$hash1=hash('whirlpool',hash('gost',$hashsub1.$hashsub2.$hashsub3.$hashsub4));
				$hash2=hash('sha512',hash('gost',$hashsub5.$hashsub6.$hashsub7.$hashsub8));
				$hashall = $hash1.$hash2;
			return $hashall;
		}
				function divide32JSJ($hash){
				$lengt = (strlen($hash)/32);
				$sub1= substr($hash,0,$lengt);
				$sub2= substr($hash,$lengt,$lengt);
				$sub3= substr($hash,($lengt*2),$lengt);
				$sub4= substr($hash,($lengt*3),$lengt);
				$sub5= substr($hash,($lengt*4),$lengt);
				$sub6= substr($hash,($lengt*5),$lengt);
				$sub7= substr($hash,($lengt*6),$lengt);
				$sub8= substr($hash,($lengt*7),$lengt);
				$sub9= substr($hash,($lengt*8),$lengt);
				$sub10= substr($hash,($lengt*9),$lengt);
				$sub11= substr($hash,($lengt*10),$lengt);
				$sub12= substr($hash,($lengt*11),$lengt);
				$sub13= substr($hash,($lengt*12),$lengt);
				$sub14= substr($hash,($lengt*13),$lengt);
				$sub15= substr($hash,($lengt*14),$lengt);
				$sub16= substr($hash,($lengt*15),$lengt);
				$sub17= substr($hash,($lengt*16),$lengt);
				$sub18= substr($hash,($lengt*17),$lengt);
				$sub19= substr($hash,($lengt*18),$lengt);
				$sub20= substr($hash,($lengt*19),$lengt);
				$sub21= substr($hash,($lengt*20),$lengt);
				$sub22= substr($hash,($lengt*21),$lengt);
				$sub23= substr($hash,($lengt*22),$lengt);
				$sub24= substr($hash,($lengt*23),$lengt);
				$sub25= substr($hash,($lengt*24),$lengt);
				$sub26= substr($hash,($lengt*25),$lengt);
				$sub27= substr($hash,($lengt*26),$lengt);
				$sub28= substr($hash,($lengt*27),$lengt);
				$sub29= substr($hash,($lengt*28),$lengt);
				$sub30= substr($hash,($lengt*29),$lengt);
				$sub31= substr($hash,($lengt*30),$lengt);
				$sub32= substr($hash,($lengt*31),$lengt);
				$hashsub1=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub1)));
				$hashsub2=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub2)));
				$hashsub3=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub3)));
				$hashsub4=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub4)));
				$hashsub5=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub5)));
				$hashsub6=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub6)));
				$hashsub7=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub7)));
				$hashsub8=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub8)));
				$hashsub9=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub9)));
				$hashsub10=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub10)));
				$hashsub11=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub11)));
				$hashsub12=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub12)));
				$hashsub13=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub13)));
				$hashsub14=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub14)));
				$hashsub15=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub15)));
				$hashsub16=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub16)));
				$hashsub17=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub17)));
				$hashsub18=hash('whirlpool',hash('snefru',hash('tiger192,4',$sub18)));
				$hashsub19=hash('tiger192,4',hash('whirlpool',hash('snefru',$sub19)));
				$hashsub20=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub20)));
				$hashsub21=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub21)));
				$hashsub22=hash('whirlpool',hash('snefru',hash('tiger192,4',$sub22)));
				$hashsub23=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub23)));
				$hashsub24=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub24)));
				$hashsub25=hash('ripemd320',hash('tiger192,4',hash('whirlpool',$sub25)));
				$hashsub26=hash('whirlpool',hash('snefru',hash('tiger192,4',$sub26)));
				$hashsub27=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub27)));
				$hashsub28=hash('tiger192,4',hash('sha512',hash('whirlpool',$sub28)));
				$hashsub29=hash('sha512',hash('tiger192,4',hash('whirlpool',$sub29)));
				$hashsub30=hash('whirlpool',hash('sha512',hash('tiger192,4',$sub30)));
				$hashsub31=hash('tiger192,4',hash('whirlpool',hash('sha512',$sub31)));
				$hashsub32=hash('tiger192,4',hash('snefru',hash('whirlpool',$sub32)));
				$hash1=hash('whirlpool',hash('snefru',$hashsub1.$hashsub2.$hashsub3.$hashsub4));
				$hash2=hash('sha512',hash('gost',$hashsub5.$hashsub6.$hashsub7.$hashsub8));
				$hash3=hash('whirlpool',hash('snefru',$hashsub9.$hashsub10.$hashsub11.$hashsub12));
				$hash4=hash('sha512',hash('gost',$hashsub16.$hashsub15.$hashsub14.$hashsub13));
				$hash5=hash('whirlpool',hash('snefru',$hashsub17.$hashsub18.$hashsub19.$hashsub20));
				$hash6=hash('sha512',hash('snefru',$hashsub24.$hashsub23.$hashsub22.$hashsub21));
				$hash7=hash('whirlpool',hash('gost',$hashsub25.$hashsub26.$hashsub27.$hashsub28));
				$hash8=hash('sha512',hash('ripemd320',$hashsub32.$hashsub31.$hashsub30.$hashsub29));
				$hashall1 = hash('sha512',$hash1.$hash2.$hash3.$hash4);
				$hashall2 = hash('whirlpool',$hash5.$hash6.$hash7.$hash8);
				$hashall=$hashall2.$hashall1;
			return $hashall;
		}

?>