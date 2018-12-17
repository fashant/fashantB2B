<!DOCTYPE html><html lang="en"><head>    <meta charset="utf-8">    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    <meta name="description" content="">    <meta name="author" content="">    <title>Fashant | Review</title>    <!-- Bootstrap core CSS -->    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">    <!-- Custom styles for this template -->    <link href="css/responsive.css" rel="stylesheet">	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	<link href="css/style.css" rel="stylesheet"></head><body><!-- Navigation --><?php //include_once "partials/navigation.php"; ?> <div class="dir-pop-com" id="signin" role="dialog">        <div class="modal-dialog">            <div class="modal-content">                <div class="">                    <section class="tz-register">                        <div class="log-in-pop">                            <div class="log-in-pop-right">								<div class="contentbg">									<h4>Write Your Reviews</h4>									<p>Help the Fashion Community by droppng you review below. Your review might help someone find their new favorite fashion brand, or help people avoid a bad experience.</p>									<div id="error_container"></div>								</div>								<div class="customform">									<form class="s12" id="login-form" action="" method="post" role="form">										<div>											<div class="input-field s12">												<b>Enter Rating:</b>												<div class="clearfix"></div>												<fieldset class="rating">													<input type="radio" id="star5" name="rating" value="5" />													<label class="full" for="star5" title="Awesome - 5 stars"></label>													<input type="radio" id="star4half" name="rating" value="4.5" />													<label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>													<input type="radio" id="star4" name="rating" value="4" />													<label class="full" for="star4" title="Pretty good - 4 stars"></label>													<input type="radio" id="star3half" name="rating" value="3.5" />													<label class="half" for="star3half" title="Meh - 3.5 stars"></label>													<input type="radio" id="star3" name="rating" value="3" />													<label class="full" for="star3" title="Meh - 3 stars"></label>													<input type="radio" id="star2half" name="rating" value="2.5" />													<label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>													<input type="radio" id="star2" name="rating" value="2" />													<label class="full" for="star2" title="Kinda bad - 2 stars"></label>													<input type="radio" id="star1half" name="rating" value="1.5" />													<label class="half" for="star1half" title="Meh - 1.5 stars"></label>													<input type="radio" id="star1" name="rating" value="1" />													<label class="full" for="star1" title="Sucks big time - 1 star"></label>													<input type="radio" id="starhalf" name="rating" value="0.5" />													<label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>												</fieldset>											   <div class="clearfix"></div>											</div>										</div>										<div>											<div class="input-field s12">												<textarea id="username" name="username" data-ng-model="name1" class="validate" tabindex="1" placeholder="Write review"></textarea>											</div>										</div>										<div>											<div class="input-field s4">												<input type="submit" id="reviewbtn" name="reviewbtn" value="Submit Review" class="waves-effect waves-light log-in-btn" tabindex="3"> </div>										</div>									</form>								</div>                            </div>                            <div class="clearfix"></div>                        </div>                    </section>                </div>            </div>        </div>    </div><?php //include_once "partials/footer.php"; ?><!-- Bootstrap core JavaScript --><script src="vendor/jquery/jquery.min.js"></script><script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script><script src="http://demofashant.com/js/formSubmit.js?2400"></script><script src="js/formSubmit.js"></script></body></html>