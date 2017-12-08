<?php session_start(); ?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sprint Notes</title>

    <!-- Bootstrap Core CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.css">
    
    <!-- Theme CSS -->
    <link href="public/css/clean-blog.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
</head>

<body>

    <?php include("includes/navigation.php"); ?>

    <!-- Page Header -->
    <!-- Set your background image for this header on the line below. -->
    <header class="intro-header" style="background-image: url('public/resources/home-bg.jpg')">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                    <div class="site-heading">
                        <h1>Sprint Notes</h1>
                        <hr class="small">
                        <span class="subheading">A Personal Activity Manager</span>
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- Main Content -->
    <div class="container-fluid text-center ">   
	  <div class="row content">
    	<h2>Activities</h2>
	    <div class=" vertical-center col-sm-11 text-center"> 
	    	<div class="container">
	            <p></p>
	            <div class="row">
	                <div class="col-md-4">
	                    <table id="productBacklogTable"
	                    	   data-toggle="table"
	                           data-url="/backlog/productBacklog.php"
	                           data-unique-id="id"
	                           data-pagination="true"
	                           >
	                        <thead>
	                        <tr>
	                            <th 
	                            	data-field="title"
	                                data-formatter="operateFormatterProductBacklog"
	                                data-events="operateEvents">	                                    
	                                <a href="" class="addToProduct"  style="float:right" data-toggle="modal" data-target="#addUserStoryModal" title="Add User Story">
	                                    	<i class="glyphicon glyphicon-plus"></i>
	                                </a>
	                                <big>Product Backlog </big>
	            				</th>
	                               						
	                        </tr>
	                        </thead>
	                    </table>
	                </div>
	                <div class="col-md-4">
	                    <table id="sprintBacklogTable"
							   data-toggle="table"
	                           data-url="/backlog/sprintBacklog.php"
	                           data-unique-id="id">
	                        <thead>
	                        <tr>
	                            <th data-field="title"
	                                data-formatter="operateFormatterSprintBacklog"
	                                data-events="operateEvents"><big>Sprint Backlog</big></th>
	                        </tr>
	                        </thead>
	                    </table>
	                </div>
	                 <div class="col-md-4">
	                    <table id="incrementBacklogTable"
							   data-toggle="table"
	                           data-url="/backlog/incrementBacklog.php"
	                           data-unique-id="id"
	                           data-pagination="true"
	                           >
	                        <thead>
	                        <tr>
	                            <th data-field="title"
	                                data-formatter="operateFormatterIncrementBacklog"
	                                data-events="operateEvents"><big>Increments</big></th>
	                        </tr>
	                        </thead>
	                    </table>
	                </div>
	            </div>
	        </div>
		</div> 
	  </div>
	</div>
	
	
	
	<!-- Modal -->
	  <div class="modal fade" id="addUserStoryModal" role="dialog">
	    <div class="modal-dialog">
	      <!-- Modal content-->
	       <div class="col-sm-10"> 
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Enter task</h4>
	        </div>
	        <div class="modal-body">
	          <form class="form-horizontal"  action="/backlog/productBacklog.php/addUserStory" role="form" method="post">
	              <div class="form-group">
	             	 <div class="col-sm-12"> 
	                      	<input type="text"  class="form-control" id="userStory" placeholder="Enter task" name="title">
	                  </div>
	              </div>
	                <!--  
	                <div class="form-group">
	                 <div class="col-sm-10"> 
	                                        <div class='input-group date' id='datetimepicker1'>
	                                            <input type='text'  class="form-control" placeholder="Deadline" name="deadlineTimestamp"/>
	                                            <span class="input-group-addon">
	                                                <span class="glyphicon glyphicon-calendar"></span>
	                                            </span>
	                                        </div>
	                       </div>
	              </div>
	              -->
	                  <div class="form-group">
	                  <div class="col-sm-12"> 
	                    <div class="modal-footer">
	                       <button type="submit" class="btn btn-default">Add Story</button>
	                    </div></div>
	                  </div>
	          </form>
	      </div>
	      </div>
	    </div>
	  </div>
	</div>

    <hr>

    <?php include("includes/footer.php"); ?>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.3/moment.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.11.1/bootstrap-table.min.js"></script>
              
    <!-- Theme JavaScript -->
    <script src="public/js/clean-blog.min.js"></script>
    <script src="public/js/home.js"></script>
	
</body>

</html>
