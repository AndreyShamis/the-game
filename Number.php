<?php
/**
 * User: Andrey Shamis
 * Date: 12/20/14
 * Time: 2:27 PM
 */

class Number {

    protected $m_Number = 0;
    public function __construct($newNumber){
        $this->m_Number = $newNumber;
    }

    public function Add(Number &$otherNumber){
        return $this->m_Number + $otherNumber->m_Number;
    }

    public function Mult(Number &$otherNumber){
        return $this->m_Number * $otherNumber->m_Number;
    }

    public function Minus(Number &$otherNumber){
        return $this->m_Number - $otherNumber->m_Number;
    }

    public function Dev(Number &$otherNumber){
        return $this->m_Number / $otherNumber->m_Number;
    }

    public function Value(){
        return $this->m_Number;
    }
} 