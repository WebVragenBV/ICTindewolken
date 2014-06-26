<?php
    function dbConnect(){
        try{
            $username = 'groepb_ict';
            $password = 'Tdx0ZKXT';
            $conn = new pdo("mysql:host=localhost;dbname=groepb_ict;", $username, $password);
            return $conn;
			
        }   
		catch(PDOException $e){
            $error = 'ERROR'. $e->getMessage();
        }
    }
?>