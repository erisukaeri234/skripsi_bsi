<?php  // Start the session

cek_status_login($_SESSION['idpelanggan']);
include ('chart.inc.php');
// Process actions
$chart = $_SESSION['chart'];
$action = $_GET['action'];
switch ($action) {
	case 'add' :
		if ($chart) {
			$chart .= ',' . $_GET['id'];
		} else {
			$chart = $_GET['id'];
		}
		break;
	//
	//B002,5,S,B003,10,M
	case 'delete' :
		if ($chart) {
			$items = explode(',', $chart);
			$newchart = '';
			foreach ($items as $item) {
				if ($_GET['id'] != $item) {
					if ($newchart != '') {
						$newchart .= ',' . $item;
					} else {
						$newchart = $item;
					}
				}
			}
			$chart = $newchart;
		}
		break;
	case 'update' :
		if ($chart) {
			$newchart = '';
			foreach ($_POST as $key => $value) {
				if (stristr($key, 'qty')) {
					$id = str_replace('qty', '', $key);
					$items = ($newchart != '') ? explode(',', $newchart) : explode(',', $chart);
					$newchart = '';
					foreach ($items as $item) {
						if ($id != $item) {
							if ($newchart != '') {
								$newchart .= ',' . $item;
							} else {
								$newchart = $item;
							}
						}
					}
					for ($i = 1; $i <= $value; $i++) {
						if ($newchart != '') {
							$newchart .= ',' . $id;
						} else {
							$newchart = $id;
						}
					}
				}
			}
		}

		$chart = $newchart;
		break;
}
$_SESSION['chart'] = $chart;
?>

<section id="contactRow" class="row contentRowPad">
 	 <div class="container">
            <div class="row">

			<?php echo writeShoppingchart();

	echo showchart();

	if (isset($_GET['s'])) {
		if ($_GET['status'] == OK) {
			echo " proses pembelian berhasil dilakukan sudah selesai";
		} else {
			echo "operasi gagal";
		}
	}
			?>
			
		</div>
	</div>
</section>

