<?php
include_once("../include/mysqli.php");
include_once("config.php");

function curl_file_get_contents($durl){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $durl);
	curl_setopt($ch, CURLOPT_TIMEOUT, 5);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$r = curl_exec($ch);
	curl_close($ch);
	return $r;
}
//公用信息
$start = "lonely_";

//BB开始
$max = 0;
$sql = "select max(id) from {$start}bb_record";
$query = $mysqli->query($sql);
$rows = $query->fetch_array();
if($rows[0]){
	$max = $rows[0];
}else{
	$max=0;
}
$sign = md5($plantform."_".$merID."_".$key."_".$max);
$yy = curl_file_get_contents($fenjieHost."/bb!getData.do?plantform=".$plantform."&max=".$max."&sign=".$sign);
$json = json_decode($yy);
$bbplayed = 0;
if($json->result){
	if(count($json->playeds) > 0){
		foreach($json->playeds as $bet){
			try {
				$sql = "INSERT INTO `{$start}bb_record` (`id`, `username`, `type`, `userNamex`, `wagersID`, `wagersDate`, `serialID`, `roundNo`, `gameType`, `gameCode`, `result`, `card`, `betAmount`, `origin`, `commissionable`, `payoff`, `currency`, `exchangeRate`, `resultType`, `Commission`, `IsPaid`, `insertTime`)
				VALUES ('{$bet->id}', '{$bet->username}', '{$bet->type}', '{$bet->userName}', '{$bet->wagersID}', '{$bet->wagersDate}', '{$bet->serialID}', '{$bet->roundNo}', '{$bet->gameType}', '{$bet->gameCode}', '{$bet->result}', '{$bet->card}', '{$bet->betAmount}', '{$bet->origin}', '{$bet->commissionable}', '{$bet->payoff}', '{$bet->currency}', '{$bet->exchangeRate}', '{$bet->resultType}', '{$bet->commission}', '{$bet->isPaid}', '{$bet->insertTime}')";
				$mysqli->query($sql);// or die($sql);
				$qr = $mysqli->affected_rows;
				if($qr == 1){
					$bbplayed++;
				}
			} catch (Exception $e){
				//这里不用干什么
				echo "error ".$e;exit;
			}
		}
	}
}

//AG开始
$max1 = 0;
$max2 = 0;
$sql = "select max(id) from {$start}ag_record";
$query = $mysqli->query($sql);
$rows = $query->fetch_array();
if($rows[0]){
	$max1 = $rows[0];
}else{
	$max1=0;
}
$sql = "select max(id) from {$start}ag_transfer";
$query = $mysqli->query($sql);
$rows = $query->fetch_array();
if($rows[0]){
	$max2 = $rows[0];
}else{
	$max2=0;
}

$sign = md5($plantform."_".$merID."_".$key."_".$max1."_".$max2);
$yy = curl_file_get_contents($fenjieHost."/ag!getData.do?plantform=".$plantform."&max=".$max1."&max2=".$max2."&sign=".$sign);
$json = json_decode($yy);
$agplayed = 0;
$agtransfer = 0;
if($json->result){
	if(count($json->playeds) > 0){
		foreach($json->playeds as $bet){
			try {
				$sql = "INSERT INTO `{$start}ag_record` (`id`, `username`, `dataType`, `billNo`, `playerName`, `agentCode`, `gameCode`, `netAmount`, `betTime`, `gameType`, `betAmount`, `validBetAmount`, `flag`, `playType`, `currency`, `tableCode`, `loginIP`, `recalcuTime`, `platformType`, `remark`, `round`, `slottype`, `result`, `mainbillno`, `beforeCredit`, `betAmountBase`, `betAmountBonus`, `netAmountBase`, `netAmountBonus`, `deviceType`, `insertTime`) values (
					'{$bet->id}', '{$bet->username}', '{$bet->dataType}', '{$bet->billNo}', '{$bet->playerName}', '{$bet->agentCode}', '{$bet->gameCode}', '{$bet->netAmount}', '{$bet->betTime}', '{$bet->gameType}', '{$bet->betAmount}', '{$bet->validBetAmount}', '{$bet->flag}', '{$bet->playType}', '{$bet->currency}', '{$bet->tableCode}', '{$bet->loginIP}', '{$bet->recalcuTime}', '{$bet->platformType}', '{$bet->remark}', '{$bet->round}', '{$bet->slottype}', '{$bet->result}', '{$bet->mainbillno}', '{$bet->beforeCredit}', '{$bet->betAmountBase}', '{$bet->betAmountBonus}', '{$bet->netAmountBase}', '{$bet->netAmountBonus}', '{$bet->deviceType}', '{$bet->insertTime}')";
				$mysqli->query($sql);// or die($sql);
				$qr = $mysqli->affected_rows;
				if($qr == 1){
					$agplayed++;
				}
			} catch (Exception $e){
				//这里不用干什么
				echo "error ".$e;exit;
			}
		}
	}
	if(count($json->transfers) > 0){
		foreach($json->transfers as $transfer){
			try {
				$sql = "INSERT INTO `{$start}ag_transfer` (`id`, `username`, `counted`, `insertTime`, `dataType`, `xid`, `agentCode`, `transferId`, `tradeNo`, `platformId`, `platformType`, `playerName`, `transferType`, `transferAmount`, `previousAmount`, `currentAmount`, `currency`, `exchangeRate`, `IPaddress`, `flag`, `creationTime`, `gameCode`) values (
				'{$transfer->id}', '{$transfer->username}', '{$transfer->counted}', '{$transfer->insertTime}', '{$transfer->dataType}', '{$transfer->ID}', '{$transfer->agentCode}', '{$transfer->transferId}', '{$transfer->tradeNo}', '{$transfer->platformId}', '{$transfer->platformType}', '{$transfer->playerName}', '{$transfer->transferType}', '{$transfer->transferAmount}', '{$transfer->previousAmount}', '{$transfer->currentAmount}', '{$transfer->currency}', '{$transfer->exchangeRate}', '{$transfer->IP}', '{$transfer->flag}', '{$transfer->creationTime}', '{$transfer->gameCode}'
				)";
				$mysqli->query($sql);// or die($sql);
				$qr = $mysqli->affected_rows;
				if($qr == 1){
					$agtransfer++;
				}
			} catch (Exception $e){
				//这里不用干什么
				echo "error ".$e;exit;
			}
		}
	}
}

echo "{\"result\":true,\"bbplayed\":{$bbplayed},\"agplayed\":{$agplayed},\"agtransfer\":{$agtransfer}}";

?>