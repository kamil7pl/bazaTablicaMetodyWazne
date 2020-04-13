<?php
class metody{//przeglądnąć
public function zTabeliDoTablicy($sql){//tablica tablic asocjacyjnych
		$tablica=array();
	$wynik=$this->con->query($sql);//select
			while($row=$wynik->fetch_assoc()){
				array_push($tablica, $row);
			}
			return $tablica;
	}
	public function podtablica($tablica=array(), $dlugoscPodTablicy){//do losowania z tablicy asocjacyjnej
		try{
			if($dlugoscPodTablicy<=count($tablica)){
			$tabKluczy=array_rand($tablica, $dlugoscPodTablicy);
			shuffle($tabKluczy);
			$podTablicaTablicyTablica=array();
			foreach($tabKluczy as $wartosc){
			$podTablicaTablicyTablica[$wartosc]=$tablica[$wartosc];
			}
			return $podTablicaTablicyTablica;
			}
			else throw new Exception("Błąd. Podjęcie próby wylosowania większej liczby słówek niż jest wprowadzona w bazie danych.");
		}
		catch(Exception $x){
			echo $x->getMessage();
		}
	}
	public function tablicaDoBazy($tablica=array()){//Tablica asocjacyjna do bazy. Zrobić obsługę błędów (liczba kolumn, długość)
	$ciag="(NULL, '".implode("','", $tablica)."')";
	return $ciag;
	}
	public function polaczenie($host="localhost", $user="root", $pass="", $dbName="jezyk"){//połączenie z bazą
    $con=new mysqli($host, $user, $pass, $dbName); 
    
    if (mysqli_connect_error())  
    { 
      die('Błąd połączenia.'); 
    } 
  
  
    return $con; 
    
    //$this->con->close(); 
  }
}
?>
