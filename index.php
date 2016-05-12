<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--Youth Connect index.php Originally Created by members of Roscommon comhairle na nóg-->
<style type = "text/css" media = "screen">
ul li {
	list-style-type:none;
}
</style>
<head>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Untitled Document</title>
</head>

<body> 
    <div id="head">
      <h1>Youth connect</h1>
</div>
<!--This Was the initial directory layout but due to layout errors it has been abandoned until further notice-->
    <!--<div id="directory">
        <ul class="directory">
            <li><a href="#"><p>Home</p></a></li>
            <li><a href="#"><p>Events</p></a></li>
            <li><a href="#"><p>A-Z</p></a></li>
            <li><a href="#"><p>FAQ</p></a></li>
        </ul>
    </div>-->
<div id="directorytest">
    <table style="align:center;" class="index-style" width="709" border="1">
      <tr>
        <th height="23" scope="col"><a href="#"><p>Home</p></a></th>
        <th scope="col"><a href="#"><p>Events</p></a></th>
        <th scope="col"><a href="#"><p>A-Z</p></a></th>
        <th scope="col"><a href="faq.html"><p>FAQ</p></a></th>
      </tr>
    </table>
</div>
<div id="left"></div>
    <div id="right"></div>
    <div id="content">
    	<p>Welcome to Youth Connect! Our aim is to provide a list of all facilities around County Roscommon</p>
        <form method="post" action="search.php?go" id="searchform">
        	<input type="text" name="name" class="searchbar"/>
            <input type="button" name="submit" value="search" class="searchbutton"/>
        </form>
        <p><a href="?by=A">A</a> | <a href="?by=B">B</a> | <a href="?by=C">C</a> | <a href="?by=D">D</a> | <a href="?by=E">E</a> | <a href="?by=F">F</a> | <a href="?by=G">G</a> | <a href="?by=H">H</a> | <a href="?by=I">I</a> | <a href="?by=J">J</a> |<a href="?by=K">K</a> | <a href="?by=L">L</a> | <a href="?by=M">M</a> | <a href="?by=N">N</a> | <a href="?by=O">O</a> | <a href="?by=P">P</a> | <a href="?by=Q">Q</a> | <a href="?by=R">R</a> | <a href="?by=S">S</a> | <a href="?by=T">T</a> | <a href="?by=U">U</a> | <a href="?by=V">V</a> | <a href="?by=W">W</a> | <a href="?by=X">X</a> | <a href="?by=Y">Y</a> | <a href="?by=Z">Z</a></p>
        <?php 
		//search by name script
			if(isset($_POST['submit'])){
			if(isset($_GET['go'])){	
			if(preg_match("^/[A-Za-z]+/", $_POST['name'])){
				$name = $_POST['name'];
				$db = mysql_connect ("servername", "username", "password") or die ('I cannot connect to the server because: ' . mysql_error());
				$mydb = mysql_select_db("yourDatabase");
				$sql="SELECT ID, FirstName, LastName FROM Contacts WHERE FirstName LIKE '%" . $name . "%' OR LastName LIKE '%" . $name . "%'";
				$result = mysql_query($sql);
				while($row = mysql_fetch_array($result)){
					$FirstName = $row['FirstName'];
					$LastName = $row['LastName'];
					$ID = $row['ID'];
					echo "<ul> \n";
					echo "<li>" . "<a href=\"search.php?id=$ID\">" . $FirstName. " ". $LastName . "</a></li>\n";
					echo "</ul>";
				}
				}
			else {
				echo "<p>Please Enter a Search Query</p>";
			}
			}
			}
			//search by letter script
			if(isset($_GET['by'])){
				$letter=$_GET['by'];
				$db = mysql_connect ("servername", "username", "password") or die ('I cannot connect to the database because: ' . mysql_error());
				$mydb=mysql_select_db("yourDatabase");
				$sql="SELECT ID, FirstName, LastName FROM Contacts WHERE FirstName LIKE '%" . $letter . "%' OR LastName LIKE '%". $letter . "%'";
				$result = mysql_query($sql);
				$numrows = mysql_num_rows($result);
				echo "<p>" . $numrows . " results found for " . $letter . "</p>";
				while($row=my_sql_fetch_array($result)){
					$FirstName = $row['FirstName'];
					$LastName = $row['LastName'];
		        	$ID=$row['ID'];
					echo "<ul> \n"
					echo "<li>" . "<a href=\"search.php?id=$ID\">" . $FirstName . " " . $LastName . "</a></li>\n";
					echo "</ul>";
				}
			}
			if(isset($_GET['id'])){ 
				$contactid=$_GET['id']; 
				$db=mysql_connect  ("servername", "username",  "password") or die ('I cannot connect to the database  because: ' . mysql_error()); 
				$mydb=mysql_select_db("yourDatabase"); 
				$sql="SELECT  * FROM Contacts WHERE ID=" . $contactid; 
				$result=mysql_query($sql); 
				while($row=mysql_fetch_array($result)){ 
					$FirstName =$row['FirstName']; 
					$LastName=$row['LastName']; 
					$PhoneNumber=$row['PhoneNumber']; 
					$Email=$row['Email']; 
					echo  "<ul>\n"; 
					echo  "<li>" . $FirstName . " " . $LastName .  "</li>\n"; 
					echo  "<li>" . $PhoneNumber . "</li>\n"; 
					echo  "<li>" . "<a href=mailto:" . $Email .  ">" . $Email . "</a></li>\n"; 
					echo  "</ul>"; 
				} 
			} 
		?>
    </div>
</body>
</html>
