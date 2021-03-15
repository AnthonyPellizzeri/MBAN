<?php header('Access-Control-Allow-Origin: *'); ?>
<?php
    
    //    delete from Collaboration;
    //    delete from HookingArtwork;
    //    delete from Wall;
    //    delete from Artwork;
    $server = 'localhost';
    $user = 'root';
    $password = 'root';
    $database ='MBAN2019v2';
    $co = mysqli_connect($server,$user,$password,$database);
    
    if(mysqli_connect_errno()){
        echo "1"; // error code #1
        exit();
    }
    
    $action = $_POST["action"];
    switch ($action) {
        case 'searchTab':
            $idArtwork = $_POST["idArtwork"];
            $idUser = $_POST["idUser"];
            $query = "Select titleFR,Collaboration.idArtist_main,dateArtwork,heightArtwork,widthArtwork,Artwork.idArtwork FROM Artwork INNER JOIN Collaboration WHERE Artwork.idArtwork = Collaboration.idArtwork AND Artwork.idArtwork='".$idArtwork."';";
            $queryLike = "SELECT appreciationLike FROM Appreciation WHERE idArtwork='".$idArtwork."' AND idVisitor = '".$idUser."' ;";
            $queryComment = "SELECT appreciationCommentText FROM Appreciation WHERE idArtwork='".$idArtwork."' AND idVisitor = '".$idUser."' ;";

            $tab = mysqli_query($co,$query) or die("2: get tab query failed");
            
            if(mysqli_num_rows($tab)==0){
                echo "FAILED";
                exit();
            }else{
                $row = $tab->fetch_array(MYSQLI_ASSOC);
                $res="";
                foreach ($row as $key => $value) {
                    if($res == ""){
                        $res = $value;
                    }else{
                        $res = $res ."|".$value;
                    }
                }
                $resLike = mysqli_query($co,$queryLike);
                if(mysqli_num_rows($resLike)==0)
                    $res = $res."|"."0";
                else{
                    $rowLike = $resLike->fetch_array(MYSQLI_ASSOC);
                    foreach ($rowLike as $key => $value) {
                        $res = $res ."|". $value;
                    }
                }
                
                $resComment = mysqli_query($co,$queryComment);
                if(mysqli_num_rows($resComment)==0)
                    $res = $res."|"." ";
                else{
                    $rowComment = $resComment->fetch_array(MYSQLI_ASSOC);
                    foreach ($rowComment as $key => $value) {
                        $res = $res ."|". $value;
                    }
                }
                
                echo $res;
            }
            break;
            
        case 'insertArtwork':
            
            //insertion in wall table
            $wallId = $_POST["wallId"];
            $roomId = $_POST["roomName"];
            $WallPosX = (float) $_POST["WallPosX"];
            $WallPosY = (float) $_POST["WallPosY"];
            $WallPosZ = (float) $_POST["WallPosZ"];
            
            //echo $roomId."-".$wallId."-".$posY."-".$posX;
            
            $queryWall = "INSERT INTO Wall VALUES ('".$wallId."','".$roomId."',".$WallPosX.",".$WallPosY.",".$WallPosZ.");";
            mysqli_query($co,$queryWall);
            
            
            //insertion in artwork table
            $imageId = $_POST["imageId"];
            $height = (float) $_POST["height"];
            $width = (float) $_POST["width"];
            $paintingName = $_POST["paintingName"];
            $artist = $_POST["artist"];
            $dateArtwork = $_POST["date"];
            $dateBegin = $_POST["dateBegin"];
            $dateEnd = $_POST["dateEnd"];
            
            //echo $imageId."-".$height."-".$width."-".$paintingName;
            $queryArtwork = "INSERT INTO Artwork VALUES ('".$imageId."',".$height.",".$width.",null,null,null,'".addslashes($paintingName)."',null,null,'".$dateArtwork."','".$dateBegin."','".$dateEnd."',null,null);";
            mysqli_query($co,$queryArtwork);
            
            $queryArtist = "INSERT INTO Artist VALUES ('".$artist."',null,null,null,null,null,null,null);";
            mysqli_query($co,$queryArtist);
            $queryArtistCollab = "INSERT INTO Collaboration VALUES ('".$artist."',null,'".$imageId."');";
            mysqli_query($co,$queryArtistCollab);
            
            //insertion in hookingArtwork table
            $hookingId =(int) $_POST["hookingId"];
            $hookingDate = $_POST["hookingDate"];
            
            if($_POST["unhookingDate"] != "")
                $unhookingDate = "\'".$_POST["unhookingDate"]."\'";
            else
                $unhookingDate = "null";
            
            $wallId = $_POST["wallId"];
            $HaPosX = (float) $_POST["HAposX"];
            $HaPosY = (float) $_POST["HAposY"];
            $HaPosZ = (float) $_POST["HAposZ"];
            
            echo $hookingId."+".$wallId."+".$HaPosX."+".$HaPosY."+".$HaPosZ."+".$hookingDate."+".$unhookingDate;
            
            $queryHookingArtwork = "INSERT INTO HookingArtwork VALUES (".$hookingId.",'".$imageId."','".$wallId."','".$hookingDate."',".$HaPosX.",".$HaPosY.",".$HaPosZ.",".$unhookingDate.");";
            mysqli_query($co,$queryHookingArtwork);
            break;
            
        case 'insertHookingArtwork':
            $imageId = $_POST["imageId"];
            $hookingId =(int) $_POST["hookingId"];
            $hookingDate = $_POST["hookingDate"];
            
            if($_POST["unhookingDate"] != "")
                $unhookingDate = "\'".$_POST["unhookingDate"]."\'";
            else
                $unhookingDate = "null";
            
            $wallId = $_POST["wallId"];
            $posX = (float) $_POST["HAposX"];
            $posY = (float) $_POST["HAposY"];
            $posZ = (float) $_POST["HAposZ"];
            
            echo $hookingId."+".$wallId."+".$posX."+".$posY."+".$posZ."+".$hookingDate."+".$unhookingDate;
            
            $queryHookingArtwork = "INSERT INTO HookingArtwork VALUES (".$hookingId.",'".$imageId."','".$wallId."','".$hookingDate."',".$posX.",".$posY.",".$posZ.",".$unhookingDate.");";
            mysqli_query($co,$queryHookingArtwork);
            break;
            
        case 'insertWall':
            $wallId = $_POST["wallId"];
            $roomId = $_POST["roomName"];
            $posX = (float) $_POST["WallPosX"];
            $posY = (float) $_POST["WallPosY"];
            $posZ = (float) $_POST["WallPosZ"];
            
            //echo $roomId."-".$wallId."-".$posY."-".$posX;
            
            $queryWall = "INSERT INTO Wall VALUES ('".$wallId."','".$roomId."',".$posX.",".$posY.",".$posZ.");";
            mysqli_query($co,$queryWall);
            break;
            
        case 'insertLike':
            
            $imageId = $_POST["idArtwork"];
            $userId = $_POST["idUser"];
            $like = $_POST["like"];
            
            $query = 'SELECT * FROM Appreciation WHERE Appreciation.idVisitor = '.$userId.' AND Appreciation.idArtwork = "'.$imageId.'";';


            $resultQuery = mysqli_query($co,$query);
            if(mysqli_num_rows($resultQuery)>0){
                $query = 'UPDATE Appreciation SET Appreciation.appreciationLike = '.$like.',appreciationCommentDate = DATE(NOW()) WHERE Appreciation.idVisitor = '.$userId.' AND Appreciation.idArtwork = "'.$imageId.'";';
            }
            else{
                $query = 'INSERT INTO Appreciation(idVisitor,idArtwork,appreciationLike,appreciationCommentDate) VALUES('.$userId.',"'.$imageId.'",'.$like.',DATE(NOW()));';
            }

            mysqli_query($co,$query);
            break;
            
        case 'addComment':
            
            $imageId = $_POST["idArtwork"];
            $userId = $_POST["idUser"];
            $commentary = $_POST["commentary"];
            
            $commentary = addslashes($commentary);

            $query = 'SELECT * FROM Appreciation WHERE Appreciation.idVisitor = '.$userId.' AND Appreciation.idArtwork = "'.$imageId.'";';
            
            $resultQuery = mysqli_query($co,$query);
            if(mysqli_num_rows($resultQuery)>0){
                $query = 'UPDATE Appreciation SET Appreciation.appreciationCommentText = "'.$commentary.'",appreciationCommentDate = DATE(NOW()) WHERE Appreciation.idVisitor = '.$userId.' AND Appreciation.idArtwork = "'.$imageId.'";';
            }
            else{
                $query = 'INSERT INTO Appreciation(idVisitor,idArtwork,appreciationCommentText,appreciationCommentDate) VALUES('.$userId.',"'.$imageId.'","'.$commentary.'",DATE(NOW()));';
            }

            mysqli_query($co,$query);
            break;
            
        case 'getUsers':
            $query = "SELECT idVisitor FROM Visitor;";
            $resultQuery = mysqli_query($co,$query);
            $return ="";
            if(mysqli_num_rows($resultQuery)> 0)
                while($row = $resultQuery->fetch_assoc()) {
                    $return = $return ."|". $row["idVisitor"];
                }
            echo $return;
            break;
            
        case 'getArtworks':
            $query = "SELECT idArtwork FROM Artwork;";
            $resultQuery = mysqli_query($co,$query);
            $return ="";
            if(mysqli_num_rows($resultQuery)> 0)
                while($row = $resultQuery->fetch_assoc()) {
                    $return = $return ."|". $row["idArtwork"];
                }
            echo $return;
            break;
            
        case 'logIn':
            
            $pseudoOrEmail = $_POST["username"];
            $password = $_POST["password"];
            
            $queryGetPassword = "SELECT password FROM Visitor WHERE (pseudo='".$pseudoOrEmail."' OR email='".$pseudoOrEmail."');";
            $resultQueryGetPassword = mysqli_query($co,$queryGetPassword);
            $hashed_password="";
            while($row = $resultQueryGetPassword->fetch_assoc()) {
                $hashed_password = $row["password"];
            }
            if(password_verify($password, $hashed_password)) {
                $query = "SELECT v.idVisitor, v.pseudo,r.nameRight FROM Visitor v,Rights r WHERE (v.pseudo='".$pseudoOrEmail."' OR v.email='".$pseudoOrEmail."') AND v.password='".$hashed_password."' And r.idRight=v.idRight;";
                $resultQuery = mysqli_query($co,$query);
                if(mysqli_num_rows($resultQuery)==1){
                    while($row = $resultQuery->fetch_assoc()) {
                        $return = $row["idVisitor"]."|".$row["pseudo"]."|".$row["nameRight"];
                    }
                    echo $return;
                }
                else
                    echo "";
            }
            else
                echo "";
            break;
            
        case 'signUp':
            
            $pseudo = $_POST["username"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            
            echo $pseudo."/".$email."/".$password;
            $queryVerifyExistence = "SELECT idVisitor FROM Visitor WHERE pseudo='".$pseudo."' OR email='".$email."';";
            $resultQueryVerifyExistence = mysqli_query($co,$queryVerifyExistence);
            
            
            if(mysqli_num_rows($resultQueryVerifyExistence)==0){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO `Visitor` VALUES (NULL,'".$email."','".$pseudo."','".$hashed_password."',DEFAULT,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);";
                $resultQuery = mysqli_query($co,$query);
                
                echo mysqli_num_rows($resultQuery);
            }
            else
                echo 0;
            
            break;
            
        case 'profileSettings':
            
            //DEMOGRAPHIC DATA
            $visitor = $_POST["idVisitor"];
            $idVisit = $_POST["idVisit"];
            $birthday = $_POST["birthday"];
            $gender = $_POST["gender"];
            $frenchLevel = $_POST["frenchLevel"];
            $degree = $_POST["degree"];
            $profession = $_POST["profession"];
            $nationality = $_POST["nationality"];
            $country = $_POST["country"];
            $city = $_POST["city"];
            $height = $_POST["height"];
            $heightCamera = $_POST["heightCamera"];
            $birthday = $_POST["birthday"];
            $typeHeight = $_POST["typeHeight"];
            
            //INTERETS DATA
            $numberVisits = $_POST["numberVisits"];
            $freqVisitsMBAN = $_POST["freqVisitsMBAN"];
            $artKnowledge = $_POST["artKnowledge"];
            $freqVisitsGlobal = $_POST["freqVisitsGlobal"];
            $artImplication = $_POST["artImplication"];
            $museumTypes = $_POST["museumTypes"];
            
            //TOLERANCES DATA
            $visitingSpeed = $_POST["visitingSpeed"];
            $crowdTolerance = $_POST["crowdTolerance"];
            $degreeOfPerseverance = $_POST["degreeOfPerseverance"];
            $distanceTolerance = $_POST["distanceTolerance"];
            $userControl = $_POST["userControl"];
            $frequencyNotifications = $_POST["frequencyNotifications"];
            $troubleView = $_POST["troubleView"];
            
            //CONTEXT VISIT DATA
            $visitDuration = $_POST["visitDuration"];
            $progressiveness = $_POST["progressiveness"];
            $physicalTiredness = $_POST["physicalTiredness"];
            $mentalTiredness = $_POST["mentalTiredness"];
            $mood = $_POST["mood"];
            $motivationsVisit = $_POST["motivationsVisit"];
            $goalsVisit = $_POST["goalsVisit"];
            
            //RECOMMENDATIONS DATA
            $precision = $_POST["precision"];
            $diversity = $_POST["diversity"];
            $novelty = $_POST["novelty"];
            $serenpidity = $_POST["serenpidity"];
            $coverage = $_POST["coverage"];
            
            //VISIT STYLE DATA
            $visitStyle = $_POST["visitStyle"];
            
            $frenchLevel = addslashes($frenchLevel);
            $profession = addslashes($profession);
            $nationality = addslashes($nationality);
            $country = addslashes($country);
            $city = addslashes($city);
            $artKnowledge = addslashes($artKnowledge);
            $troubleView = addslashes($troubleView);
            $museumTypes = addslashes($museumTypes);
            
            if($birthday != "null")
                $birthday = "'".$birthday."'";
            if($profession != "null")
                $profession = "'".$profession."'";
            if($height != "null")
                $height = "'".$height."'";
            if($nationality != "null")
                $nationality = "'".$nationality."'";
            if($country != "null")
                $country = "'".$country."'";
            if($city != "null")
                $city = "'".$city."'";
            if($visitDuration != "null")
                $visitDuration = "'".$visitDuration."'";
            if($museumTypes != "null")
                $museumTypes = "'".$museumTypes."'";
            if($goalsVisit != "null")
                $goalsVisit = "'".$goalsVisit."'";
            if($motivationsVisit != "null")
                $motivationsVisit = "'".$motivationsVisit."'";
            if($visitStyle != "null")
                $visitStyle = "'".$visitStyle."'";
            
            if($heightCamera == "-1")
                $heightCamera = "null";

            $queryVisitor = "UPDATE Visitor SET birthday=".$birthday." , gender='".$gender."', height=".$height." , heightCamera=".$heightCamera." , mesureType='".$typeHeight."' , walkSpeed=".$visitingSpeed." , nationality=". $nationality." , country=".$country." , city=". $city." , profession=". $profession." , frenchLevel='". $frenchLevel."' , degree='".$degree."' , mbanVisitNumber =".$numberVisits." , mbanVisitRecency = ".$freqVisitsMBAN.", artKnowledge = ". $artKnowledge .", artImplication ='".$artImplication."' , museumVisitTypes = ". $museumTypes .", museumVisitFrequency = ".$freqVisitsGlobal.", troubleView = '". $troubleView ."' WHERE idVisitor = '".$visitor."'; ";
            $resultQueryVisitor = mysqli_query($co,$queryVisitor);

            $queryVisit = "UPDATE `Visit` SET `timeStampVisitMax`=$visitDuration,`styleVisit`=".$visitStyle.",`diversityVisitLevel`=".$diversity.",`newDiscoveryVisitLevel`=".$novelty.",`levelCoverageVisit`=".$coverage.",`crowdAnnoyanceVisit`=".$crowdTolerance.",`artworkMissingWithCrowdVisit`=".$degreeOfPerseverance.",`distanceToleranceVisit`=".$distanceTolerance.",`progressionVisitLevel`=".$progressiveness.",`goalsVisit`=".$goalsVisit.",`physicalTirednessVisitBefore`=".$physicalTiredness.",`mentalTirednessVisitBefore`=".$mentalTiredness.",`moodVisit`=".$mood.",`motivationVisit`=".$motivationsVisit.",`controlVisitLevel`=".$userControl.",`frequencyNotificationsTolerateVisit`=".$frequencyNotifications." WHERE `idVisit`='".$idVisit."';";
            
            $resultQueryVisit = mysqli_query($co,$queryVisit);
            
            break;
            
        case 'insertDistances':
            $idArtworkA = $_POST["idArtworkA"];
            $idArtworkB = $_POST["idArtworkB"];
            $metricDistance = $_POST["metricDistance"];
            
            $queryHookingArtworkA = "SELECT idHookingArtwork FROM HookingArtwork WHERE idArtwork = '".$idArtworkA."';";
            $queryHookingArtworkB = "SELECT idHookingArtwork FROM HookingArtwork WHERE idArtwork = '".$idArtworkB."';";
            $resultQueryA = mysqli_query($co,$queryHookingArtworkA);
            $resultQueryB = mysqli_query($co,$queryHookingArtworkB);
            $idHookingArtworkA ="";
            $idHookingArtworkB ="";
            if(mysqli_num_rows($resultQueryA)> 0 && mysqli_num_rows($resultQueryB)> 0){
                $idHookingArtworkA = $idHookingArtworkA."".$resultQueryA->fetch_assoc()["idHookingArtwork"];
                
                $idHookingArtworkB = $idHookingArtworkB."".$resultQueryB->fetch_assoc()["idHookingArtwork"];
                
                $resultQuery = "INSERT INTO DistanceArtwork VALUES(".$idHookingArtworkA.",".$idHookingArtworkB.",".$metricDistance.",null);";
                $resultQuery = mysqli_query($co,$resultQuery);
                echo 1;
            }else
                echo 0;
            
            break;
            
        case 'newVisit':
            //echo 2;
            $idVisitor = $_POST["idVisitor"];
            $dateVisit = $_POST["dateVisit"];
            $idTest = $_POST["idTest"];

            $queryVerifyExistence = "SELECT idVisit FROM Visit WHERE idVisitor='".$idVisitor."' AND visitDate='".$dateVisit."';";
            $resultQueryVerifyExistence = mysqli_query($co,$queryVerifyExistence);

            $idVisit = $dateVisit."_".$idVisitor;
            if(mysqli_num_rows($resultQueryVerifyExistence)>0){
                $idVisit = $idVisit."_".mysqli_num_rows($resultQueryVerifyExistence);
            }
            
            $query = "INSERT INTO `Visit` (`idVisit`, `idMuseum`, `idVisitor`,`idTest`, `visitDate`, `timeStampVisitMax`, `timeStampVisitReal`, `styleVisit`, `diversityVisitLevel`, `newDiscoveryVisitLevel`, `levelCoverageVisit`, `crowdAnnoyanceVisit`, `artworkMissingWithCrowdVisit`, `distanceToleranceVisit`, `progressionVisitLevel`, `goalsVisit`, `physicalTirednessVisitBefore`, `mentalTirednessVisitBefore`, `moodVisit`, `motivationVisit`, `controlVisitLevel`, `frequencyNotificationsTolerateVisit`, `lengthPath`) VALUES ('".$idVisit."', '1', '".$idVisitor."','".$idTest."', '".$dateVisit."', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);";
            
            echo $idVisit;
            $resultQuery = mysqli_query($co,$query);

            break;
            
            
        case 'createNewTest':
            
            $testName = $_POST["testName"];
            $idCreator = $_POST["idCreator"];
            $timeCreation = $_POST["timeCreation"];
            $dateTest = $_POST["dateTest"];
            $timeTest = $_POST["timeTest"];
            $algosSelected = $_POST["algosSelected"];
            $typeReco = $_POST["typeReco"];
            //echo $roomId."-".$wallId."-".$posY."-".$posX;
            $queryVerifyExistenceTest = "SELECT idTest FROM Test WHERE idTest = '".$testName."';";
            
            $resultQueryVerifying = mysqli_query($co,$queryVerifyExistenceTest);
            if(mysqli_num_rows($resultQueryVerifying)==0){
                echo "INSERT INTO Test VALUES ('".$testName."','".$idCreator."','".$timeCreation."','".$dateTest."','".$timeTest."','".$algosSelected."','".$typeReco."');";
                
                $queryCreateTest = "INSERT INTO Test VALUES ('".$testName."','".$idCreator."','".$timeCreation."','".$dateTest."','".$timeTest."','".$algosSelected."','".$typeReco."');";
                mysqli_query($co,$queryCreateTest);
            }else{
                echo "TEST ALREADY EXISTS";
            }
            break;
            
        case 'getTests':
            $query = "SELECT idTest FROM Test;";
            $resultQuery = mysqli_query($co,$query);
            $return ="";
            
            if(mysqli_num_rows($resultQuery)>0)
                while($row = $resultQuery->fetch_assoc()) {
                    $return = $return ."|". $row["idTest"];
                }
            else{
                $return = "NO TEST INSERTED";
            }
            echo $return;
            break;
            
            
        case 'getTypeReco':
            
            $idTest = $_POST["idTest"];

            $query = "SELECT typeRecoSelected FROM Test WHERE idTest = '".$idTest."';";
            
//            echo "SELECT typeRecoSelected FROM Test WHERE idTest = '".$idTest."';";
            $resultQuery = mysqli_query($co,$query);
            $return ="";
            
            if(mysqli_num_rows($resultQuery)>0)
                while($row = $resultQuery->fetch_assoc()) {
                    $return = $row["typeRecoSelected"];
                }
            else{
                $return = "ERROR";
            }
            echo $return;
            break;
            
        case 'insertAction':
            
            $idVisitor = $_POST["idVisitor"];
            $idVisit = $_POST["idVisit"];
            $idTest = $_POST["idTest"];
            $actionType = $_POST["actionType"];
            $actionValue = $_POST["actionValue"];
            $actionTimestamp = $_POST["actionTimestamp"];
            
            if($idVisit != "NULL")
                $idVisit = "'".$idVisit."'";
            if($idVisitor != "NULL")
                $idVisitor = "'".$idVisitor."'";
            if($idTest != "NULL")
                $idTest = "'".$idTest."'";
            
            $query = "INSERT INTO `Interaction` (`idInteraction`, `idVisitor`, `idVisit`,`idTest`, `typeInteraction`, `nameInteraction`, `timestamp`) VALUES (NULL,".$idVisitor.", ".$idVisit.",".$idTest.", '".$actionType."', '".$actionValue."', '".$actionTimestamp."');";
            mysqli_query($co,$query);
            break;
            
            
        case 'getProfileVisitor':
            
            $idVisitor = $_POST["idVisitor"];

            $queryVisitor = "SELECT birthday,gender,height,heightCamera,mesureType,walkSpeed,nationality,country,city,profession,frenchLevel,degree,mbanVisitNumber,mbanVisitRecency,artKnowledge,artImplication,museumVisitTypes,museumVisitFrequency,troubleView FROM Visitor WHERE idVisitor = '".$idVisitor."'; ";
            
            $resultQueryVisitor = mysqli_query($co,$queryVisitor);
            
            $row = $resultQueryVisitor->fetch_array(MYSQLI_ASSOC);
            $res="";
            foreach ($row as $key => $value) {
                if($res == ""){
                    $res = "|".$value;
                }else{
                    $res = $res ."|".$value;
                }
            }
            
            echo $res;
            break;

        case 'getRooms':
            $stmt = $co->prepare('SELECT r.id as "Room", rn.neighbor AS "Neighbor", r.floor AS "Floor" FROM room r JOIN room_neighbor rn ON r.id = rn.room ORDER BY r.id');

            $stmt->execute();
            $result = $stmt->get_result();

            $toReturn = "";

            while ($myrow = $result->fetch_assoc()) 
                $toReturn .= $myrow["Room"].';'.$myrow["Neighbor"].';'.$myrow["Floor"].'|';

            //Remove the last |
            echo substr($toReturn, 0, -1);

        break;

        case 'getArtworksRoom':
            $stmt = $co->prepare('SELECT artwork.idArtwork, hookingartwork.room_id FROM artwork JOIN hookingartwork ON artwork.idArtwork = hookingartwork.idArtwork WHERE room_id IS NOT NULL AND artwork.availability != 0');

            $stmt->execute();
            $result = $stmt->get_result();

            $toReturn = "";

            while ($myrow = $result->fetch_assoc()) 
                $toReturn .= $myrow["idArtwork"].';'.$myrow["room_id"].'|';

            //Remove the last |
            echo substr($toReturn, 0, -1);

        break;
    }
    
    /*$test = $_POST["test"];
     
     $testcheck = "Select test from test1 where test='".$test."';";
     
     $check = mysqli_query($co,$testcheck) or die("2: test check query failed");
     
     if(mysqli_num_rows($check)>0){
     echo "3: test already exists";
     exit();
     }
     
     $inserttest = "INSERT INTO test1 (test) VALUES ('".$test."');";
     mysqli_query($co,$inserttest) or die("4: test insert query failed");*/
    
    ?>
