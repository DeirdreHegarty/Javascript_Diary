<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<title>Diary Entry</title>
<script>
function validateForm(){//check the form to see if null inputs. Allow whiespace and letters only
var one =document.myform.when.value;
var two =document.myform.event.value;
var three =document.myform.emotion.value;
var four =document.myform.thoughts.value;
var five =document.myform.response.value;
var RegExpression = /^[a-zA-Z\s]*$/; 

    if(one == "" || one == null || two == "" || two == null || three == "" || three == null || four == "" || four == null || five == "" || five == null){ //if empty print message
         document.getElementById("user_output").innerHTML="Please complete the form";
         return false;  
         }else if(RegExpression.test(one)!=true || RegExpression.test(two)!=true || RegExpression.test(three)!=true || RegExpression.test(four)!=true || RegExpression.test(five)!=true){
 document.getElementById("user_output").innerHTML="Invalid input";
	return false;
}
else{
	return true;
	}
}
</script>
</head>
<body>
<style>
html{
  background-color:#C912C9;
}
h1{
  text-align: center;
  color: #595757;
  text-shadow: 5px 2px 5px white;
}
#container{

    width: 700px;
    margin: 20px auto;
}
#center-elements {
  margin: 50px auto;
  width: 320px;
}
table,th, td{
  margin-top: 20px auto;
  border: 1px solid #E385ED;
}
#table1{
margin:auto;
}
#table2{
margin:auto;
}
#head{
  font-family: Verdana;
  background-color: #A3DDF0;
}
#contents{
   background-color: #CCDFE6;
   height: 20px;
   text-align: center;
 
}
#user_output{
text-align: center;
}

input.rounded {
	border: 1px solid #ccc;
	-moz-border-radius: 10px;
	-webkit-border-radius: 10px;
	border-radius: 10px;
	-moz-box-shadow: 2px 2px 3px #666;
	-webkit-box-shadow: 2px 2px 3px #666;
	box-shadow: 2px 2px 3px #666;
	font-size: 20px;
	padding: 4px 7px;
	outline: 0;
	-webkit-appearance: none;
}
input.rounded:focus {
	border-color: #339933;
}
.btns{
  border-radius: 5px;
  padding: 2px 5px;
}
#btnalign{
margin:auto;
}




</style>
<div id="container"><h1>Emotion Diary</h1>
<div id="center-elements">
    <form id="myform" name="myform" action="emotionDiary2.php" method="post" onsubmit= "return validateForm()">
      When/where:
      <input type="text" class="rounded" name="when" />
      <br/>
      <br/> Event:
      <br/><input type="text" class="rounded" name="event" />
      <br/>
      <br/> Emotion:
      <select  name="emotion">
          <option value="Fear">Fear</option>
          <option value="Anger">Anger</option>
          <option value="Sadness">Sadness</option>
          <option value="Joy">Joy</option>
          <option value="Disgust">Disgust</option>
          <option value="Trust">Trust</option>
          <option value="Anticipation">Anticipation</option>
          <option value="Surprise">Surprise</option>
      </select>
      <br/>
      <br/> Automatic Thoughts:
      <input type="text" class="rounded" name="thoughts" />
      <br/>
      <br/> Rational Response:
      <input type="text" class="rounded" name="response" />
      <br/>
      <br/>
<div id="btnalign">
      <input type="submit" class="btns" value="Save Entry"/>
    </form>
    	<button type="button" class="btns" id="showTable">Show Diary</button></div>
        </div>
<p id="user_output"></p>
<?php 

$servername = "localhost";
$username = "Freddy";
$password = "freddy";
$dbname = "EmotionDiary";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
		$when = $_POST["when"];
		$event= $_POST["event"];
		$emot= $_POST["emotion"];
		$automatThought= $_POST["thoughts"];
		$ratioNalResponse= $_POST["response"];
$sql = "INSERT INTO DiaryEntry2 (whenWhere, event, emotion, autoThought, ratResponse) VALUES ('$when', '$event', '$emot', '$automatThought', '$ratioNalResponse')";

if (!$conn->query($sql) === TRUE) {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

//Retrieve data
$sql = "SELECT whenWhere, event, emotion, autoThought, ratResponse FROM DiaryEntry2";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
     echo "<table id ='table1'><tr id = 'head'><th>Where</th><th>Event</th><th>Emotion</th><th>Thoughts</th><th>Response</th></tr>";
     // output data of each row
     while($row = $result->fetch_assoc()) {
         echo "<tr id = 'contents'><td id = 'td1'>" . $row["whenWhere"]. "</td><td id = 'td2'>" . $row["event"]."</td><td id = 'td3'>"  . $row["emotion"]. "</td><td id = 'td4'>". $row["autoThought"]."</td><td id = 'td5'>". $row["ratResponse"]. "</td></tr>";
     }
     echo "</table>";
} else {
     echo "0 results";
}

$conn->close();
?> 

<script>  
	$(document).ready(function(){
		$('#table1').hide(); //hide the table with retrieved data
	    
		$("#showTable").click(function(){
			$("#table1").show();
			$("#table2").hide();
		    });
	});
</script>
   
    <div id="phpRetrieved">
    <table width="100" id="table2">
      <tr id="head">
        <td>where</td>
        <td>event</td>
        <td>emotion</td>
        <td>thoughts</td>
        <td>response</td>
      </tr>
      <tr id="contents"> 
        <td id ="td1" height="200"></td>
        <td id ="td2" height="200"></td>
        <td id ="td3" height="200"></td>
        <td id ="td4" height="200"></td>
        <td id ="td5" height="200"></td>
      </tr>
    </table><br/>
      
  </div>
  </div>

</body>
</html>


