<?php

/**
 * Description of FlatRateController
 *
 * @author Hack_Jo
 */
include '../class/configs.php';
include '../class/Loan.php';
include '../class/FlatRate.php';
include '../class/EffectiveRate.php';
$amount = $_POST['amount'];
$paybackTime = $_POST['paybackTime'];

if ($paybackTime > 0) {
    $loan = new EffectiveRate();
    $monthlyPayback = new FlatRate();
    $monthlyPayback->setAmount($amount);
    $monthlyPayback->setPaybackTime($paybackTime);
    $vMonthlyPayback = number_format($monthlyPayback->getMonthlyPayback(), 2);
    $vFixedInterest = number_format($loan->getInterest(), 2);


    for ($i = 0; $i < $paybackTime; ++$i) {

        $loan->setAmount($amount);
        $loan->setPaybackTime($paybackTime);


        if ($i == 0) {
            $nextMonth = date('d-M-Y', strtotime('+' . ($i + 1) . ' month'));
            $prevMonth = date('d-M-Y');
            $diff = abs(strtotime($nextMonth) - strtotime($prevMonth));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 ) / (60 * 60 * 24));
            $loan->setDay($days);

            $principle = ($monthlyPayback->getMonthlyPayback() - $loan->getMonthlyInterest());
            $principalQuoted = $loan->getAmount() - $principle;
            $table[$i] = array(
                'period' => ($i + 1),
                'due' => $nextMonth,
                'day' => $days,
                'principalQuoted' => number_format($loan->getAmount(), 2),
                'sumInterest' => number_format($loan->getMonthlyInterest(), 2),
                'monthlyPayback' => number_format($monthlyPayback->getMonthlyPayback(), 2),
                'monthlyInterest' => number_format($loan->getMonthlyInterest(), 2),
                'principal' => number_format($principle, 2),
                'balance' => number_format($principalQuoted, 2)
            );
            $prevMonth = $nextMonth;
            $sumInterest = $loan->getMonthlyInterest();
        } else {
            //echo $sumInterest;
            $nextMonth = date('d-M-Y', strtotime('+' . ($i + 1) . ' month'));
            $diff = abs(strtotime($nextMonth) - strtotime($prevMonth));
            $years = floor($diff / (365 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 ) / (60 * 60 * 24));
            $loan->setDay($days);
            $loan->setAmount($principalQuoted);
            $sumInterest+=$loan->getMonthlyInterest();
            $principle = ($monthlyPayback->getMonthlyPayback() - $loan->getMonthlyInterest());
            $principalQuoted = $loan->getAmount() - $principle;
            $table[$i] = array(
                'period' => ($i + 1),
                'due' => $nextMonth,
                'day' => $days,
                'principalQuoted' => number_format($loan->getAmount(), 2),
                'sumInterest' => number_format($sumInterest, 2),
                'monthlyPayback' => number_format($monthlyPayback->getMonthlyPayback(), 2),
                'monthlyInterest' => number_format($loan->getMonthlyInterest(), 2),
                'principal' => number_format($principle, 2),
                'balance' => number_format($principalQuoted, 2)
            );
            $prevMonth = $nextMonth;
        }
    }

    echo '<table border="1" cellpadding="1" cellspacing="0">
            <tr>
                <td style="background-color:#ccc">Interest Fixed:</td>
                <td>' . $vFixedInterest . '%</td>
            </tr>
             <tr>
                <td style="background-color:#ccc">Total Interest:</td>
                <td>' . number_format($sumInterest,2) . '</td>
            </tr>
           
            <tr>
                <td style="background-color:#ccc">Monthly Payback:</td>
                <td>' . $vMonthlyPayback . '</td>
            </tr>
        </table>';
    echo '<br/> <table border="1" cellpadding="2" cellspacing="0">
        <tr>
            <td colspan="9" align="center" style="background-color:#efefef">Effective Rate</td>
        </tr>
            <tr>
                <td style="background-color:#ccc">Period</td>
                <td style="background-color:#ccc">Due</td>
                <td style="background-color:#ccc">Day</td>
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
        echo '<td>' . $table[$i]['due'] . '</td>';
        echo '<td>' . $table[$i]['day'] . '</td>';
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



