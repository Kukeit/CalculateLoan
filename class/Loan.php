<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loan
 *
 * @author Hack_Jo
 */

class Loan {
    //put your code here
    private $interest=INTEREST;
    private $amount;
    private $paybackTime;
    private $totalInterest;
    private $monthlyPayback;
    private $monthlyInterest;
    private $principal;
    private $Balance;
    
    function getInterest() {
        return $this->interest;
    }
    
    function getAmount() {
        return $this->amount;
    }

    function setAmount($amount) {
        $this->amount = $amount;
    }
    
    function getPaybackTime() {
        return $this->paybackTime;
    }

    function setPaybackTime($paybackTime) {
        $this->paybackTime = $paybackTime;
    }
    
    function getTotalInterest() {
        return $this->totalInterest;
    }
    
    function getMonthlyPayback() {
        return $this->monthlyPayback;
    }

    function setMonthlyPayback($monthlyPayback) {
        $this->monthlyPayback = $monthlyPayback;
    }
    
    function getMonthlyInterest() {
        return $this->monthlyInterest;
    }

    function setMonthlyInterest($monthlyInterest) {
        $this->monthlyInterest = $monthlyInterest;
    }
    
    function getPrincipal() {
        return $this->principal;
    }
    
    function getBalance() {
        return $this->Balance;
    }
    
    



   















}
