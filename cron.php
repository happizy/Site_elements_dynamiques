<?php

    $link = mysqli_connect('localhost', 'root', 'lannion') or die ('Error connecting to mysql: ' . mysqli_error($link).'\r\n');
    $use="use site";
    if (mysqli_query($link,$use)) {
        printf(mysqli_error($link));
    }
    $command="DELETE FROM usertemp";
    if (!($command=mysqli_query($link,$command))){
         printf("Error: %s\n",mysqli_error($link));
    }

?>