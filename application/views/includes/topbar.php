
<!-- Topbar -->
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
	<!-- Topbar Navbar -->
	<ul class="navbar-nav ml-auto">
		<?php if ($this->session->userdata('is_logged_in')) : ?>
			<div class="topbar-divider d-none d-sm-block"></div>
			<!-- Nav Item - User Information -->
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="mr-2 d-none d-lg-inline text-gray-600 small">
						<?= $this->session->userdata('user')->name ?>
					</span>
				</a>

				<!-- Dropdown - User Information -->
				<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="<?= base_url("index.php/auth/edit_user") ?>">
						<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
						Profile
					</a>

					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
						<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
						Logout
					</a>
				</div>
			</li>
		<?php else : ?>
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="<?= base_url("index.php/auth/login") ?>">
					Login
				</a>
			</li>
		<?php endif // is_logged_in ?>
	</ul>
</nav>
<!-- End of Topbar -->
