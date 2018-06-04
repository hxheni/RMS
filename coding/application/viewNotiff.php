<?php
require_once 'session.php';
require_once 'crudAccountant.php';

$acc = new \core\people\crudAccountant();
$result = $acc->checkNotification($login_session['id']);

        if(count($result) == 0) echo "<br><br><a>There are no notifications at the moment.</a>";
        else {
            echo "<br><br><table id='notif' style=\"margin-left: 8%;\" class=\"w3-table-all\"><form action='checkRead.php' method='post'>";
            echo "<tr style='background-color: lightgoldenrodyellow'><td>Sender</td><td>Message</td><td>Read</td>";
            foreach ($result as $value) {
                $result1 = $acc->retrieveMember($value['senderId']);
                if ($value['status'] == "0") echo "<tr style='background-color: aquamarine'><td>" . $result1[0]['name'] . " " . $result1[0]['surname'] . " (" . $result1[0]['task'] . ")</td><td>" . $value['text'] . "</td><td><input type='hidden' name='id' value='" . $value['id'] . "'><input type='submit' value='Check'></td>";
                else echo "<tr><td>" . $result1[0]['name'] . " " . $result1[0]['surname'] . " (" . $result1[0]['task'] . ")</td><td>" . $value['text'] . "</td><td>✓</td>";

                echo "</tr>";
            }

            echo "</table>";
        }
        ?>