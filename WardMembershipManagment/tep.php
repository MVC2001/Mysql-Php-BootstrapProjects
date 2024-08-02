
			<a href="../logout.php">Logout</a>
            <?php
				$query = mysqli_query($connect, "SELECT * FROM `citizen_tbl` WHERE `cit_id`='$_SESSION[cit_id]'") or die(mysqli_error());
				$fetch = mysqli_fetch_array($query);
				echo "<h2 class='text-success'>".$fetch['fullname']."</h2>";
			?>

   <?php  $display_sms ="SELECT citizen_txts_tbl.text_id,citizen_txts_tbl.text_message,citizen_txts_tbl.fullname,citizen_txts_tbl.created_at, citizen_tbl.fullname FROM citizen_txts_tbl INNER JOIN citizen_tbl ON citizen_txts_tbl.fullname  = citizen_tbl.fullname WHERE cit_id=$_SESSION[cit_id];";
                       $result = mysqli_query($connect,$display_sms);
                 $number = mysqli_num_rows($result);
                 if ($number > 0) {
                     while($row = mysqli_fetch_assoc($result)) { ?>      
                        <textarea class="shadow" type="" style="margin-top: 5px;height:100px;width: 230px;">
                        <?php echo $row['text_message']?>
                        </textarea>
                        <button class="btn btn-primary" style="margin-left: 50px;"><b> <?php echo $row['created_at']?></b></button>
                        <a href="delete_mychats.php?text_id=<?php echo $row["text_id"]?>"><button class="btn btn-danger" style="border-radius:30px">Delete</button></a></td>
                        <hr>
             <?php } }?>
