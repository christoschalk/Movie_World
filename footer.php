	<!--(SWEET ALERT)-->
		
<script src="js/sweetalert.min.js"></script>

<?php if (isset($_SESSION['status']) && $_SESSION['status'] !='')
	{ ?>
		<script>
		swal({
		position: 'top',
		icon: "<?php echo $_SESSION['status_code']; ?>",
		title: "<?php echo $_SESSION['status']; ?>",
		showConfirmButton: true,
		timer: 3500
		})
		</script>
	<?php
	  unset($_SESSION['status']);
	} ?>
