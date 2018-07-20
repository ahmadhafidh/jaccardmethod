<?php
	class M_jaccard extends CI_Model
	{
		
		function hitung($data1, $data2){
			//mengecilkan kedua kalimat
			$kalimat1 = strtolower($data1);
			$kalimat2 = strtolower($data2);
			
			//memisahkan kalimat setiap ada spasi
			$potongan[0] = explode(' ',$kalimat1);
			$potongan[1] = explode(' ',$kalimat2);

			//Mengecek apakah dalam 1 kalimat ada kata yang sama atau tidak, jika ada kata yang sama maka dijadikan satu
			for($k=0; $k<=1; $k++){
				$x=0;
				$y=0;
				$sama[$x]=null;
				for($i=0; $i<count($potongan[$k]); $i++){					
					for($j = ($i+1); $j<count($potongan[$k]); $j++){		
						if($potongan[$k][$i]==$potongan[$k][$j]){	
							$sama[$x]=$j;								//menyimpan index kata yang sama
							$x++;
							$sama[$x]=null;
						}
					}
				}
				for($i=0; $i<count($potongan[$k]); $i++){
					$cek=0;
					for($j=0; $j<count($sama); $j++){		
						if($i==$sama[$j]&&$i!=0){						//jika $i sama dengan index kata yang sama, maka $cek + 1
							$cek++;	
						}
					}
					if($cek==0){										//Jika cek > 0  maka kata pada index tsb tidak dipakai/dibuang
						$hasil[$k][$y]=$potongan[$k][$i];
						$y++;
					}
				}
			}

			//Untuk menhitung banyak irisan
			$hasil['irisan'] = 0;

			for ($i=0 ; $i<count($hasil[0]); $i++ ){
				for ($j=0 ; $j<count($hasil[1]); $j++ ){
					if($hasil[0][$i]==$hasil[1][$j]){
						$hasil['irisan']++;
					}
				}
			}

			//Menghitung seluruh kata di 2 kealimat termasuk irisan pada kalimat ke-2
			$hasil['jumlahawal'] = (count($hasil[0]))+(count($hasil[1]));

			//Menghitung seluruh kata di 2 kealimat tanpa menghitung kata irisan pada kalimat ke-2
			$hasil['jumlahakhir'] = $hasil['jumlahawal'] - $hasil['irisan'];

			//Menghitung Jaccard
			$hasil['jaccard'] = $hasil['irisan']/$hasil['jumlahakhir'];

			return $hasil;
		}		
	}
?>