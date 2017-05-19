<?php
echo 'The config setup is for Kitsune AS2 only!';
 
//config starts.

$answers = array('yes', 'y', 'yeah', 'sure', 'ya', 'YES', 'Yes', 'Yeah', 'Sure', 'Ya', 'YEAH', 'SURE', 'ok', 'okay', 'Ok', 'Okay', 'OK', 'OKAY', '1', 'Y', 'yes!', 'k', 'kk', 'K', 'KK');
$no = array('no','nah','nope','No','NO','0','n','noo','Nope','no u', 'NO!');


echo "Enter Database Host: ";
$dbhost = trim(fgets(STDIN));
echo "Enter Database Username: ";
$dbUser = trim(fgets(STDIN));
echo "Enter Database Password: ";
$dbPass = trim(fgets(STDIN));
 
if ($dbPass == "") {
    echo "Without db pass? Omg, please setup a password for your db.";
}

 
if (strlen($dbPass) < 5) {
    echo "Um, please use a strong password.";
}
echo "Enter Database Name: ";
$dbName = trim(fgets(STDIN));
$con   = mysqli_connect($dbhost, $dbUser, $dbPass);

if (!$con) {
echo "Oops! We couldn't connect to the database..\n";
echo "Continue anyway? ";
$conan = trim(fgets(STDIN));
} else {
    $xml = new DOMDocument('1.0', 'utf-8');
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->load('Database.xml');

    $xml->getElementsByTagName('name')->item(0)->nodeValue = $dbName;
    $xml->getElementsByTagName('address')->item(0)->nodeValue = $dbhost;
    $xml->getElementsByTagName('username')->item(0)->nodeValue = $dbUser;
    $xml->getElementsByTagName('password')->item(0)->nodeValue = $dbPass;

    $xml->save("Database.xml");
    echo 'Successfully updated your Database.xml file!';
}    

if (in_array($conan, $answers)) {
    $conan = trim(fgets(STDIN));
    $xml = new DOMDocument('1.0', 'utf-8');
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace = false;
    $xml->load('Database.xml');

    $xml->getElementsByTagName('name')->item(0)->nodeValue = $dbName;
    $xml->getElementsByTagName('address')->item(0)->nodeValue = $dbhost;
    $xml->getElementsByTagName('username')->item(0)->nodeValue = $dbUser;
    $xml->getElementsByTagName('password')->item(0)->nodeValue = $dbPass;

    $xml->save("Database.xml");
    echo 'Successfully updated your Database.xml file!';
}
 
if (in_array($conan, $no)) {
    $conan = trim(fgets(STDIN));
    die("Shutting down configuration...");
}
 
echo "Almost done!\n";
echo "Would you like us to setup the database?";
$answer = trim(fgets(STDIN));
if (in_array($answer, $no)) {
    $conan = trim(fgets(STDIN));
    die("Shutting down configuration...");
}
mysqli_query($con, 'CREATE DATABASE IF NOT EXISTS ' . $dbName . '');
mysqli_query($con, 'USE ' . $dbName . '');
mysqli_query($con, "CREATE TABLE IF NOT EXISTS `bans` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Moderator` char(12) NOT NULL,
  `Player` int(11) unsigned NOT NULL,
  `Comment` text NOT NULL,
  `Expiration` int(8) NOT NULL,
  `Time` int(8) NOT NULL,
  `Type` smallint(3) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
   
mysqli_query($con, "CREATE TABLE IF NOT EXISTS `igloos` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Owner` int(10) unsigned NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `Floor` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `Music` smallint(6) NOT NULL DEFAULT '0',
  `Furniture` text NOT NULL,
  `Locked` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
   
mysqli_query($con, "CREATE TABLE IF NOT EXISTS `penguins` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` char(12) NOT NULL,
  `Nickname` char(16) NOT NULL,
  `Password` char(32) NOT NULL,
  `LoginKey` char(32) NOT NULL,
  `Email` char(254) NOT NULL,
  `RegistrationDate` int(8) NOT NULL,
  `Moderator` tinyint(1) NOT NULL DEFAULT '0',
  `Inventory` text NOT NULL,
  `Coins` mediumint(7) unsigned NOT NULL DEFAULT '500',
  `Igloo` int(10) unsigned NOT NULL COMMENT 'Current active igloo',
  `Igloos` text NOT NULL COMMENT 'Owned igloo types',
  `Furniture` text NOT NULL COMMENT 'Furniture inventory',
  `Color` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `Head` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Face` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Neck` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Body` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Hand` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Feet` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Photo` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Flag` smallint(5) unsigned NOT NULL DEFAULT '0',
  `Walking` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Puffle ID',
  `Banned` varchar(20) NOT NULL DEFAULT '0' COMMENT 'Timestamp of ban',
  `Stamps` text NOT NULL,
  `StampBook` varchar(150) NOT NULL DEFAULT '1%1%-1%1',
  `EPF` varchar(9) NOT NULL DEFAULT '0,0,0',
  `Buddies` text NOT NULL,
  `Ignores` text NOT NULL,
  `MinutesPlayed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;");
   
mysqli_query($con, "CREATE TABLE IF NOT EXISTS `postcards` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Recipient` int(10) unsigned NOT NULL,
  `SenderName` char(12) NOT NULL,
  `SenderID` int(10) unsigned NOT NULL,
  `Details` varchar(12) NOT NULL,
  `Date` int(8) NOT NULL,
  `Type` smallint(5) unsigned NOT NULL,
  `HasRead` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;");
   
mysqli_query($con, "CREATE TABLE IF NOT EXISTS `puffles` (
`ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Owner` int(10) unsigned NOT NULL,
  `Name` char(12) NOT NULL,
  `AdoptionDate` int(8) NOT NULL,
  `Type` tinyint(3) unsigned NOT NULL,
  `Food` tinyint(3) unsigned NOT NULL DEFAULT '100',
  `Play` tinyint(3) unsigned NOT NULL DEFAULT '100',
  `Rest` tinyint(3) unsigned NOT NULL DEFAULT '100',
  `Walking` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;");
   
mysqli_query($con, "INSERT INTO `puffles` (`ID`, `Owner`, `Name`, `AdoptionDate`, `Type`, `Food`, `Play`, `Rest`, `Walking`) VALUES
(3, 101, 'Blue', 1453750614, 0, 100, 100, 100, 0),
(4, 101, 'Blue', 1453752421, 0, 100, 100, 100, 0),
(5, 101, 'Red', 1453753127, 5, 100, 100, 100, 1),
(6, 101, 'Yellow', 1453753887, 6, 100, 100, 100, 0),
(7, 101, 'Pink', 1453829330, 1, 100, 100, 100, 0),
(8, 101, 'Purple', 1454159945, 4, 100, 100, 100, 0);");
 
mysqli_close($con);
 
echo "The database is now setup!";

?>