<!DOCTYPE html>
<html>
<head>
	<title></title>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	
	<form method="POST" action="">
		<div class="db">
			<label><b>Database Name: </b></label>                 
			<input id="database" type="text" name="database" placeholder="database">
			<br><br>
			<label><b>Select number of tables: </b></label>
			<select id="brojTb" name="brojTb">
			<?php                                     // Drop-down list for selecting number of Tables
			$maxTb = 50;
			$brojacTb = 1;
			for ($i=0; $i < $maxTb; $i++) { ?>
				<option value=<?php echo $brojacTb; ?>><?php $brojacTb++; echo $i+1; ?></option>
			<?php } ?>
		</select>
		<input type="submit" name="brojTabela" value="Refresh"><br>
	</div>

	<?php
	if (isset($_POST['brojTb'])) { 					
		$brojTb = $_POST['brojTb'];
			for ($i=0; $i < $brojTb; $i++) {  
				$colNumber = 'colNumber'.($i+1);
				?> 

				<!--   Beginning of Table   -->    
				<div class="grid-container"> 
					<div class="top"><h1>Table <?php echo $i+1 ?></h1></div>
					<div class="left"> 
						<?php $idTabeleElement = 'table'.($i+1); ?>
						<?php $idTabele = isset($_POST[$idTabeleElement])? $_POST[$idTabeleElement] : ""; ?>
						<b>Table: </b><input id=<?php echo $idTabeleElement ?> type="text" name=<?php echo $idTabeleElement ?> placeholder="Table Name" >
						<?php $engineId = "engine".($i+1); ?> 
						<b>Engine: </b><select id=<?php echo $engineId ?> name=<?php echo $engineId ?>>      <!--   Drop-down list for selecting Table Engine   -->  
							<option value="InnoDb">INNODB</option>
							<option value="MyIsam">MYISAM</option>
							<option value="mrgmyisam">MRG_MYISAM</option>
							<option value="csv">CSV</option>
							<option value="federated">FEDERATED</option>
							<option value="archive">ARCHIVE</option>
						</select>
						<br><br>



						<hr>
						<b>Columns: </b><select id=<?php echo $colNumber ?> name=<?php echo $colNumber ?>> <!--  Drop-down list for selecting number of Collumns -->
							<?php              
							$max = 50;
							$brojacKolona = 1;
							for ($p=0; $p < $max; $p++) { ?>

								<option value="<?php echo $brojacKolona; ?>"><?php $brojacKolona++; echo $p+1; ?></option>
							<?php } ?>
						</select>
						<input type="submit" name="brojTabela" value="Refresh"><br><br>
						<?php

						if (isset($_POST[$colNumber])) {     
							$brojKolona = $_POST[$colNumber];
						for ($c=0; $c < $brojKolona; $c++) {  
							?>

							<label><?php echo $c+1; ?></label>
							<input id=<?php echo 'column'.($i+1).($c+1); ?> type="text" name=<?php echo 'column'.($i+1).($c+1); ?> placeholder="Column Name" >
							<input id=<?php echo 'type'.($i+1).($c+1); ?> type="text" name=<?php echo 'type'.($i+1).($c+1); ?> placeholder="Column Type" >
							
							NN<input id=<?php echo 'null'.($i+1).($c+1); ?> type="checkbox" name=<?php echo 'null'.($i+1).($c+1); ?>>
							PK<input id=<?php echo 'pk'.($i+1).($c+1); ?> type="checkbox" name=<?php echo 'pk'.($i+1).($c+1); ?>>
							UQ<input id=<?php echo 'uq'.($i+1).($c+1); ?> type="checkbox" name=<?php echo 'uq'.($i+1).($c+1); ?>>
							AI<input id=<?php echo 'ai'.($i+1).($c+1); ?> type="checkbox" name=<?php echo 'ai'.($i+1).($c+1); ?>>

							
							<br>
						<?php } ?>
					<?php } ?>
				</div>

				<div class=<?php echo "right".($i+1); ?>>
					
					<!--   Beginning of Foreign Key   --> 

					<b>Foreign Keys: </b><select id=<?php echo "sfk".$i ?> name=<?php echo "sfk".$i ?>> <!--  Drop-down list for selecting number of Foreign Keys -->
						<?php
						$brojacFk = 1;
						for ($p=0; $p < $maxTb; $p++) { ?>

							<option value="<?php echo $brojacFk; ?>"><?php $brojacFk++; echo $p+1; ?></option>
						<?php } ?>
					</select>
					<input type="submit" name="brojKljuceva" value="Refresh">
					<br><br>

					<?php if (isset($_POST["sfk".$i])) {     
						$brojFk = $_POST["sfk".$i]; 
						for ($f=0; $f < $brojFk; $f++) { 

							?>
							 <hr>

							

							<div class="txtBox">FK Name: <br><input id="<?php echo 'fkname'.($i+1).($f+1); ?>" placeholder="Foreign Key Name" type="text" name='<?php echo 'fkname'.($i+1).($f+1); ?>'></div>
							<div class="txtBox">Ref. Table: <br><input id="<?php echo 'rtable'.($i+1).($f+1); ?>" placeholder="Referenced Table" type="text" name='<?php echo 'rtable'.($i+1).($f+1); ?>'></div>
							<?php $onupdateId = "onupdate".($i+1).($f+1); ?> 
							On Update: <select id=<?php echo $onupdateId ?> name=<?php echo $onupdateId ?>>      <!--   Drop-down list for On Update option   -->  
							<option value="RESTRICT">RESTRICT</option>
							<option value="CASCADE">CASCADE</option>
							<option value="SET NULL">SET NULL</option>
							<option selected value="NO ACTION">NO ACTION</option>
							</select>

							<?php $ondeleteId = "ondelete".($i+1).($f+1); ?> 
							On Delete: <select id=<?php echo $ondeleteId ?> name=<?php echo $ondeleteId ?>>      <!--   Drop-down list for On Delete option   -->  
							<option value="RESTRICT">RESTRICT</option>
							<option value="CASCADE">CASCADE</option>
							<option value="SET NULL">SET NULL</option>
							<option selected value="NO ACTION">NO ACTION</option>
							</select>
							<div id=<?php echo "fkdiv".($i+1).($f+1); ?>>
								<button id=<?php echo "dodaj".($i+1).($f+1); ?> onclick="<?php echo 'addFields'.($i+1).($f+1); ?>()" type="button">Add</button>
							</div> <br>
						<?php } } ?>
					</div>
					<br> 
				</div>                  <!--  End of Foreign Key   --> 

				<br> <!--   End of Table          -->
			<?php } ?>
		<?php } if(isset($_POST['brojTb'])){ ?>  
			<input style="font-size: 130%; font-weight: bold; margin-left: 95%; width: 5%;" type="submit" name="finish" value="Done">
		<?php } ?>
	</form>
	<?php require 'script.php'; ?>
</body>
</html>


<?php require 'sql.php'; ?>
