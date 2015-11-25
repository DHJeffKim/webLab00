<!DOCTYPE html>
<html>
<head>
    <title>Course list</title>
    <meta charset="utf-8" />
    <link href="courses.css" type="text/css" rel="stylesheet" />
</head>
<body>
<div id="header">
    <h1>Courses at CSE</h1>
<!-- Ex. 1: File of Courses -->
    <?php 
    $filename = "courses.tsv";
    $filelines = file($filename);
    ?>
    <p>
        Course list has <?=count($filelines)?> total courses
        and
        size of <?= filesize($filename)?> bytes.
    </p>
</div>
<div class="article">
    <div class="section">
        <h2>Today's Courses</h2>
<!-- Ex. 2: Today’s Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByNumber($listOfCourses, $numberOfCourses){
                $resultArray = array();
//                implement here.
                shuffle($listOfCourses);
                for($i=0;$i<$numberOfCourses;$i++){
                    $resultArray[]=$listOfCourses[$i];
                }
                return $resultArray;
            }
        ?>
        <ol>
            <?php if(empty($_GET["number_of_courses"])||!isset($_GET["number_of_courses"])){
                $Ncourses = 3;
            }else{
                $Ncourses = $_GET["number_of_courses"];
            }
            $Rarray = getCoursesByNumber($filelines,$Ncourses);
            foreach($Rarray as $course){
            ?>
            <li>
                <?php 
                    $Ncourses = explode("\t", $course);
                    $course = implode(" - ", $Ncourses);
                ?>
                <?= $course?>
            </li>
            <?php
                }
            ?>
        </ol>
    </div>
    <div class="section">
        <h2>Searching Courses</h2>
<!-- Ex. 3: Searching Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByCharacter($listOfCourses, $startCharacter){
                $resultArray = array();
                foreach($listOfCourses as $course){
                    if(substr($course,0,1)==$startCharacter){
                        $resultArray[]= $course;
                    }
                }
//                implement here.
                return $resultArray;
            }
        ?>
        <p>
            <?
            if(empty($_GET['character'])||!isset($_GET['character'])){
                $character = 'C';
            }else{
                $character = $_GET['character'];
            }?>
            Courses that started by <strong>'<?= $character ?>'</strong> are followings :
        </p>
        <ol>
            <?php foreach(getCoursesByCharacter($filelines,$character) as $course){
                $token = explode("\t", $course);
                $course = implode(" - ", $token);
            ?>
            <li>
                <?=$course?>
            </li>
            <?php    
            }?>
        </ol>
    </div>
    <div class="section">
        <h2>List of Courses</h2>
<!-- Ex. 4: List of Courses & Ex 6: Query Parameters -->
        <?php
            function getCoursesByOrder($listOfCourses, $orderby){
                if($orderby == 0){
                    sort($listOfCourses);
                }
                elseif($orderby == 1){
                    rsort($listOfCourses);
                }
                $resultArray = $listOfCourses;
//                implement here.
                return $resultArray;
            }
        ?>
        <?
            if(empty($_GET['orderby'])||!isset($_GET['orderby'])){
                $orderby = 0;
            }else{
                $orderby = $_GET['orderby'];
            }?>
        <p>All of courses ordered by <strong><?php if($orderby == 0){?><?="alphabetical order" ?><? } ?>
            <?php if($orderby == 1){?><?="alphabetical reverse order"?><? } ?>
        </strong> are followings : </p>
        <ol>
            <?php foreach(getCoursesByOrder($filelines, $orderby) as $course){
                $token = explode("\t", $course);
                $course = implode(" - ", $token);
            ?>
            <li <?if(strlen($token[0])>20){?>class="long"<? } ?>> <?= $course ?> </li>
            <?php } ?>
        </ol>
    </div>
    <div class="section">
        <h2>Adding Courses</h2>
<!-- Ex. 5: Adding Courses & Ex 6: Query Parameters -->
        <?php
        if(!empty($_GET['code_of_course'])&&!empty($_GET['new_course'])&&isset($_GET['new_course'])&&isset($_GET['code_of_course'])){
            file_put_contents("courses.tsv","\n".( $_GET['new_course'])."\t".($_GET['code_of_course']),FILE_APPEND); ?>
             <?="Adding a course is success!"?>
        <? }else{?>
            <?= "Input course doesn't exist"?>
        <? }?>
    </div>
</div>
<div id="footer">
    <a href="http://validator.w3.org/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-html.png" alt="Valid HTML5" />
    </a>
    <a href="http://jigsaw.w3.org/css-validator/check/referer">
        <img src="http://selab.hanyang.ac.kr/courses/cse326/2015/problems/images/w3c-css.png" alt="Valid CSS" />
    </a>
</div>
</body>
</html>