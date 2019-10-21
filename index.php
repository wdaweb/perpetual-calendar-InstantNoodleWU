<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>綜合練習-月曆製作</title>
    <style>
    *{
        list-style-type:none;
    }
    /*body {
        width: 500px;
        height: 300px;
        position: absolute;
        top: 50%;
        left: 50%;
        margin: -150px 0 0 -250px;
        display: table;
    }*/
    .bg{
        /*background:skyblue;*/
    }
    table{
        border-collapse: collapse;
        margin: 20px auto;
        /*display: table-cell;
        vertical-align: middle;*/
    }
    table td{
        width: 50px;
        height: 50px;
        padding:10px;
        border:2px solid #999;
    }
    tr > td:first-child ,tr > td:last-child{
        background: pink;
    }
    #yy {
        width: 100px;
        height: 50px;
        border:2px solid #999;
        margin: 0 auto;
        text-align:center;
        /*display: table-cell;
        vertical-align: middle;*/
    }
    .mm a {
        color: white;
        font-size:20px;
        text-decoration:none;
        padding: 0 75px 0 0;
    }
    .mm {
        width: 200px;
        height: 30px;
        background: skyblue;
        text-align:center;
        line-height:30px;
        border-radius: 5px;
        position: relative; 
        overflow: hidden;
        cursor: pointer;
        margin: 20px auto;
        padding:10px 10px 10px 10px;
        /*display: table-cell;
        vertical-align: middle;*/
        }
    .mm ::after {
        content: "";
        position: absolute;
        width: 30px;
        height: 80px;
        background:white;
        filter: blur(2px);
        opacity: 0.5;
        top: -10px;
        left: -45px;
        transition: left 0.5s;
        transform: rotate(15deg);
        }
    .mm :hover::after {
        left: 250px;
        }
    </style>
</head>
<body>
<?php
//決定月份
if (!empty($_GET['month'])) {
    $month=$_GET['month'];
} else {    
    $month=date("m");
}

//決定年份
if (!empty($_GET['year'])) {
    $y=$_GET['year'];
} else {
    $y=date("Y");
}


?>
<?php
    $sd=[
        9=>"生日",
        10=>"國慶日",
        25=>"光復節",
    ];
    $today=date("Y-m-d");
    $todayDays=date("d");
    $start=$y.'-'.$month.'-01';
    $startDay=date("w",strtotime($start));
    $days=date("t",strtotime($start));
    $endDay=date("w",strtotime("$y-$month-$days"));

?>
<div id="yy">
    <?php
    echo "<h2>". date("Y-m",strtotime($start))."</h2>";
    ?>
</div>
<br>

<?php

if ( $month==1 ) {

        ?>
        <div class="mm"> 
        <a href="index.php?month=<?=12;?>&year=<?=($y-1);?>">上一月</a>
        <a href="index.php?month=<?=$month+1;?>&year=<?=($y);?>">下一月</a>  
        </div>   
        <?php
    } else if($month==12){
        ?>
        <div class="mm">
        <a href="index.php?month=<?=$month-1;?>&year=<?=($y);?>">上一月</a>
        <a href="index.php?month=<?=1;?>&year=<?=($y+1);?>">下一月</a>
        </div> 
        <?php
    }else {
        ?>
        <div class="mm">
        <a href="index.php?month=<?=$month-1;?>&year=<?=($y);?>">上一月</a>
        <a href="index.php?month=<?=$month+1;?>&year=<?=($y);?>">下一月</a>
        </div> 
        <?php
    }
    
    ?>
<table border="1">
    <tr>
        <td>日</td>
        <td>一</td>
        <td>二</td>
        <td>三</td>
        <td>四</td>
        <td>五</td>
        <td>六</td>
    </tr>
<?php
for($i=0;$i<6;$i++){

    echo "<tr>";

    for($j=0;$j<7;$j++){
        if(!empty($sd[$i*7+$j+1-$startDay])){
            $str="";
        }else{
            $str="";
        }
        if($i==0){

            if($j<$startDay){
                 echo "<td></td>";

            }else{
                if(($i*7+$j+1-$startDay)==$todayDays){
                    
                    echo "    <td class='bg'>".($i*7+$j+1-$startDay).$str."</td>";    
                }else{

                    echo "    <td>".($i*7+$j+1-$startDay).$str."</td>";    
                }
            }
        }else{

            if(($i*7+$j+1-$startDay)<=$days){
                if(($i*7+$j+1-$startDay)==$todayDays){
                    echo "    <td class='bg'>".($i*7+$j+1-$startDay).$str."</td>";    
                }else{
                    echo "    <td>".($i*7+$j+1-$startDay).$str."</td>";    
                }
            }else{
                echo "    <td></td>";    
            }
        }
   }
    echo "</tr>";
}

?>
   
</table>

</body>
</html>