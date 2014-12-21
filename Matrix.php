<?php
/**
 * User: Andrey Shamis
 * Date: 12/18/14
 * Time: 6:14 PM
 */


require_once "Vector.php";

class Matrix {

    protected $m_Matrix;
    protected $m_Columns    = array();
    protected $m_Rows       = array();

    protected $m_DimensionX = 0;
    protected $m_DimensionY = 0;

    public function getRowsSize(){
        return count($this->m_Rows);
    }
    public function getColumnsSize(){
        return count($this->m_Columns);
    }
    /*
     *          4 x 6
     *      C O L U M N S
     *
     * R    1   2   3   4   3   3
     * O    8   7   5   4   2   3
     * W    6   7   5   8   0   5
     * S    7   9   6   4   8   0
     */
    public function __construct($y=3,$x=6){
        $this->m_DimensionX = $x;
        $this->m_DimensionY = $y;
        for($a=0;$a<$this->m_DimensionX;$a++){
            for($b=0;$b<$this->m_DimensionY;$b++){
                $this->m_Matrix[$b][$a]     = 0;
                $this->m_Columns[$b][$a]    = & $this->m_Matrix[$b][$a];
                $this->m_Rows   [$a][$b]    = & $this->m_Matrix[$b][$a];
            }
        }
    }

    /**
     * The size of a matrix is defined by the number of rows and columns that it contains.
     * A matrix with m rows and n columns is called an m × n matrix or m-by-n matrix,
     * while m and n are called its dimensions
     * @return int
     */
    public function Size(){
        //return array($this->m_DimensionX,$this->m_DimensionY);
        return array(count($this->m_Rows),count($this->m_Columns));
    }

    protected  function SizeToString(array &$arr){
        return $arr[0] . "x" . $arr[1];
    }

    public function SizeString(){
        return $this->SizeToString($this->Size());
    }

    public function ScalarMultiplication($scalar){
        $newMatrix = new Matrix($this->m_DimensionY,$this->m_DimensionX);
        for($a=0;$a<$this->m_DimensionX;$a++){
            for($b=0;$b<$this->m_DimensionY;$b++){
                $newMatrix->m_Matrix[$b][$a] = $this->m_Matrix[$b][$a] * $scalar;
            }
        }
        return $newMatrix;
    }

    public function Transposition(){
        $newMatrix = new Matrix($this->m_DimensionX,$this->m_DimensionY);
        for($a=0;$a<$this->m_DimensionX;$a++){
            for($b=0;$b<$this->m_DimensionY;$b++){
                $newMatrix->m_Matrix[$a][$b] = $this->m_Matrix[$b][$a];
            }
        }
        return $newMatrix;
    }

    public function setElement($x,$y,$val){
        $this->m_Matrix[$x][$y] = $val;
    }

    public function __toString(){
        $ret = "";

        //echo  "<pre>" . print_r($this->m_Matrix,1) . "</pre>";

        for($a=0;$a<$this->m_DimensionX;$a++){
            $ret .= "|";
            for($b=0;$b<$this->m_DimensionY;$b++){
                $ret .= $this->m_Matrix[$b][$a] ;

                if($b+1 != $this->m_DimensionY){
                    $ret .= " ";
                }
            }
            $ret .= "|\n<br/>";
        }
        return $ret;

    }

    /**
     * @param Matrix $otherMatrix
     * @return Matrix
     * @throws Exception
     */
    public function Multiplication(Matrix &$otherMatrix){
        if(count($this->m_Columns) != count($otherMatrix->m_Rows)){
            throw new Exception("Multiplication of two matrices is defined if and only
            if the number of columns of the left matrix is the same as the number
            of rows of the right matrix.
            [Left = " . count($this->m_Columns) . "] != [Right = ". count($otherMatrix->m_Rows) . "]",1 );
        }

        $newMatrix = new Matrix(count($this->m_Rows),count($otherMatrix->m_Columns));
        for($a=0;$a<$this->m_DimensionX;$a++){
            for($b=0;$b<$otherMatrix->m_DimensionY;$b++){
                //echo "Calling vector<br/>";
                //print_r($this->m_Rows[$a]);
                //print_r($otherMatrix->m_Columns[$b]);

                $r = new Vector($this->m_Rows[$a]);
                $c = new Vector($otherMatrix->m_Columns[$b]);
                //echo " $r    $c  <br/>";
                $newMatrix->m_Matrix[$a][$b] = $r->DotProduction($c);
            }
        }
        return $newMatrix;
    }


    /**
     * @param $rowX
     * @param $rowY
     */
    public function RowSwitch($rowX,$rowY){
        //$tmp                    = $this->m_Rows[$rowX];
        //$this->m_Rows[$rowX]    = $this->m_Rows[$rowY];
        //$this->m_Rows[$rowY]    = $tmp;
    }


    /**
     * @param $value
     * @param $rowX
     * @return Vector
     * @throws Exception
     */
    public function RowMultiplication($multiplier,$rowX){

        if($multiplier == 0 ){
            throw new Exception("[Row multiplication] Each element in a row can be multiplied by a non-zero constant.",3);
        }
        $vector = new Vector($this->m_Rows[$rowX-1]);
        $vector = $vector->ScalarMultiplication($multiplier);
        print_r($vector);
        $this->m_Rows[$rowX-1] = $vector->toArray();
        //return $vector;
//        $size   = count($this->m_Rows[$rowX]);
//        for($i=0;$i<$size;$i++){
//            $this->m_Rows[$rowX]=$this->m_Rows[$rowX]*$value;
//        }
    }

    public function RowAddition($rowDestination,$rowSource,$multiplier){
        if($multiplier == 0 ){
            throw new Exception("[Row multiplication] Each element in a row can be multiplied by a non-zero constant.",3);
        }
        $rD = new Vector($this->m_Rows[$rowDestination-1]);
        $rS = new Vector($this->m_Rows[$rowSource-1]);
        $rS = $rS->ScalarMultiplication($multiplier);
        print_r($this->m_Rows[$rowSource-1]);
        $rD = $rD->Add($rS);

        $this->m_Rows[$rowDestination-1] = $rD;
        return $this;
    }


    public function Add(Matrix &$otherMatrix){
        if($otherMatrix->SizeString() != $this->SizeString()){
            throw new Exception("Matrix dimensions are different " . $otherMatrix->SizeString() . "!=". $this->SizeString(),1 );
        }

        $newMatrix = new Matrix($this->m_DimensionY,$this->m_DimensionX);
        for($a=0;$a<$this->m_DimensionX;$a++){
            for($b=0;$b<$this->m_DimensionY;$b++){
                $newMatrix->m_Matrix[$b][$a] = $this->m_Matrix[$b][$a]+$otherMatrix->m_Matrix[$b][$a];
            }
        }
        return $newMatrix;
    }
} 