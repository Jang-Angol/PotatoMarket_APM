<div class="trade_history_table">
	    <table>
	        <tbody>
<?php
	$result = mysqli_query($connect, $sql);
	if($row = mysqli_fetch_array($result)){
		switch($row["trade_type"]){
				case 1:
					$type = "Sell";
					break;
				case 2:
					$type = "Buy";
					break;
				default:
					exit;
			}
		echo<<<END
			<tr><td class="trade_item_state_$row[trade_type]$row[trade_state]"></td><td class="server_icon_$row[server]"></td><td class="trade_title"><a href="item{$type}View.php?id=$row[no]">$row[title]</a></td><td class="trade_price">$row[price]</td><td class="trade_time">$row[date]</td></tr>

END;
		while($row = mysqli_fetch_array($result)){
			switch($row["trade_type"]){
				case 1:
					$type = "Sell";
					break;
				case 2:
					$type = "Buy";
					break;
				default:
					exit;
			}
		echo<<<END
			<tr><td class="trade_item_state_$row[trade_type]$row[trade_state]"></td><td class="server_icon_$row[server]"></td><td class="trade_title"><a href="item{$type}View.php?id=$row[no]">$row[title]</a></td><td class="trade_price">$row[price]</td><td class="trade_time">$row[date]</td></tr>

END;
		}
	} else {
		echo "<div class='trade_history_blink'>검색 결과가 없습니다</div>";
	}
	
	mysqli_close($connect);
?>
		</tbody>
    </table>
</div>