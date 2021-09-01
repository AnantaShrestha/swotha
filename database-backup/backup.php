<?
// Inspired by tutorials: http://www.phpfreaks.com/tutorials/130/6.php
// http://www.vbulletin.com/forum/archive/index.php/t-113143.html
// http://hudzilla.org


// Create the mysql backup file
// edit this section
$dbhost = "localhost"; // usually localhost
$dbuser = "swotahtr_swotah";
$dbpass = "UfnzqphLgv5R";
$dbname = "swotahtr_swotahtravel";
$sendto = "Swotah <mohan.bomrel@deerwalk.edu.np>";
$sendfrom = "Automated Backup <info@swotahtravel.com>";
$sendsubject = "Weekly Mysql Backup";
$bodyofemail = "Here is the daily backup.";
// don't need to edit below this section

$backupfile = '/home/swotahtr/swotahtravel.com/aj/dailybackup/'.$dbname.date("Y-m-d").'.sql';
system("mysqldump -h $dbhost -u $dbuser -p$dbpass $dbname > $backupfile");


// Mail the file


include('Mail.php');
include('Mail/mime.php');


$message = new Mail_mime();
$text = "$bodyofemail";
$message->setTXTBody($text);
$message->AddAttachment($backupfile);
$body = $message->get();
$extraheaders = array("From"=>"$sendfrom", "Subject"=>"$sendsubject");
$headers = $message->headers($extraheaders);
$mail = Mail::factory("mail");
$mail->send("$sendto", $headers, $body);


// Delete the file from your server
unlink($backupfile);
?>
