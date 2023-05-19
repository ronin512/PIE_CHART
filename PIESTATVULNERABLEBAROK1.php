/<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net.com : Pie chart using data from MySQL table</title>
</head>
<body >



<?Php
// SELECT Date_Vulnerable,Single_Parent_Family,Elderly FROM vulnerable;
//SELECT Date_Vulnerable,Single_Parent_Family,Elderly FROM vulnerable
require "connection.php";// Database connection
if($stmt = $link->query("SELECT Date_Vulnerable,Single_Parent_Family,Elderly FROM vulnerable;")){

  echo "No of records : ".$stmt->num_rows."<br>";
$php_data_array = Array(); // create PHP array
  echo "<table>
<tr> <th>Date_Vulnerable</th><th>Single_Parent_Family</th><th>Elderly</th></tr>";
while ($row = $stmt->fetch_row()) {
   echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$row[2]</td></tr>";
   $php_data_array[] = $row; // Adding to array
   }
echo "</table>";
}else{
echo $link->error;
}
//print_r( $php_data_array);
// You can display the json_encode output here. 
echo json_encode($php_data_array); 

// Transfor PHP array to JavaScript two dimensional array 
echo "<script>
        var my_2d = ".json_encode($php_data_array)."
</script>";
?>






<div id="chart_div"></div>
<br><br>
<a href=https://www.plus2net.com/php_tutorial/chart-database.php>BarChart  from MySQL database</a>
</body>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
 google.charts.load('current', {'packages':['corechart']});
     // Draw the pie chart when Charts is loaded.
      google.charts.setOnLoadCallback(draw_my_chart);
      // Callback that draws the pie chart
      function draw_my_chart() {
        // Create the data table .
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Date_Vulnerable','number','Single_Parent_Family','Elderly');
        //data.addColumn('number','Single_Parent_Family','number','Single_Parent_Family');
		//data.addColumn('number','Single_Parent_Family','number','Single_Parent_Family');
		//data.addColumn('number','x1','x2','x2');
		for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1])]);
// above row adds the JavaScript two dimensional array data into required chart format
    var options = {title:'plus2net.com : How the tutorials are distributed',
                       width:600,
                       height:500};

        // Instantiate and draw the chart
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
</script>


 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
var data = new google.visualization.DataTable();
        data.addColumn('string', 'New_Arrivals_Turkey','number','New_Arrivals_Mainland');
        data.addColumn('number','New_Arrivals_Turkey','number','New_Arrivals_Mainland');
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {packages: ['corechart', 'bar']});
      google.charts.setOnLoadCallback(drawChart);
	  
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        data.addColumn('number', 'Tutorials');
		data.addColumn('number', 'hits');
        for(i = 0; i < my_2d.length; i++)
    data.addRow([my_2d[i][0], parseInt(my_2d[i][1]),parseInt(my_2d[i][2])]);
       var options = {
          title: 'plus2net.com tutorial Hits',
          hAxis: {title: 'Month',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));
        chart.draw(data, options);
       }
	///////////////////////////////
function re_draw(nos){
my_2d[3][2]=nos;
	drawChart();
}
</script>
</html>







