<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        
        <form target="effectiveRateFrame" action="controller/EffectiveController.php" method="post">
            <table border="0" cellpadding="0" cellspacing="1">
                <tr>
                    <td>
                        <label>Amount:</label>
                    </td>
                    <td>
                        <input type="text" name="amount"/>
                    </td>

                </tr>
                <tr>
                    <td>
                        <label>Payback Time(Month):</label>
                    </td>
                    <td>
                        <input type="text" name="paybackTime"/>
                        <label>1 year=12month</label>
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit"/>
        </form>
        <iframe name="effectiveRateFrame" frameborder="0" width="100%" height="500"></iframe>
    </body>
</html>
