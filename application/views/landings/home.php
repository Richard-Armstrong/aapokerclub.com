<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>All American Poker Club</title>
        <link rel="icon" type="image/x-icon" href="<?php echo base_url("assets/favicon.ico") ?>" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?php echo base_url("css/styles.css") ?>" rel="stylesheet" />

		<script>
		  var last_element;
		  function show(id) {
			 if (last_element != null) {
				 hide(last_element);
				 document.getElementById('td_'+last_element).style.backgroundColor= "transparent";

			 }
			 player_td = 'td_' + id;
			 document.getElementById('td_'+id).style.backgroundColor= "DarkTurquoise";
		    document.getElementById(id).style.display = "block";
			last_element = id;
		  }
		  function hide(id) {
		    document.getElementById(id).style.display = "none";
		  }
	    </script>

    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="#page-top">AA Poker Club</a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
						<li class="nav-item"><a class="nav-link" href="#standings">Standings</a></li>
                        <li class="nav-item"><a class="nav-link" href="#rules">Rules</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?php echo base_url("index.php/management/tourneys");?>">Admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="text-center">
                        <h1 class="mx-auto my-0 text-uppercase">Welcome! </h1>
                        <h2 class="text-white-50 mx-auto mt-2 mb-5">
							Current Prize Pool: $<?php echo number_format($prize_pool,2) ?>
						</h2>
                    </div>
                </div>
            </div>
        </header>

		<!-- Standings-->
        <section class="projects-section bg-light" id="standings">
            <div class="container px-4 px-lg-5">
				<h1>Standings</h1>
                <!-- Featured Project Row-->
                <div class="row gx-0 mb-4 mb-lg-5 ">
                    <div class="col-xl-4 col-lg-5">
                        <div class="featured-text text-center text-lg-left">
                            <p class="text-black-50 mb-0">
								<table class="table table-striped">
									<tr>
										<th>Player</th>
										<th>Total Points</th>
									</tr>
									<?php foreach ($leaderboard_records as $record) { ?>
										<tr onClick="show('Player_<?php echo $record['player_id'];?>')" >
											<td id="td_Player_<?php echo $record['player_id'];?>"><?php echo $record['player_name']; ?></td>
											<td><?php echo $record['total_points']; ?></td>
										</tr>
									<?php } ?>
								</table>
							</p>
                        </div>
                    </div>

					<div class="col-xl-8 col-lg-7" style="padding-left:50px;margin-top: 10;vertical-align:top" >
						<?php
						// Loop across all results to create the divs for display.
						foreach($all_results as $key=>$player_records) {
						?>
						<div class="hide" id="<?php echo 'Player_' . $key; ?>" style="display:none">
							<h2>Results</h2>

							<table class="table table-striped" onClick="hide('Player_<?php echo $key;?>')">
								<tr>
									<th>Date</th>
									<th>Position</th>
									<th>Points</th>
								</tr>
								<?php
								$position_total = 0;
								$record_count = 0;
								$point_total = 0;
								foreach ($player_records as $record) {
									?>
									<tr>
										<td><?php echo date('m/d/Y',strtotime($record['tourney_date'])); ?></td>
										<td><?php echo $record['position']; ?></td>
										<td><?php echo $record['points']; ?></td>
									</tr>
									<?php
								 	$position_total += $record['position'];;
									$record_count +=1;
									$point_total += $record['points'];
								}
								$average_points = $point_total/($record_count);
								$average_position = $position_total/($record_count);
								?>
									<tr>
										<td>Averages:</td>
										<td><?php echo number_format($average_position,2); ?></td>
										<td><?php echo number_format($average_points, 2); ?></td>
									</tr>
							</table>
						</div>
					<?php }  // end foreach all_results ?>

					</div>

                </div>

            </div>
        </section>
        <!-- Rules-->
        <section class="about-section text-center" id="rules">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8">
                        <h2 class="text-white mb-4">Series Rules</h2>
                        <p class="text-white-50">
                            Tournaments are played throughout the remainder of the year. Points are awarded
							as follows: Last place receives 1 point. Each finisher above last place gets
							one more point than the last. If there are 10 players in the tournament, then
							first place receives 10 points, second receives 9 and so on.
                        </p>
						<p class="text-white-50">
							At the end of the year, we will take the top 10 finishes of each player and
							add them up. The top 5 of these will be the winners of the series and will decide
							what to do with the prize pool as a group. First place gets 10% of the pot and the
							remainder will be divided among the top 5 finishers either through a tourney or some
							other agreement among the players.
						</p>
						<p class="text-white-50">
							Entry into the tournament will be allowed through level 3. At the end of level 3 there
							will be an opportunity to add-on to your stack so long as you've entered the tournament
							in the first two levels. Once level 3 has begun, entry into the tournament will be allowed
							but no add-on will be.
						</p>
                    </div>
                </div>
            </div>
        </section>


        <!-- Contact-->
        <section class="contact-section bg-black">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Address</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">Parts Unknown</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-envelope text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Email</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50"><a href="#!">richard.armstrong@gmail.com</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <div class="card py-4 h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-mobile-alt text-primary mb-2"></i>
                                <h4 class="text-uppercase m-0">Phone</h4>
                                <hr class="my-4 mx-auto" />
                                <div class="small text-black-50">770-289-8526</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="social d-flex justify-content-center">
                    <a class="mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                    <a class="mx-2" href="#!"><i class="fab fa-github"></i></a>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer class="footer bg-black small text-center text-white-50"><div class="container px-4 px-lg-5">Copyright &copy; AA Poker Club 2021</div></footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="<?php echo base_url("js/scripts.js") ?>"> </script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
