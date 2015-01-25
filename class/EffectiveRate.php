<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EffectiveRate
 *
 * @author Hack_Jo
 */
class EffectiveRate extends Loan {

    private $due;
    private $day;
    //put your code here
   
    function getDue() {
        return $this->due;
    }

    function getDay() {
        return $this->day;
    }

    function setDue($due) {
        $this->due = $due;
    }

    function setDay($day) {
        $this->day = $day;
    }
    
    public function getAmount() {
        return parent::getAmount();
    }

    public function getBalance() {
        return parent::getBalance();
    }

    public function getInterest() {
        return parent::getInterest();
    }

    public function getMonthlyInterest() {
        return (parent::getAmount()*(parent::getInterest()/100)*$this->getDay())/365;
    }

    public function getMonthlyPayback() {
        return parent::getMonthlyPayback();
    }

    public function getPaybackTime() {
        return parent::getPaybackTime();
    }

    public function getPrincipal() {
        return parent::getPrincipal();
    }

    public function getTotalInterest() {
        return parent::getTotalInterest();
    }

    public function setAmount($amount) {
        parent::setAmount($amount);
    }

    public function setMonthlyInterest($monthlyInterest) {
        parent::setMonthlyInterest($monthlyInterest);
    }

    public function setMonthlyPayback($monthlyPayback) {
        parent::setMonthlyPayback($monthlyPayback);
    }

    public function setPaybackTime($paybackTime) {
        parent::setPaybackTime($paybackTime);
    }







}
