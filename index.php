<?php
require_once 'lib/Repository/CustomerRepository.php';
// Get all customers for listing
$customerRepository = new CustomerRepository();
$customers = $customerRepository->findAll();
?>			
<!DOCTYPE html>
<html>
	
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
		<script type="text/javascript" src="js/js-extends.js"></script>
		<script type="text/javascript" src="js/main.js"></script>
		<script type="text/javascript" src="js/js-test.js"></script>
		
		<link rel="stylesheet" href="css/screen.css" />
        <title>Übersicht</title>
    </head>
    <body>
		<div id="wrapper">
			<div class="outer">
				<div class="inner">				
					<table>
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Adresse</th>
								<th></th>
							</tr>				
						</thead>
						<tbody>					
							<?php foreach ($customers as $customer): ?>
								<tr class="tr-test">
									<td ><?php echo $customer['id']; ?></td>
									<td><?php echo $customer['name']; ?></td>
									<td><?php echo $customer['street'] . "<br>" . $customer['zip'] . " " . $customer['city']; ?></td>
									<td><a href="customer_edit.php?customer=<?php echo $customer['id']; ?>">bearbeiten</a></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
    </body>
</html>
