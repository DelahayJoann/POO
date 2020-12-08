<?php
    include 'database.php';

    User::addUser('Joann','jetest@skynet.be','abcdefgh');

    $user = new User('Joann','abcdefgh');

    echo "<br>Update username: ".$user->updateUsername('Joann'.time());
    echo "<br>Update email: ".$user->updateEmail(time().'@skynet.be');

    $user->connect();
    echo "<br>Connected 1/0: ".$user->status();
    $user->disconnect();
    echo "<br>Connected 1/0: ".$user->status();
    echo "<br>Removed from DB: ".$user->removeMe();
?>