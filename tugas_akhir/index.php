<?php
$host = 'localhost';
$dbname = 'semantic_web_engineering';
$username = 'root';
$password = '';

try {
	$pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
	exit;
}

$sql = "SELECT * FROM drawing_engineering";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Semantic Web Data Drawing Engineering</title>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

	<style>
		/* Body Styling */
		body {
			font-family: 'Arial', sans-serif;
			background-color: #f4f7fc;
			margin: 0;
			padding: 0;
		}

		/* Container Styling */
		.container {
			width: 95%;
			max-width: 1200px;
			margin: 30px auto;
			padding: 20px;
			background-color: #ffffff;
			border-radius: 8px;
			box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
		}

		/* Header Styling */
		h1 {
			background-color: #4CAF50;
			color: white;
			padding: 15px;
			text-align: center;
			border-radius: 8px;
			margin-bottom: 30px;
			font-size: 24px;
		}

		/* Table Styling */
		#dataTable {
			width: 100%;
			border-collapse: collapse;
		}

		#dataTable th,
		#dataTable td {
			padding: 12px 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}

		#dataTable th {
			background-color: #00796b;
			color: white;
		}

		/* Table Row Hover Styling */
		#dataTable tr:hover {
			background-color: #f1f1f1;
		}

		/* Table Search Inputs */
		.dataTables_wrapper .dataTables_filter input {
			width: 200px;
			padding: 8px;
			margin-top: 5px;
			border-radius: 5px;
			border: 1px solid #ddd;
		}

		.dataTables_wrapper .dataTables_length select {
			width: 80px;
			padding: 8px;
			margin-top: 5px;
			border-radius: 5px;
			border: 1px solid #ddd;
		}

		/* Filter Row Styling */
		thead input {
			width: 100%;
			padding: 8px;
			margin-top: 5px;
			border-radius: 5px;
			border: 1px solid #ddd;
			box-sizing: border-box;
		}

		/* Footer Styling */
		footer {
			text-align: center;
			margin-top: 30px;
			color: #777;
		}

		/* Responsive Styles */
		@media screen and (max-width: 768px) {
			.container {
				width: 100%;
				padding: 10px;
			}

			h1 {
				font-size: 20px;
			}

			#dataTable th,
			#dataTable td {
				padding: 8px 10px;
				font-size: 14px;
			}

			.dataTables_wrapper .dataTables_filter input {
				width: 100%;
				margin-top: 10px;
			}

			.dataTables_wrapper .dataTables_length select {
				width: 100%;
			}
		}

		@media screen and (max-width: 480px) {

			#dataTable th,
			#dataTable td {
				padding: 5px;
				font-size: 12px;
			}
		}
	</style>
</head>

<body>

	<div class="container">
		<h1>Semantic Web Data Drawing Engineering</h1>
		<table id="dataTable" class="display">
			<thead>
				<tr>
					<th>Document No</th>
					<th>Description</th>
					<th>Revision</th>
					<th>Project</th>
					<th>Category</th>
					<th>Status</th>
				</tr>
				<tr>
					<th><input type="text" placeholder="Filter Document No"></th>
					<th><input type="text" placeholder="Filter Description"></th>
					<th><input type="text" placeholder="Filter Revision"></th>
					<th><input type="text" placeholder="Filter Project"></th>
					<th><input type="text" placeholder="Filter Category"></th>
					<th><input type="text" placeholder="Filter Status"></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($data as $row) : ?>
					<tr>
						<td><?php echo htmlspecialchars($row['document_no']); ?></td>
						<td><?php echo htmlspecialchars($row['description']); ?></td>
						<td><?php echo htmlspecialchars($row['revision']); ?></td>
						<td><?php echo htmlspecialchars($row['project']); ?></td>
						<td><?php echo htmlspecialchars($row['category']); ?></td>
						<td><?php echo htmlspecialchars($row['status']); ?></td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>

	<script>
		$(document).ready(function() {
			// Inisialisasi DataTable terlebih dahulu
			var table = $('#dataTable').DataTable({
				orderCellsTop: true,
				fixedHeader: true
			});

			// Menerapkan pencarian untuk setiap kolom
			$('#dataTable thead tr:eq(1) th').each(function(i) {
				$('input', this).on('keyup change', function() {
					if (table.column(i).search() !== this.value) {
						table
							.column(i)
							.search(this.value)
							.draw();
					}
				});
			});
		});
	</script>

</body>

</html>