<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
</style>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		
	</style>
</head>
<body>
	<table>
		<th>
			Title
		</th>
		<th>
			Description
		</th>
		<th>
			Image
		</th>
		<div class="container">
		<?php 
			$getdata = $this->db->get('product');
			foreach ($getdata->result() as $row)
			{ ?>
				<tr>
					<td><?php echo $row->title ?></td>
					<td><?php echo $row->description ?></td>
					<td><img src="<?= 'http://localhost/ci/assets/10/'.$row->image;?>" height="50px" width="50px"data-toggle="modal" data-target="#myModal"></td>
				</tr>
				<div class="modal fade" id="myModal" role="dialog">
				    <div class="modal-dialog">
				    
					      	<div class="modal-content">
						        <div class="modal-header">
						          <button type="button" class="close" data-dismiss="modal">&times;</button>
						          <h4 class="modal-title">Modal Header</h4>
						        </div>
						        <div class="modal-body">
						         	<form action="<?php echo base_url().'dashboard/list' ?>" method="post">
						         		<input type="hidden" name="id" value=<?php echo $row->id ?>>
										<input type="text" name="product_qty" placeholder="product quantity">
										<input type="text" name="price" placeholder="Price">
										<input type="submit" name="submit">
									</form>
						        </div>
						        <div class="modal-footer">
						          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						        </div>
					      	</div>
				      
				    </div>
				</div>
		<?php	}
		 ?>
		</div>
		
	</table>
</body>
</html>