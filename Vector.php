<?php
/**
 * User: Andrey Shamis
 * Date: 12/20/14
 * Time: 1:16 PM
 */

require_once "Number.php";

class Vector {

    protected $m_Vector;// = array();
    protected $m_VectorSize = 0;

    public function getVectorSize(){
        $this->m_VectorSize = count($this->m_Vector);
        return $this->m_VectorSize;
    }

    public function Size(){
        return $this->getVectorSize();
    }

    public function __construct(array $newVector){
//        echo "Here";
        $this->m_Vector = array();
        //$this->m_Vector = $newVector;
        for($i=0;$i<count($newVector);$i++){
            $this->m_Vector[$i] = $newVector[$i];
        }
        $this->getVectorSize();
        //print_r($newVector);
        //echo "<br/>";
        //echo "NewVector size is :" . $this->m_VectorSize , "<br/>";
    }

    public function toArray(){
        return $this->m_Vector;
    }
    /*
     * Return scalar
     */
    public function DotProduction(Vector &$otherVector){
        $ret = 0;
        for($a=0;$a<$this->m_VectorSize;$a++){
            $tmp = $this->Mult($this->m_Vector[$a],$otherVector->m_Vector[$a]);
            $ret = $this->Sum($ret,$tmp);
        }
        return $ret;
    }

    private function Sum(&$x,&$y){
        $xN = new Number($x);
        $yN = new Number($y);
        return $xN->Add($yN);
        //return $x+$y;
    }

    private function Mult(&$x,&$y){
        $xN = new Number($x);
        $yN = new Number($y);
        return $xN->Mult($yN);
        //print_r($x);
        //return $x*$y;
    }

    /**
     * @param $otherVector
     * @return Vector
     */
    public function Add($otherVector){
        $retVector  = new Vector($this->m_Vector);
        for($a=0;$a<$retVector->m_VectorSize;$a++){
            $retVector->m_Vector[$a] = $this->Sum($retVector->m_Vector[$a] ,$otherVector->m_Vector[$a]);
        }
        return $retVector;
    }
    /**
     * @param $scalar
     * @return Vector
     */
    public function ScalarMultiplication($scalar){
        $xN         = new Number($scalar);

        $retVector  = new Vector($this->m_Vector);
        for($a=0;$a<$this->m_VectorSize;$a++){
            $retVector->m_Vector[$a]  =  $this->Mult($retVector->m_Vector[$a],$xN->Value());
        }
        return $retVector;
    }

    /**
     * @return string
     */
    public function __toString(){
        $ret = "";
        $ret .= "|";

        for($a=0;$a<$this->m_VectorSize;$a++){
            $ret .= $this->m_Vector[$a] ;
            if($a+1 != $this->m_VectorSize){
                $ret .= " ";
            }
        }
        $ret .= "|\n";

        return $ret;
    }
} 