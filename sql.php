<div class="res">
<?php
if (isset($_POST['finish'])) {
	echo "<br>Results: ";
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = isset($_POST['database'])? $_POST['database'] : "";

// Create connection
	$conn = new mysqli($servername, $username, $password);
// Check connection
	if ($conn->connect_error) {
		die("<bad>Connection failed: " . $conn->connect_error."</bad><br>");
	} 

// Create database
	$sql = "CREATE DATABASE ".$dbName;
	if ($conn->query($sql) === TRUE) {
		echo "<hr><good>Database created successfully"."</good><br>";
	} else {
		echo "<hr><bad>Error creating database: " . $conn->error."</bad><br>";
	}

	$conn->close();

	$conn = new mysqli($servername, $username, $password, $dbName);
	$fkStringAlter = "";
	for ($i=0; $i < ($brojTb+1); $i++) { 
		$engine = isset($_POST['engine'.($i+1)])? $_POST['engine'.($i+1)] : "InnoDb";
		if (isset($_POST['table'.($i+1)])) {  // Checking if table with this name exists, if not continue to next iteration.
			$kolone = "";       
			$pk = "";         
			$uq = "";
			$fkString = "";
			$brKljuceva = 0;
			$brKolona = 0;

			if(isset($_POST["sfk".$i])){ $brKljuceva = $_POST["sfk".$i];}   
			for ($f=0; $f < ($brKljuceva+1); $f++) { 
				$ondelete = "NO ACTION";
				$onupdate = "NO ACTION";
				if (isset($_POST['ondelete'.($i+1).($f+1)])) { $ondelete = $_POST['ondelete'.($i+1).($f+1)]; }
				if (isset($_POST['onupdate'.($i+1).($f+1)])) { $onupdate = $_POST['onupdate'.($i+1).($f+1)]; }
				if (isset($_POST['fkname'.($i+1).($f+1)]) && $_POST['fkname'.($i+1).($f+1)] != "") {  

					if (isset($_POST['fkname'.($i+1).($f+1)])) {
						$fkStringAlter .= " ALTER TABLE ".$_POST['table'.($i+1)]." ADD CONSTRAINT ".$_POST['fkname'.($i+1).($f+1)]." FOREIGN KEY (";
					}

					for ($n=0; $n < $maxTb; $n++) { 
						$member1 = 'Member'.($n+1)."t".$i."f".$f;
						if (isset($_POST[$member1])) {
							$fkStringAlter .= $_POST[$member1].", ";
						}
					}
					$fkStringAlter = rtrim($fkStringAlter, ", ");
					$fkStringAlter .= ") ";

					if (isset($_POST['rtable'.($i+1).($f+1)])) {
						$fkStringAlter .= "REFERENCES ".$_POST['rtable'.($i+1).($f+1)]."(";
					}

					for ($n=0; $n < $maxTb; $n++) { 
						$member2 = 'Memberr'.($n+1)."t".$i."f".$f;
						if (isset($_POST[$member2])) {
							$fkStringAlter .= $_POST[$member2].", ";
						}
					}
					$fkStringAlter = rtrim($fkStringAlter, ", ");
					$fkStringAlter .= ") "."ON DELETE ".$ondelete." ON UPDATE ".$onupdate."; ";
				}

			}
			if(isset($_POST['colNumber'.($i+1)])){ $brKljuceva = $_POST['colNumber'.($i+1)];}   
			for ($f=0; $f < ($brKljuceva+1); $f++) {
				if (isset($_POST['column'.($i+1).($f+1)]) && isset($_POST['type'.($i+1).($f+1)])) { 
					$fk = "";
					$null = "";
					$ai = "";
					if(isset($_POST['null'.($i+1).($f+1)])) { $null=" NOT NULL "; }
					if(isset($_POST['ai'.($i+1).($f+1)])) { $ai=" AUTO_INCREMENT "; }
					if(isset($_POST['pk'.($i+1).($f+1)])) { $pk=", PRIMARY KEY (".$_POST['column'.($i+1).($f+1)].") "; }
					if(isset($_POST['uq'.($i+1).($f+1)])) { $uq.=", UNIQUE (".$_POST['column'.($i+1).($f+1)].") "; }
					$kolone .= $_POST['column'.($i+1).($f+1)]." ".$_POST['type'.($i+1).($f+1)].
					$null.$ai.
					", ";
				}
			}	
			$fkString = rtrim($fkString, ", ");  
			$kolone = rtrim($kolone, ", ");  	
			if ($uq != "") {
				$uq = rtrim($uq, ", ");		  
			}
			if ($pk != "" && $uq == "") {
				$pk = rtrim($pk, ", ");    
			}
			
			$sql = "CREATE TABLE ".$_POST['table'.($i+1)]." ( ".$kolone.$pk.$uq." )
			ENGINE = ".$engine." ;";
			echo "<br><hr><b>".$sql."</b><br>";  // Shows generated script for creating table at the end of the page.
			if ($conn->query($sql) === TRUE) {
				echo "<good>Table ".($i+1)." created successfully</good>"."<br>";
			} else {
				echo "<bad>Error creating table ".($i+1).": " . $conn->error."</bad><br>";
			}
		}
	}
	if ($fkStringAlter != "") {
		$fkStringAlter = rtrim($fkStringAlter, "; ");
		$FkArray = explode(";", $fkStringAlter);
		foreach ($FkArray as $Fk) {
			echo "<br><hr><b>".$Fk."</b><br>";  // Shows generated script for adding Foreign Key at the end of the page.
			if ($conn->query($Fk) === TRUE) {
				echo "<good>Table altered successfully</good>"."<br>";
			} else {
				echo "<bad>Error altering table: " . $conn->error."</bad><br>";
			}
		}
	}
} ?>
</div>