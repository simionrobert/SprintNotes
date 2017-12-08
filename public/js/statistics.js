/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Load the Visualization API and the piechart package.
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var stringData = $.ajax({
          url: "activities/test.php",
          dataType: "json",
          async: false
          }).responseText;
      var jsonData = JSON.parse(stringData);
      
      var listUsers = jsonData.listUsers;
      var listRows = jsonData.listRows;
      
      var data = new google.visualization.DataTable();
      
      data.addColumn('number', 'Day');
      for (var i = 0; i < listUsers.length; i++) {
        var user = listUsers[i];
        data.addColumn('number', user);
      }
      
      data.addRows(listRows);
      
      var options = {
        chart: {
          title: 'Current Week Users Activity',
          subtitle: 'in number of days'
        },
        width: 800,
        height: 400
      };

      var chart = new google.charts.Line(document.getElementById('currentWeekChart_div'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
