<script> 
	document.getElementById('brojTb').value = "<?php echo $_POST['brojTb']?>";
	document.getElementById('database').value = "<?php echo $_POST['database']?>"; 
</script>
<?php 
$brojTb = 0;
if (isset($_POST['brojTb'])) { 					
	$brojTb = $_POST['brojTb'];}
	for ($i=0; $i < $brojTb; $i++) { 
		$engineId = 'engine'.($i+1);
		$tableId = 'table'.($i+1);
		$fkNumberId = 'sfk'.$i;
		$colNumber = 'colNumber'.($i+1);
		?>
		<script type="text/javascript">
			document.getElementById('<?php echo $engineId ?>').value = '<?php echo $_POST[$engineId];?>';   
			document.getElementById('<?php echo $tableId ?>').value = '<?php echo $_POST[$tableId];?>';   
			document.getElementById('<?php echo $colNumber ?>').value ='<?php echo $_POST[$colNumber];?>';
			document.getElementById('<?php echo $fkNumberId ?>').value ='<?php echo $_POST[$fkNumberId];?>'; 
		</script>
		<?php
		$brojKolona = 0;
		if(isset($_POST[$colNumber])){ $brojKolona = $_POST[$colNumber];}
		for ($c=0; $c < $brojKolona; $c++) { 
			$columnId = 'column'.($i+1).($c+1);
			$typeId = 'type'.($i+1).($c+1);
			$nullId = 'null'.($i+1).($c+1);
			$pkId = 'pk'.($i+1).($c+1);
			$uqId = 'uq'.($i+1).($c+1);
			$aiId = 'ai'.($i+1).($c+1);
			?>
			<script type="text/javascript">              
				document.getElementById('<?php echo $columnId; ?>').value = '<?php echo $_POST[$columnId];?>';    
		    </script>
	     	<script type="text/javascript"> 
				document.getElementById('<?php echo $typeId; ?>').value = '<?php echo $_POST[$typeId];?>';	  
			</script>
			<script type="text/javascript"> 
				document.getElementById('<?php echo $nullId; ?>').checked = '<?php echo $_POST[$nullId];?>'; 
			</script>
			<script type="text/javascript"> 
				document.getElementById('<?php echo $pkId; ?>').checked = '<?php echo $_POST[$pkId];?>';   
			</script>
			<script type="text/javascript"> 
				document.getElementById('<?php echo $uqId; ?>').checked = '<?php echo $_POST[$uqId];?>';  
			</script>
			<script type="text/javascript"> 
				document.getElementById('<?php echo $aiId; ?>').checked = '<?php echo $_POST[$aiId];?>';
			</script>
		<?php }
		$brojFk = isset($_POST[$fkNumberId])?$_POST[$fkNumberId]:1;
		for ($f=0; $f < $brojFk; $f++) { 
			$number = 1 ?>
			<script type="text/javascript">
				var number = <?php echo $number ?>; 
				function <?php echo "addFields".($i+1).($f+1); ?>(){    
					var container = document.createElement("div");
					var container = document.getElementById('<?php echo "fkdiv".($i+1).($f+1); ?>');
					var dodaj = document.getElementById('<?php echo "dodaj".($i+1).($f+1); ?>');
					if(number <= 50){
						var br = document.createElement("br");
						var input = document.createElement("input");
						var input2 = document.createElement("input");
						var button = document.createElement("button");
						var txt = document.createTextNode("Column: ");
						var txt2 = document.createTextNode("Ref. Column: ");
						var container2 = document.createElement("container2");
						var containerTxt1 = document.createElement("containerTxt1");
						var containerTxt2 = document.createElement("containerTxt2");
						containerTxt1.className = "txt1";
						containerTxt2.className = "txt1";
						button.className = "dugme";
						button.innerHTML = "Remove";

						input.type = "text";
						input.id = "Member"+number+"<?php echo "t".$i."f".$f; ?>";
						input.name = input.id;
						input.placeholder = "Column Name";
						input2.type = "text";
						input2.id = "Memberr"+number+"<?php echo "t".$i."f".$f; ?>"; 
						input2.name = input2.id;
						input2.placeholder = "Referenced Column";
						button.onclick = function(){
							$(container2).empty();
						};
						container.insertBefore(container2, dodaj);
						containerTxt1.appendChild(txt);
						containerTxt1.appendChild(document.createElement('br'));
						containerTxt1.appendChild(input);
						containerTxt2.appendChild(txt2);
						containerTxt2.appendChild(document.createElement('br'));
						containerTxt2.appendChild(input2);
						container2.appendChild(containerTxt1);
						container2.appendChild(containerTxt2);
						container2.appendChild(button);

						container2.appendChild(br);

						<?php $number++; ?>
					}
					else{ alert("Max is 50"); }

				}
			</script>
			<script type="text/javascript">
				document.getElementById('<?php echo 'ondelete'.($i+1).($f+1); ?>').value = '<?php echo $_POST['ondelete'.($i+1).($f+1)];?>';
				document.getElementById('<?php echo 'onupdate'.($i+1).($f+1); ?>').value = '<?php echo $_POST['onupdate'.($i+1).($f+1)];?>';
			</script>
			<script type="text/javascript">
				document.getElementById('<?php echo 'fkname'.($i+1).($f+1); ?>').value = '<?php echo $_POST['fkname'.($i+1).($f+1)];?>';
			</script>
			<script type="text/javascript">
				document.getElementById('<?php echo 'rtable'.($i+1).($f+1); ?>').value = '<?php echo $_POST['rtable'.($i+1).($f+1)];?>';
			</script>
			<?php 
			for ($n=0; $n < ($number+1); $n++) { ?>
				
				<script type="text/javascript">
				document.getElementById('<?php echo 'Member'.($n+1).'t'.$i.'f'.$f; ?>').value = '<?php echo $_POST['Member'.($n+1).'t'.$i.'f'.$f];?>';
				</script>

			<?php 
		}
		}
	} 

	?>