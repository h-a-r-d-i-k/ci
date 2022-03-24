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
			verify user
		</th>
		<th>
			user attached active products
		</th>
		<th>
			all active products
		</th>
		<th>
			Count of active products which don't belong to any user.
		</th>
		<th>
			Amount of all active attached products
		</th>
		<th>
			Amount of all active attached products
		</th>
		<th>
			Summarized prices of all active products per user
		</th>
		
		<?php 
			$this->db->where('active', 1);
		    $this->db->where('role', 0);
	    	$getdata = $this->db->get('user');

	    	$this->db->where('status', 1);
	    	$active_products = $this->db->get('product');

	    	$this->db->where('status', 0);
	    	$active_products_do_not_belong_user = $this->db->get('product');

	    	
			
	    	// $query5 = $query5->num_rows();
			$this->session->set_userdata('userlogged_in');
			$id = $_SESSION['login_session'][0]['id'];
			
	    	$demo = $this->db->select('p1.product_qty, p1.user_id')
			    ->from('product as p1')
			    ->join('user as u1', 'p1.user_id = u1.id', 'LEFT')
			    ->where('p1.user_id', $id)
			    ->where('status',1)
			    ->get();
			$demo1 = $demo->result_array();

			// query6
  			$this->db->select_sum('total');
	  		$this->db->where('status', 1);
		    $summary_test = $this->db->get('product');
		    $total = $summary_test->result_array();
		    
		    // query7
		    $summarized_prices = $this->db->select('p1.title, p1.price')
			    ->from('product as p1')
			    ->join('user as u1', 'p1.user_id = u1.id', 'LEFT')
			    ->where('p1.user_id', $id)
			    ->where('status',1)
			    ->get();
			$result = $summarized_prices->result_array();

	    	$query1 = $getdata->num_rows();
	    	$query2 = 0;
	    	$query3 = $active_products->num_rows();
	    	$query4 = $active_products_do_not_belong_user->num_rows();
	    	$query5 = $demo1[0]['product_qty'];
	    	$query6 = $total[0]['total'];
	    	$query7 = $result[0]['title'].' - '.' $ '.$result[0]['price'];
	    ?>
			
				<tr>
					<td><b>ALL Count: <?php echo $query1 ?></b></td>
					<td><b>ALL Count: <?php echo $query2 ?></b></td>
					<td><b>ALL Count: <?php echo $query3 ?></b></td>
					<td><b>ALL Count: <?php echo $query4 ?></b></td>
					<td><b>ALL Count: <?php echo $query5; ?></b></td> 
					<td><b>ALL Count: <?php echo $query6 ?></b></td> 
					<td><b>ALL Count: <?php echo $query7 ?></b></td> 
				</tr>
				
			
		
	</table>
</body>
</html>