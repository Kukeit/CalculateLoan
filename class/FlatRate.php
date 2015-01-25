<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FlatRate
 *
 * @author Hack_Jo
 */
class FlatRate extends Loan {

    //put your code here
    public function getInterest() {
        return parent::getInterest();
    }

    public function getAmount() {
        return parent::getAmount();
    }

    public function setAmount($amount) {
        parent::setAmount($amount);
    }

    public function getPaybackTime() {
        return parent::getPaybackTime();
    }

    public function setPaybackTime($paybackTime) {
        parent::setPaybackTime($paybackTime);
    }

    public function getTotalInterest() {
        return parent::getAmount() * (parent::getInterest() / 100) * (parent::getPaybackTime() / 12);
    }

    public function getMonthlyPayback() {
        return (parent::getAmount() + self::getTotalInterest()) / parent::getPaybackTime();
    }

    public function setMonthlyPayback($monthlyPayback) {
        parent::setMonthlyPayback($monthlyPayback);
    }

    public function getMonthlyInterest() {
        return self::getTotalInterest() / self::getPaybackTime();
    }

    public function setMonthlyInterest($monthlyInterest) {
        parent::setMonthlyInterest($monthlyInterest);
    }
    
    public function getPrincipal() {
        return self::getMonthlyPayback()-self::getMonthlyInterest();
    }
    
    public function getBalance() {
        return parent::getAmount()-self::getPrincipal();
    }


   


}
