<?php

/**
 * Description of FlatRateController
 *
 * @author Hack_Jo
 */
class FlatRateController {

    //put your code here
    private $loan;

    function __construct() {
        $loan = new FlatRate();
        echo $loan->getInterest();
    }

    public function showInterest() {
        
    }

}

include '../class/configs.php';
include '../class/Loan.php';
include '../class/FlatRate.php';
$amount = $_POST['amount'];
$paybackTime = $_POST['paybackTime'];

if ($paybackTime > 0) {
    $loan = new FlatRate();
    $loan->setAmount($amount);
    $loan->setPaybackTime($paybackTime);
    for ($i = 0; $i < $paybackTime; ++$i) {
        if ($i == 0) {
            $vFixedInterest = number_format($loan->getInterest(), 2);
            $vTotalInterest = number_format($loan->getTotalInterest(), 2);
            $vMonthlyInterest = number_format($loan->getMonthlyInterest(), 2);
            $vMonthlyPayback = number_format($loan->getMonthlyPayback(), 2);
            $table[$i] = array(
                'period' => ($i + 1),
                'principalQuoted' => number_format($loan->getAmount(), 2),
                'sumInterest' => number_format($loan->getMonthlyInterest(), 2),
                'monthlyPayback' => number_format($loan->getMonthlyPayback(), 2),
                'monthlyInterest' => number_format($loan->getMonthlyInterest(), 2),
                'principal' => number_format($loan->getPrincipal(), 2),
                'balance' => number_format($loan->getBalance(), 2)
            );
            $amount = $loan->getBalance();
            $sumInterest = number_format($loan->getMonthlyInterest(), 2);
        } else {

            $loan->setPaybackTime($paybackTime);
            $sumInterest+= number_format($loan->getMonthlyInterest(), 2);
            $table[$i] = array(
                'period' => ($i + 1),
                'principalQuoted' => number_format($amount, 2),
                'sumInterest' => number_format($sumInterest, 2),
                'monthlyPayback' => number_format($loan->getMonthlyPayback(), 2),
                'monthlyInterest' => number_format($loan->getMonthlyInterest(), 2),
                'principal' => number_format($loan->getPrincipal(), 2),
                'balance' => number_format($amount - $loan->getPrincipal(), 2)
            );

            $amount = $amount - $loan->getPrincipal();
        }
    }

    echo '<table border="1" cellpadding="1" cellspacing="0">
            <tr>
                <td style="background-color:#ccc">Interest Fixed:</td>
                <td>' . $vFixedInterest . '%</td>
            </tr>
            <tr>
                <td style="background-color:#ccc">Total Interest:</td>
                <td>' . $vTotalInterest . '</td>
            </tr>
            <tr>
                <td style="background-color:#ccc">Monthly Interest:</td>
                <td>' . $vMonthlyInterest . '</td>
            </tr>
            <tr>
                <td style="background-color:#ccc">Monthly Payback:</td>
                <td>' . $vMonthlyPayback . '</td>
            </tr>
        </table>';
    echo ' <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td colspan="7" align="center" style="background-color:#efefef">Effective Rate</td>
        </tr>
            <tr>
                <td style="background-color:#ccc">Period</td>
                <td style="background-color:#ccc">Principal quoted</td>
                <td style="background-color:#ccc">Sum Interest</td>
                <td style="background-color:#ccc">Monthly payback</td>
                <td style="background-color:#ccc">Interest</td>
                <td style="background-color:#ccc">Principal</td>
                <td style="background-color:#ccc">Balance</td>
            </tr>';

    for ($i = 0; $i < count($table); ++$i) {
        echo '<tr>';
        echo '<td>' . ($i + 1) . '</td>';
        echo '<td>' . $table[$i]['principalQuoted'] . '</td>';
        echo '<td>' . $table[$i]['sumInterest'] . '</td>';
        echo '<td>' . $table[$i]['monthlyPayback'] . '</td>';
        echo '<td>' . $table[$i]['monthlyInterest'] . '</td>';
        echo '<td>' . $table[$i]['principal'] . '</td>';
        echo '<td>' . $table[$i]['balance'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
}



