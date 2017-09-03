<?php
include($_SERVER["DOCUMENT_ROOT"] . '/_site/AdminPage.php');

final class IpBans extends AdminPage {
	private $ip_bans = array();
	
	private function handleReq(): void {
		if(isset($_POST['action'], $_POST['identifier'])){
			switch($_POST['action']){
				case 'ban': if(isset($_POST['reason'])){ $this->banIP($_POST['identifier'], $_POST['reason']); } break;
				case 'unban': $this->unbanIP($_POST['identifier']);break;
			}
		}
		$this->ip_bans = $this->getIPBans();
	}
	
	private function banIP(string $ip, string $reason='none'): void {
		$sql = "INSERT INTO ip_banned (ipaddr, timestamp, reason, ubtime) VALUES (:ipaddr, :timestamp, :reason, 99999999999)";
		$stmt = $this->site->database->prepare($sql);
		$stmt->bindParam(':ipaddr', $ip);
		$stmt->bindParam(':timestamp', time());
		$stmt->bindParam(':reason', $reason);
		$stmt->execute();
	}
	
	private function unbanIP(string $ip): void {
		$sql = "DELETE FROM ip_banned WHERE ipaddr = :ipaddr";
		$stmt = $this->site->database->prepare($sql);
		$stmt->bindParam(':ipaddr', $ip);
		$stmt->execute();
	}
	
	private function getIPBans(): array {
		$sql = "SELECT * FROM IP_BANNED WHERE ubtime > ".time();
		$stmt = $this->site->database->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
	}
	
	private function buildIPTable(): void {
		echo '<table class="table table-striped table-bordered table-hover dataTable no-footer dtr-inline" style="width: 100%;">';
		echo '<thead><tr>';
		echo "<th class='sorting-asc'>IP Address</th><th>Unban IP</th><th>Timestamp</th><th>Until</th><th>Reason</th>";
		echo '</tr></thead>';
		foreach($this->ip_bans as $row){
			echo "<tr>";
			echo "<td>";
			echo $row[0];
			echo "</td>";
			echo "<td>";
			echo "<form action='' method='post'><input type='hidden' name='action' id='action' value='unban'><input type='hidden' name='identifier' id='identifier' value='{$row[0]}'><input type='submit' class='btn btn-primary' value='Unban'></form>";
			echo "</td>";
			echo "<td>";
			echo date('m/d/Y H:i:s', $row[1]);
			echo "</td>";
			echo "<td>";
			if ($row[3] == 99999999999)
				echo 'Forever';
			else
				echo date('m/d/Y H:i:s', $row[3]);
			echo "</td>";
			echo "<td>";
			echo htmlentities($row[2]);
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}
	
	protected function buildAdminPage(): void {
		$this->handleReq();
?>
<div class="content-wrapper py-3">

      <div class="container-fluid">

        <!-- Breadcrumbs -->
        <ol class="breadcrumb">
          <li class="breadcrumb-item active"><?php echo $this->meta_title; ?></li>
        </ol>
		<form action='' method='post'>Ban IP address: <input type='hidden' name='action' id='action' value='ban'><input class='form-control' style='width:175px;' type='text' name='identifier' id='identifier' maxlength='15'><input class='form-control' style='width:225px;' type='text' name='reason' id='reason' placeholder='Reason'><input type='submit' class='btn btn-primary' value='Ban'></form>

        <?php $this->buildIPTable(); ?>

      </div>
      <!-- /.container-fluid -->

    </div>
    <!-- /.content-wrapper -->
<?php
	}
}
?>
