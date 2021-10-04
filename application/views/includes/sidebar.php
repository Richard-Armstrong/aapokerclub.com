
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url("index.php/") ?>">
		<div class="sidebar-brand-text mx-3">
			<img src="<?= base_url("img/aapc.gif") ?>"/>
		</div>
	</a>
	<!-- Divider -->
	<hr class="sidebar-divider">
	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
			<i class="fas fa-fw fa-cogs"></i>
			<span>Management</span>
		</a>

		<div id="collapseUtilities" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item" href="<?= base_url("index.php/management/tourneys") ?>">Tourneys</a>
				<a class="collapse-item" href="<?= base_url("index.php/management/players") ?>">Players</a>

				<a class="collapse-item" href="<?= base_url("index.php/management/groups") ?>">Groups</a>
				<a class="collapse-item" href="<?= base_url("index.php/auth") ?>">Users</a>
			</div>
		</div>
	</li>

	<?php if ($this->session->userdata('user')->is_admin) : ?>
		<li class="nav-item">
			<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAdmin" aria-expanded="true" aria-controls="collapseAdmin">
				<i class="fas fa-fw fa-wrench"></i>
				<span>Admin</span>
			</a>

			<div id="collapseAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="<?= base_url("index.php/admin/nvp_codes") ?>">Codes</a>
				</div>
			</div>

			<div id="collapseAdmin" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item" href="<?= base_url("index.php/admin/logout") ?>">Logout</a>
				</div>
			</div>
		</li>
	<?php endif // is_superuser ?>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
