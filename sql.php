<?php
class mysql{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    // Create connection
    private $conn;
    
    function getconn(){
        return $this->conn;
    }
    
    function __construct($servername,$username,$password,$dbname){
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
    }
    
    function connect(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname, 3306);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
        //echo "Connected successfully <br>";
    }

    //User functions
       function addUser($Email, $Name, $Password){
        $Password = crypt($Password,$Password);
        $sql = "INSERT INTO User (Email, Name, Password)
    VALUES ('".$Email."', '".$Name."', '".$Password."');";
        if (mysqli_query($this->conn, $sql)) {
            
        	return true;
            //echo "User added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn)."<br>";
            return false;
        }
    }

    function verifyUser($Email, $Password){
        //print_r($_SESSION);
        if($_SESSION["loginState"]!=null)
            if($_SESSION["loginState"] == 1){
                return true; 
            }
        $sql = "SELECT Password FROM User WHERE Email = '".$Email."'";
        if ($result = mysqli_query($this->conn, $sql)) {
            $password_stored = $result->fetch_all()[0][0];
            if(crypt($Password,$Password) == $password_stored){
                $_SESSION["loginState"] = 1;
                $_SESSION["loginUser"] = $Email;
               // echo "user correct";
            	return true;
            }
            else{
            //    echo "user fail";
                return false;
                
            }
        } else {
            print_r($_SESSION);
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            return false;
        }
    
    }
    
    function removeUser($Email){
        
        $sql = "DELETE FROM User WHERE Email = '".$Email."';";
        if (mysqli_query($this->conn, $sql)) {
            return;
            //echo "User removed";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    //end user functions

    //hardware functions
   function addHardware_MB($Price, $Brand, $Name, $Chipset, $ChipsetMan, $Image, $Socket, $Usb){
        $sql = "INSERT INTO MotherBoard (Price, Brand, Name, Chipset, ChipsetManufacturer, Image, Socket, Usb)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Chipset."','".$ChipsetMan."','".$Image."','".$Socket."','".$Usb."');";
        if (mysqli_query($this->conn, $sql)) {
            return TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            return FALSE;
        }
    }
   
   function addHardware_KeyBoard($Price, $Brand, $Name, $Image, $Feature){
       $sql = "INSERT INTO KeyBoard (Price, Brand, Name, Price, Image, Feature)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Price."','".$Image."','".$Feature."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }
   
   function addHardware_Mem($Price, $Brand, $Name, $Capacity, $Image, $Speed,$PowerConsumption){
       $sql = "INSERT INTO Memory (Price, Brand, Name, Capacity, Image, Speed, PowerConsumption)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Capacity."','".$Image."','".$Speed."','".$PowerConsumption."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }

   function addHardware_Graphic($Price, $Brand, $Name, $Image, $chipsetManufacturer, $coreClock, $model, $PowerConsumption){
       $sql = "INSERT INTO Graphic (Price, Brand, Name, Image, chipsetManufacturer, coreClock, model, PowerConsumption)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Price."','".$Image."','".$chipsetManufacturer."','".$coreClock."','".$model."',,'".$PowerConsumption."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }
   
   function addHardware_Cases($Price, $Brand, $Name, $Image, $FrontPort, $MotherBoardCompatibility, $model){
       $sql = "INSERT INTO Cases (Price, Brand, Name, Image, FrontPort, MotherBoardCompatibility, model)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Price."','".$Image."','".$FrontPort."','".$MotherBoardCompatibility."','".$model."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }
   
   function addHardware_HardDrives($Price, $Brand, $Name, $Image, $Feature, $storageSize){
       $sql = "INSERT INTO HardDrives (Price, Brand, Name, Image, Feature, storageSize)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Price."','".$Image."','".$Feature."','".$storageSize."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }
   
   function addHardware_Processor($Price, $Brand, $Name, $Image, $Feature, $Description){
       $sql = "INSERT INTO Processor (Price, Brand, Name, Image, Feature, Description)
    VALUES (".$Price.",'".$Brand."', '".$Name."','".$Price."','".$Image."','".$Feature."','".$Description."');";
       if (mysqli_query($this->conn, $sql)) {
           return TRUE;
       } else {
           echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
           return FALSE;
       }
   }
   
     function removeHardware($Name){
        
        $sql = "DELETE FROM MotherBoard WHERE Name = '".$Name."';";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            return false;
        }
    }

    function lookupHardware($Name){
        $hardwarecate = array("Cases", "Graphic","HardDrives","Memory","Monitor","MotherBoard","Processor");
        $all_result = array();
        foreach($hardwarecate as $hardware){
            $sql = "SELECT * FROM Cases, Graphic, HardDrives, Memory, Monitor, MotherBoard, Processor, PowerSupply WHERE Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%'";
            if ($result = mysqli_query($this->conn, $sql)) {
                $tuple = $result->fetch_all();
                array_push($all_result, $tuple);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }  
        }
        return $all_result;
    }
    
    function lookupHardwareFromCat($Name, $Category){
    	$all_result = array();
    	$sql = "SELECT * FROM ".$Category." WHERE Name = '".$Name."'";
    	if ($result = mysqli_query($this->conn, $sql)){
    		$tuple = $result->fetch_all();
    		array_push($all_result, $tuple);
    	} else {
    		echo "Error: ". $sql ."<br>" . mysqli_error($this->conn);
    	}
    	return $all_result;
    }
    
    function lookupHardwareCat($Name, $hardware, $socket){
    	//echo $socket;
        $all_result = array();
            $sql = "SELECT * FROM ".$hardware." WHERE Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%'";
            if(strcmp($socket,"0") != 0){
		       if(strcmp($hardware, "MotherBoard") == 0 | strcmp($hardware, "Processor") == 0){
		            	$sql = "SELECT * FROM ".$hardware." WHERE socket = '".$socket."' AND (Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%')";
		           }    
		 }   
            if ($result = mysqli_query($this->conn, $sql)) {
                $tuple = $result->fetch_all();
                array_push($all_result, $tuple);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }  
        return $all_result;
    }
  
     function lookupHardwareLim($Name, $lim, $socket){
    
        $hardwarecate = array("Cases", "Graphic","HardDrives","Memory","Monitor","MotherBoard","Processor");
        $all_result = array();
        foreach($hardwarecate as $hardware){
	       	$sql = "SELECT * FROM ".$hardware." WHERE Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%' LIMIT ".$lim;
	        if(strcmp($socket,"0") != 0){
		       if(strcmp($hardware, "MotherBoard") == 0 | strcmp($hardware, "Processor") == 0){
		       		
		            	$sql = "SELECT * FROM ".$hardware." WHERE socket = '".$socket."' AND (Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%') LIMIT ".$lim;
		           }
		          
		 }    	 
		 
		 
	   	 if ($result = mysqli_query($this->conn, $sql)) {
	       		 $tuple = $result->fetch_all();
	      		  array_push($all_result, $tuple);
	   	 } 
	   	 else {
	        echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
	    	}  
	    	/*if(strcmp($hardware, "Processor") == 0){
	    		echo $socket."<br>";
	    		echo $sql."<br>";
	    		print_r($tuple);
	    		}*/
	}
	return $all_result;
    }
  
	
    function lookupSocket($Name, $cpu){
   	    if($cpu)
    	   	 $sql = "SELECT socket FROM Processor WHERE Name = '".$Name."'";
    	    else
    	    	 $sql = "SELECT socket FROM MotherBoard WHERE Name = '".$Name."'";
            if ($result = mysqli_query($this->conn, $sql)) {
                $tuple = $result->fetch_all()[0][0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }  
            return $tuple;
    }

    function selectHardwareBy($Coloumn, $limitation){
        
        $sql = "SELECT * FROM Hardware WHERE ".$Coloumn." = '".$limitation."'";
        if ($result = mysqli_query($this->conn, $sql)) {
            $tuple = $result->fetch_all();
            return $tuple;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }  
    }
    
    function get_avg_price($cate){
        $sql = "SELECT avg( price ) FROM ".$cate; 
        if ($result = mysqli_query($this->conn, $sql)) {
            $tuple = $result->fetch_all()[0][0];
            return intval($tuple);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        } 
    }
    
    function getPricePercentile($listOfHardware){
        $count = 0;
        $total = 0;
    	while($hardWareName = current($listOfHardware)){
            $sql = 'SELECT price FROM '.key($listOfHardware).' WHERE Name = "'.$hardWareName.'"';
            $num_of_all  = 0;
            $my_price = "";
            $my_rank = 0;
            if ($result = mysqli_query($this->conn, $sql)) {
                $my_price = $result->fetch_all()[0][0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            } 
            $sql = "SELECT count(*) FROM ".key($listOfHardware);
            if ($result = mysqli_query($this->conn, $sql)) {
                $num_of_all= intval($result->fetch_all()[0][0]);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            } 
            $sql = "SELECT count(*) FROM ".key($listOfHardware)." WHERE price < '".$my_price."'";
            if ($result = mysqli_query($this->conn, $sql)) {
                 $my_rank= intval($result->fetch_all()[0][0]);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            } 
            $total += $my_rank/$num_of_all;
            $count++;
            next($listOfHardware);
        }
        return $total/$count;
    }
    
    function get_suggested_hardware($need_lst, $precentile){
        $result_array = array();
        foreach($need_lst as $hardware){
            $sql = "SELECT count(*) FROM ".$hardware;
            $total_num = 0;
            if ($result = mysqli_query($this->conn, $sql)) {
                $total_num= intval($result->fetch_all()[0][0]);
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            } 
            $rank = intval($precentile * $total_num);
            $sql = "SELECT * FROM ".$hardware." ORDER BY price ASC LIMIT ".$rank.",".$rank;
            if ($result = mysqli_query($this->conn, $sql)) {
                $item = $result->fetch_all()[0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            } 
            $result_array[$hardware] = $item;
        }
        return $result_array;
    }
    
    function get_hardware_detail($itemlst){
        $result_array = array();
        while($item = current($itemlst)){
            $sql = 'SELECT * FROM '.key($itemlst).' WHERE Name = "'. $item.'"';
            if ($result = mysqli_query($this->conn, $sql)) {
                $single_item = $result->fetch_all()[0];
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            }
            $result_array[key($itemlst)] = $single_item;
            next($itemlst);
        }
        return $result_array;
    }
    
    function upgrade_hardware($cate, $percentile){
        $sql = "SELECT count(*) FROM ".$cate;
        $total_num = 0;
        if ($result = mysqli_query($this->conn, $sql)) {
            $total_num= intval($result->fetch_all()[0][0]);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
        $new_rank = intval($total_num * (1- (1- $percentile)/3));
        $sql = "SELECT * FROM ".$cate." ORDER BY price ASC LIMIT ".$new_rank.",".$new_rank;
        if ($result = mysqli_query($this->conn, $sql)) {
            $item = $result->fetch_all()[0];
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        } 
        return $item;
    }
    
    //end hardware functions

    //comment functions
    function addComment($Content, $Writer, $hardware){
         
        //echo date('Y-m-d H:i:s');
        $Date =  date('Y-m-d H:i:s');
        $sql = "INSERT INTO Review (username, hardwareName, date, content)
    VALUES ('".$Writer."', '".$hardware."', '".$Date."', '".$Content."');";
        if (mysqli_query($this->conn, $sql)) {
            return;
            //echo "Comment added";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn)."<br>";
        }
    }

    function removeComment($Writer, $Hardware, $Date){
        $sql = "DELETE FROM Review WHERE hardwareName = '".$Hardware."' AND username = '".$Writer."' AND date = '".$Date."';";
        if (mysqli_query($this->conn, $sql)) {
            return;
            //echo "Comment deleted";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    
    function getComments($Name){
    	$all_result = array();
    	$sql = "SELECT * from Review WHERE Review.hardwareName = '".$Name."' ORDER BY Review.date DESC;";
    	if ($result = mysqli_query($this->conn, $sql)) {
    		$tuple = $result->fetch_all();
    		array_push($all_result, $tuple);
    	}
    	else echo "Error: ".$sql."<br>".mysqli_error($this->conn);
    	return $all_result;
    }
    
    function lookupProcessorByprice($upper, $lower)
    {
        $sql = "SELECT * FROM Processor WHERE  price < ".$upper. " AND price >".$lower;
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupGraphicByprice($upper, $lower)
    {
        $sql = "SELECT * FROM Graphic WHERE  price <" .$upper. " AND price > ".$lower;
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupHardDrivesBypriceandSize($upper, $lower, $size)
    {
        $sql = "SELECT * FROM HardDrives WHERE  price <" .$upper. " AND price >" .$lower. " AND storageSize = '".$size."'";
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupMotherBoardBypriceAndManf($upper, $lower, $manf)
    {
        $sql = "SELECT * FROM MotherBoard WHERE price <" .$upper. " AND price >".$lower." AND chipsetManufacturer ='".$manf."'";
        ##echo $sql."<br/>";
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          return $resultH;
        }
    }

    function lookupCasesByprice($upper, $lower)
    {
        $sql = "SELECT * FROM Cases WHERE price <".$upper." AND price >".$lower;
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupMemoryBypriceAndSize($upper, $lower, $GB)
    {
        $sql = "SELECT * FROM Memory WHERE price <".$upper." AND price >".$lower. " AND capacity LIKE '%".$GB. "%'";
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupMoniorByprice($upper, $lower)
    {
        $sql = "SELECT * FROM Monitor WHERE price <" .$upper. " AND price >".$lower;
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupProcessorByName($family)
    {
        $hardware = "Processor";
        $sql = "SELECT * FROM ".$hardware." WHERE Name LIKE '%".$Name."%' OR Brand LIKE '%".$Name."%'";
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupCasesByColorAndPrice($upper, $lower, $color)
    {
        $hardware = "Cases";
        $sql = "SELECT * FROM ".$hardware." WHERE name LIKE '%".$color."%' AND price <".$upper." AND price >".$lower;
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          $j = rand(0, $i);
          $k = rand($i,count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          array_push($resultH, $tuple[$j]);
          array_push($resultH, $tuple[$k]);
          return $resultH;
        }
    }

    function lookupPowerSupplyByPowerAndPrice($upper, $lower, $upperpower, $lowerpower)
    {
        $hardware = "PowerSupply";
        $sql = "SELECT * FROM ".$hardware." WHERE power <".$upperpower." AND power >".$lowerpower." AND price <".$upper." AND price >".$lower." LIMIT 1";
        if($result = mysqli_query($this->conn, $sql))
        {
          $tuple = $result->fetch_all();
          $resultH = array();
          $i = rand(0, count($tuple)-1);
          array_push($resultH, $tuple[$i]);
          return $resultH;
        }
    }
    
       function UpdateHardware_MB($Price, $Brand, $Name, $Chipset, $ChipsetMan, $Image, $Socket, $Usb){
        $sql = "UPDATE MotherBoard SET brand ='".$Brand."',chipset = '".$Chipset."', chipsetManufacturer = '".$ChipsetMan."',socket = '".$Socket."', usb = '".$Usb."', price = '".$Price."' WHERE name = '".$Name."'";
        if (mysqli_query($this->conn, $sql)) {
            return TRUE;
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($this->conn);
            return FALSE;
        }
    }

    		
}

//test cases
//

//$newconn = new mysql("localhost","root","admin","411project");
//$newconn->connect();
//$newconn->verifyUser('tarrantzhang@gmail.com', '123456');
//removeUser('tarrantzhang@gmail.com');
//addHardware(200,2007,"Logitech","G5");
//$array = selectHardwareBy("Name","G1");
//print_r($array);
//addComment("test","me");
//
//$newconn = new mysql("engr-cpanel-mysql.engr.illinois.edu","jli100_cs411","Ljm@931028","jli100_cs411");
//$newconn->connect();
//$result =  $newconn->lookupHardware("ASUS");
//print_r($result);

?>