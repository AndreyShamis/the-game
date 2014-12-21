<?php
/**
 * Created by PhpStorm.
 * User: werd
 * Date: 12/18/14
 * Time: 5:38 PM
 */

include "Matrix.php";

$m = new Matrix();
echo "Size :" . $m->SizeString();
$m->setElement(0,0,1);
$m->setElement(1,0,2);
$m->setElement(2,0,3);
//echo "<br/>";
//echo $m;
//echo "<br/>";
$m->setElement(0,3,6);
$m->setElement(0,4,8);
//echo $m;
//echo "<br/>";
$d = new Matrix();
$d->setElement(1,0,2);
$d->setElement(1,1,10);
//echo $d;
echo "<br/>";
$t;
try{
    $t = $m->Add($d);

    //echo $t;
}
catch(Exception $ex){
    echo "Exception:" . $ex."<br/>";
}
?>

<table style="width: 100%;" border="1">
    <tr>
        <td>A</td>
        <td>B</td>
        <td>A+B</td>
        <td>A*3</td>
        <td>A^T</td>
        <td>A*(A^T)</td>
    </tr>

    <tr>
        <td><?php echo $m;?> <?php echo "|Rows|: " . $m->getRowsSize();?><?php echo " |Cols|: " . $m->getColumnsSize();?> <?php echo $m->SizeString();?></td>
        <td><?php echo $d;?><?php echo "|Rows|: " . $m->getRowsSize();?><?php echo " |Cols|: " . $m->getColumnsSize();?> <?php echo $m->SizeString();?></td>
        <td><?php echo $t;?></td>
        <td><?php echo $m->ScalarMultiplication(3);?></td>
        <td><?php
            $mt =$m->Transposition();
            echo $mt;?>
            <?php echo "|Rows|: " . $mt->getRowsSize();?><?php echo " |Cols|: " . $mt->getColumnsSize();?> <?php echo $mt->SizeString();?>
        </td>
        <td><?php
            echo $m->Multiplication($mt);
            ?></td>
    </tr>

    <tr>
        <td>A=A[3]<->A[4]</td>
        <td>A=A[4]*3 [Row Multiplication]</td>
        <td>A=A[4]<-A[1]*2 [Row addition]</td>
        <td>A*3</td>
        <td>A^T</td>
        <td>A*(A^T)</td>
    </tr>
    <tr>
        <td>A: <?php
  //          echo $m;
//echo "<pre>";
            //print_r($m);
            //$mS =  $m->RowSwitch(3,4);

            //print_r($m);
            //echo $mS;
            ?> <?php echo "|Rows|: " . $m->getRowsSize();?><?php echo " |Cols|: " . $m->getColumnsSize();?> <?php echo $m->SizeString();?></td>
        <td><?php
            $m->RowMultiplication(3,4);
            echo $m;
            ?><?php echo "|Rows|: " . $m->getRowsSize();?><?php echo " |Cols|: " . $m->getColumnsSize();?> <?php echo $m->SizeString();?></td>
        <td><?php
            echo $m->RowAddition(4,1,2);
            ?></td>
        <td><?php echo $m->ScalarMultiplication(3);?></td>
        <td><?php
            $mt =$m->Transposition();
            echo $mt;?>
            <?php echo "|Rows|: " . $mt->getRowsSize();?><?php echo " |Cols|: " . $mt->getColumnsSize();?> <?php echo $mt->SizeString();?>
        </td>
        <td><?php
            //echo $m->Multiplication($mt);
            ?></td>
    </tr>
</table>
<?php

echo "<br/><pre>";
//print_r($m);
?>
<a href="/Regression">Regression</a><br/>
<a href="/build02">build02</a><br/>