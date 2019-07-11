<?php
include('../login/session.php');

$counsellor = $_SESSION['login_user'];

$sql = "SELECT SD.usn, SD.first_name, SD.last_name, SD.sem, MA.subject, MA.quiz1, MA.test1 , MA.quiz2 , MA.test2, MA.quiz3, MA.test3    
    FROM  student_details AS SD INNER JOIN marks_attendance AS MA ON SD.usn=MA.usn 
    WHERE SD.counsellor = '$counsellor' and SD.sem=MA.sem 
    ORDER BY subject"; //SD.sem has the current enrolled sem

$result = mysqli_query($conn,$sql)  or die( mysqli_error($conn));

$i=0;
$entry = array();
while ($row = mysqli_fetch_array($result))
{
    $entry[$i][0]=$row['usn'];
    $entry[$i][1]=$row['first_name']." ".$row['last_name'];
    $entry[$i][2]=$row['subject'];
    $entry[$i][3]=$row['quiz1'];
    $entry[$i][4]=$row['test1'];
    $entry[$i][5]=$row['quiz2'];
    $entry[$i][6]=$row['test2'];
    $entry[$i][7]=$row['quiz3'];
    $entry[$i][8]=$row['test3'];
    $i++;
}

echo json_encode($entry);

?>