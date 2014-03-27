<?php
	$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
	$rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
	$offset = ($page-1)*$rows;
	$filterRules = isset($_POST['filterRules']) ? ($_POST['filterRules']) : '';
	$cond = '1=1';
	if (!empty($filterRules)){
		$filterRules = json_decode($filterRules);
		//print_r ($filterRules);
		foreach($filterRules as $rule){
			$rule = get_object_vars($rule);
			$field = $rule['field'];
			$op = $rule['op'];
			$value = $rule['value'];
			if (!empty($value)){
				if ($op == 'contains'){
					$cond .= " and ($field like '%$value%')";
				} else if ($op == 'greater'){
					$cond .= " and $field>$value";
				}
			}
		}
	}
	
	$result = array();
	
	include 'conn.php';
	
	$rs = mysql_query("select count(*) from item where $cond");
	$row = mysql_fetch_row($rs);
	$result["total"] = $row[0];
	
	$rs = mysql_query("select * from item where $cond limit $offset,$rows");
	
	$items = array();
	while($row = mysql_fetch_object($rs)){
		array_push($items, $row);
	}
	$result["rows"] = $items;
	
	echo json_encode($result);
?>