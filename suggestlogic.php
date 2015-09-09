<?php
	require_once('sql.php');
	$characteristics = array(); /* characteristics has lower priority*/
	$purpose = array();  /*purpose has second priority */
	$feature = array(); /*feature has highest priority */
	$suggestPlan1 = array();
	$suggestPlan2 = array();
	$suggestPlan3 = array();
	$processorPref = array();
	$casePref = array();
	$graphicPref = array();
	$casePref = array();
	$monitorPref = array();
	$motherboardPref = array();
	$powersupplyPref = array();
	$memoryPref = array();
	$hardDrivesPref = array();
	if(empty($_POST['check_list'])) 
	{
		echo "<b>Please Select Atleast One Option.</b>";
	}
	else
	{
		/*conncet to mysql database*/
		$GLOBALS['newconn'] = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
		$newconn->connect();
		calPreference($_POST['check_list']);
	}
	$fp = fopen("html/suggest.html", "r");
	$suggest_result = fread($fp, filesize("html/suggest.html"));
	fclose($fp);
	
	$str = "";
	for($i = 1; $i <= 3; $i++){
	
	$plan = fopen("html/plan.html", "r");
	$plan_str = fread($plan, filesize("html/plan.html"));
	fclose($plan);
	$fd = fopen("html/product_instance.html","r");
	$plan_all = "";
	$plan_model = fread($fd, filesize("html/product_instance.html"));
	fclose($fd);
	$plan_substr = $plan_model;
	
	//processor
	$instance = $GLOBALS['suggestPlan'.(string)$i][0];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Processor",$plan_substr);
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//motherboard
	$instance = $GLOBALS['suggestPlan'.(string)$i][1];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Motherboard",$plan_substr);
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//graphic
	$instance = $GLOBALS['suggestPlan'.(string)$i][2];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Graphic",$plan_substr);
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//case
	$instance = $GLOBALS['suggestPlan'.(string)$i][3];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Case",$plan_substr);  
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//memory
	$instance = $GLOBALS['suggestPlan'.(string)$i][4];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Memory",$plan_substr);  
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//harddrive
	$instance = $GLOBALS['suggestPlan'.(string)$i][5];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Hard Drive",$plan_substr); 
	        $plan_all .= $plan_substr;
	        $plan_substr = $plan_model;
	//powersupply
	$instance = $GLOBALS['suggestPlan'.(string)$i][6];
	        $product_link = "../products/".$instance[0].".html";
	        $plan_substr=str_replace("*product_link*",$product_link,$plan_substr);
	        $plan_substr=str_replace("*name*",$instance[0],$plan_substr);
	        $plan_substr=str_replace("*brand*",$instance[1],$plan_substr);
	        $plan_substr=str_replace("*price*",$instance[2],$plan_substr);
	        $plan_substr=str_replace("*image_link*",$instance[3],$plan_substr);
	        $plan_substr=str_replace("*category*","Power Supply",$plan_substr); 
	        $plan_all .= $plan_substr;                        
		
	//write to plan page
	$fd = fopen("html/plans/plan".(string)$i.".html", "w");
	$plan_str = str_replace("<!--*show_result*-->", $plan_all, $plan_str);
	fwrite($fd, $plan_str);
	fclose($fd);
	
	$str .= "<tr><td><div align=\"left\"><a href=\"plans/plan".(string)$i.".html\"><font color = \"blue\">Plan ".(string)$i."</font></a></div></td>";
	$str .= "<td><div align=\"center\">$".(string)$GLOBALS['suggestPlan'.(string)$i][7]."</div></td></tr>";
	
	}
	
	$suggest_result = str_replace("<!--plan_links-->", $str, $suggest_result);
	$fp = fopen("html/suggest_result.html", "w");
	fwrite($fp, $suggest_result);
	fclose($fp);
	
	
	header('Location: html/suggest_result.html');
		
	//functions
	function push_array_helper(&$array, $planIndex)
	{
		array_push($array, $GLOBALS['processorPref'][$planIndex]);
		array_push($array, $GLOBALS['motherboardPref'][$planIndex]);
		array_push($array, $GLOBALS['graphicPref'][$planIndex]);
		array_push($array, $GLOBALS['casePref'][$planIndex]);
		array_push($array, $GLOBALS['memoryPref'][$planIndex]);
		array_push($array, $GLOBALS['hardDrivesPref'][$planIndex]);
		array_push($array, $GLOBALS['powersupplyPref'][$planIndex]);
		$totalPrice = $GLOBALS['processorPref'][$planIndex][2]+$GLOBALS['motherboardPref'][$planIndex][2]+
						  $GLOBALS['graphicPref'][$planIndex][2]+$GLOBALS['casePref'][$planIndex][2]+
						  $GLOBALS['memoryPref'][$planIndex][2]+$GLOBALS['hardDrivesPref'][$planIndex][2]+
						  $GLOBALS['powersupplyPref'][$planIndex][2];
		array_push($array,$totalPrice);
	}
	function plan_maker()
	{
		$numTentativePlan = count($GLOBALS['processorPref']);

		if($numTentativePlan == 3)
		{
			push_array_helper($GLOBALS['suggestPlan1'],0);
			push_array_helper($GLOBALS['suggestPlan2'],1);
			push_array_helper($GLOBALS['suggestPlan3'],2);
			
		}
		if($numTentativePlan == 6)
		{
			push_array_helper($GLOBALS['suggestPlan1'],rand(0,1));
			push_array_helper($GLOBALS['suggestPlan2'],rand(2,3));
			push_array_helper($GLOBALS['suggestPlan3'],rand(4,5));
			
		}
		if($numTentativePlan == 9)
		{
			push_array_helper($GLOBALS['suggestPlan1'],rand(0,2));
			push_array_helper($GLOBALS['suggestPlan2'],rand(3,5));
			push_array_helper($GLOBALS['suggestPlan3'],rand(6,8));
		}
	
	}
	function prefcharacteristics()
	{
		/*conbination*/
		/*audult's requirment dominate the others. */
		if($GLOBALS['adultDom'])
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(300,150);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(300,100);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(150,30);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(120,20,"8GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(150,30,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(130, 80, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(170, 90, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(130,50,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

		/*	echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);.*/

		}
		elseif ($GLOBALS['StudentDom']&& !$GLOBALS['MaleDom']&& !$GLOBALS['FemaleDom']&& !$GLOBALS['HighPerformanceDom']) 
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(200,100);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(160,100);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(80,60);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(80,20,"4GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(100,30,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(100, 40, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(110, 50, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(80,30,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}
			/*echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/
		}
		else
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(250,150);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(160,120);		
			$caseR = $GLOBALS['newconn']->lookupCasesByColorAndPrice(90,40,"red");
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(100,40,"4GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(100,80,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(100, 70, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(110, 80, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(80,30,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

			/* count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/
		} 
	}
	function prefpurpose(){
		if($GLOBALS['GameDom'])
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(500,200);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(600,300);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(150,50);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(300,80,"16GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(200,50,"2TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(130, 80, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(170, 90, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(130,50,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

			/*echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/

		}
		elseif(count($GLOBALS['purpose']==1)&& $GLOBALS['ISDom']&&!$GLOBALS['HighPerformanceDom']) 
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(180,100);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(150,90);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(80,50);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(90,40,"2GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(80,30,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(100, 70, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(110, 90, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(90,30,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}
		}
		else
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(180,50);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(200,40);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(80,50);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(90,20,"4GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(80,30,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(100, 80, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(130, 90, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(90,30,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

			/*echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/

		}
	}
	function preffeature(){
		if($GLOBALS['HighPerformanceDom'])
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(500,200);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(450,200);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(150,60);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(180,40,"8GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(174,70,"2TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(130, 80, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(170, 90, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(130,50,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

			/*echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/

		}
		else
		{
			$processorR = $GLOBALS['newconn']->lookupProcessorByprice(180,50);
			$graphicR = $GLOBALS['newconn']->lookupGraphicByprice(150,40);		
			$caseR = $GLOBALS['newconn']->lookupCasesByprice(80,50);
			$memoryR = $GLOBALS['newconn']->lookupMemoryBypriceAndSize(90,20,"4GB");
			$hardDrivesR = $GLOBALS['newconn']->lookupHardDrivesBypriceandSize(80,30,"1TB");
			$motherboardR = array();
			foreach($processorR as $instance)
			{
				$brand = $instance[1];
				if($brand == "AMD")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(100, 40, "AMD");
					array_push($motherboardR, $mbc[0]);
				}
				if($brand == "Intel")
				{
					$mbc = $GLOBALS['newconn']->lookupMotherBoardBypriceAndManf(110, 60, "Intel");
					array_push($motherboardR, $mbc[0]);
				}
			}
			$powersupplyR = array();
			for($i=0; $i < 3; $i++)
			{
				$TotalPowerConsumption = intval($processorR[$i][8])+intval($graphicR[$i][9])+intval($memoryR[$i][8])+
										 intval($hardDrivesR[$i][8])+intval($motherboardR[$i][10]);

				$UpperPower = $TotalPowerConsumption*1.7;
				$LowerPower = $TotalPowerConsumption*1.3;
				$ps = $GLOBALS['newconn']->lookupPowerSupplyByPowerAndPrice(90,30,$UpperPower, $LowerPower);
				array_push($powersupplyR, $ps[0]);
			}
			for($j=0; $j<3; $j++)
			{
				array_push($GLOBALS['processorPref'], $processorR[$j]);
				array_push($GLOBALS['graphicPref'], $graphicR[$j]);
				array_push($GLOBALS['casePref'],$caseR[$j]);
				array_push($GLOBALS['motherboardPref'], $motherboardR[$j]);
				array_push($GLOBALS['memoryPref'], $memoryR[$j]);
				array_push($GLOBALS['hardDrivesPref'], $hardDrivesR[$j]);
				array_push($GLOBALS['powersupplyPref'],$powersupplyR[$j]);
			}

			/*echo count($processorR);
			echo count($graphicR);
			echo count($caseR);
			echo count($motherboardR);
			echo count($memoryR);
			echo count($hardDrivesR);*/

		}
		
	}
	function calPreference($preferenceList){
		$GLOBALS['adultDom'] = False;
		$GLOBALS['GameDom'] = False;
		$GLOBALS['StudentDom'] = False;
		$GLOBALS['MaleDom'] = False;
		$GLOBALS['FemaleDom'] = False;
		$GLOBALS['MoviesDom'] = False;				
		$GLOBALS['OfficeDom'] = False;
		$GLOBALS['CodingDom'] = False;
		$GLOBALS['ISDom'] = False;
		$GLOBALS['LPDom'] = False;
		$GLOBALS['PSDom'] = False;
		$GLOBALS['HighPerformanceDom'] = False;
		foreach($preferenceList as $preference)
		{
			switch($preference)
			{
				case "Student":
					array_push($GLOBALS['characteristics'],$preference);
					$GLOBALS['StudentDom'] = True;
					break;

				case "Male":
					array_push($GLOBALS['characteristics'],$preference);
					$GLOBALS['MaleDom'] = True;
					break;

				case "Adult":
					array_push($GLOBALS['characteristics'],$preference);
					$GLOBALS['adultDom'] = True;
					//prefAdult();
					break;

				case "Female":
					array_push($GLOBALS['characteristics'],$preference);
					$GLOBALS['FemaleDom'] = True;
					break;

				case "Office":
					array_push($GLOBALS['purpose'],$preference);
					$GLOBALS['OfficeDom'] = True;//prefOffice();
					break;

				case "Game":
					array_push($GLOBALS['purpose'],$preference);
					$GLOBALS['GameDom'] = True;
					break;

				case "Movies":
					array_push($GLOBALS['purpose'],$preference);
					$GLOBALS['MoviesDom'] = True;
					break;

				case "Coding":
					array_push($GLOBALS['purpose'],$preference);
					$GLOBALS['CodingDom'] = True;
					break;

				case "Internet Surfing":
					array_push($GLOBALS['purpose'],$preference);
					$GLOBALS['ISDom'] = True;
					break;

				case "Low Price":
					array_push($GLOBALS['feature'],$preference);
					$GLOBALS['LPDom'] = True;
					break;

				case "High Performance":
					array_push($GLOBALS['feature'],$preference);
					//prefHighPerformance();
					$GLOBALS['HighPerformanceDom'] = True;
					break;

				case "Power Saving":
					array_push($GLOBALS['feature'],$preference);
					$GLOBALS['PSDom'] = True;
					break;
			}
		}
		if(count($GLOBALS['characteristics']))
			prefcharacteristics();
		if(count($GLOBALS['purpose']))
			prefpurpose();
		if(count($GLOBALS['feature']))
			preffeature();

		plan_maker(); //generate plan;
		/*
		print_r($GLOBALS['suggestPlan1'][4]);
		echo "<br/>";
		print_r($GLOBALS['suggestPlan2'][4]);
		echo "<br/>";
		print_r($GLOBALS['suggestPlan3'][4]);*/
		}

?>