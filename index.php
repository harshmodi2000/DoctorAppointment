<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php include 'includes/bootstrap.php'; ?>

  <title>Doc App</title>
  <link rel="stylesheet" href="style/style.css">
</head>

<body>
  <!--	BOOKING MODAL-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modtal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Urgent Care</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <!--
		  <select name="" id="" class="form-control">
			  <?php
        //			  $a=array("Cardiologist","Orthodpedic","General Physician");
        //			  foreach($a as $type){
        //				  
        //		  	echo "<option value='".$type."'>".$type."</option>";
        //
        //			  }
        ?>
		  </select>
-->
          <!--		  Urgent Care Modal-->
          <input type="text" placeholder="Name" class="form-control mb-2">
          <input type="text" placeholder="Mobile No" class="form-control mb-2">
          <button class="btn-success btn">9:00-10:00AM</button>
          <button class="btn btn-danger" disabled>10:00-11:00AM</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Book</button>

        </div>
      </div>
    </div>
  </div>
  <!--	MAIN BODY -->
  <div class="container">
    <!-- <h1 class="display-4 text-white ">Doctor Appointment</h1> -->
    <!--<button class="btn btn-primary btn-lg">Book a Appointment Now</button>-->
  </div>
  <!--bg hero area-->
  <div class="bg-hero">
    <nav class="navbar navbar-expand-lg navbar-dark ">
      <a class="navbar-brand bg-white" href="#"><img src="img/logo.png" width="120px" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#facilities">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Gallery</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#doctors">Doctors</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contact">Contact Us</a>
          </li>
          <!--
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
-->
        </ul>
        <!--    <form class="form-inline my-2 my-lg-0">-->
        <!-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> -->

        <!--    </form>-->
      </div>
      <a href="login/patientLogin.html" class="doc-btn-primary">Login</a>
      <!--	      <button class="btn btn-outline-success my-2 my-sm-0" data-toggle="modal" data-target="#exampleModal">Urgent Care Appointment</button>-->
      <a href="login/patientRegistration.php" class="doc-btn-secondary">Register</a>

    </nav>
    <div class="bg-hero--btn-group">

    </div>
    <!--
	<div class="bg-hero--btn-group">
					<a href="" class="doc-btn-primary">Sign Up</a>
					</div>
-->
    <div class="bg-video" id="home">
      <video class="bg-video__content" autoplay muted loop>
        <source src="videos/video.mp4" type="video/mp4">

        Your browser is not supported!
      </video>

    </div>


  </div>
  <!--	Hospital card section-->
  <div class="doc-intro" id="facilities">

    <div class="heading--primary">Our Expert Facilities!</div>
    <div class="container mt-5">
      <div class="row">
        <div class="doc-card col m-2 text-center">
          <img src="icon/icon1.svg" class="doc-card--icon mt-5" alt="med" />
          <div class="heading--secondary">Best Prescribed Medicines</div>
          <div class="card-txt">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
          </div>
        </div>
        <div class="doc-card col m-2 text-center">
          <img src="icon/icon2.svg" class="doc-card--icon mt-5" alt="+" />
          <div class="heading--secondary">Urgent Care Facility</div>
          <div class="card-txt">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
          </div>
        </div>
        <div class="doc-card col m-2 text-center">
          <img src="icon/icon3.svg" class="doc-card--icon mt-5" alt="doc" />
          <div class="heading--secondary">Experienced Doctors</div>
          <div class="card-txt">
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
            <div>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere eaque deserunt harum veniam distinctio qui omnis provident illum quasi obcaecati voluptatibus alias ipsum, ducimus quod sequi quam fugiat neque. Consectetur.</div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="doc-gallery" id="gallery">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">

          <img src="img/img1.jpg" class="d-block w-100" alt="...">

          <div class="carousel-caption d-none d-md-block">
            <h5>Waiting Room</h5>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/img2.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>Hospital Beds</h5>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
          </div>
        </div>
        <div class="carousel-item">

          <img src="img/img3.jpg" class="d-block w-100" alt="...">
          <div class="carousel-caption d-none d-md-block">
            <h5>New Technology</h5>
            <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
  <div class="doc-team" id="doctors">

    <h1 class="text-center heading--primary">Our Doctors Team</h1>
    <div class="our_team">
      <div class="team_member">
        <div class="member_img">
          <img src="img/member_1.png" alt="our_team">
          <div class="social_media">
            <div class="facebook item"><i class="fab fa-facebook-f"></i></div>
            <div class="twitter item"><i class="fab fa-twitter"></i></div>
            <div class="instagram item"><i class="fab fa-instagram"></i></div>
          </div>
        </div>
        <h3>john wright</h3>
        <span>Head Doctor</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione perspiciatis, error deleniti quaerat beatae doloribus incidunt excepturi. Fugit deleniti accusantium neque hic quidem voluptatibus cumque.</p>
      </div>
      <div class="team_member">
        <div class="member_img">
          <img src="img/member_2.png" alt="our_team">
          <div class="social_media">
            <div class="facebook item"><i class="fab fa-facebook-f"></i></div>
            <div class="twitter item"><i class="fab fa-twitter"></i></div>
            <div class="instagram item"><i class="fab fa-instagram"></i></div>
          </div>
        </div>
        <h3>barbara mori</h3>
        <span>Cardiologist</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores maiores temporibus, architecto optio asperiores mollitia pariatur error, quaerat voluptatibus minima eos quo nostrum, maxime necessitatibus.</p>
      </div>
      <div class="team_member">
        <div class="member_img">
          <img src="img/member_3.png" alt="our_team">
          <div class="social_media">
            <div class="facebook item"><i class="fab fa-facebook-f"></i></div>
            <div class="twitter item"><i class="fab fa-twitter"></i></div>
            <div class="instagram item"><i class="fab fa-instagram"></i></div>
          </div>
        </div>
        <h3>harry dickens</h3>
        <span>Emergency Specialist</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione perspiciatis, error deleniti quaerat beatae doloribus incidunt excepturi. Fugit deleniti accusantium neque hic quidem voluptatibus cumque.</p>
      </div>
      <div class="team_member">
        <div class="member_img">
          <img src="img/member_4.png" alt="our_team">
          <div class="social_media">
            <div class="facebook item"><i class="fab fa-facebook-f"></i></div>
            <div class="twitter item"><i class="fab fa-twitter"></i></div>
            <div class="instagram item"><i class="fab fa-instagram"></i></div>
          </div>
        </div>
        <h3>sammy louise</h3>
        <span>Nuerologist</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione perspiciatis, error deleniti quaerat beatae doloribus incidunt excepturi. Fugit deleniti accusantium neque hic quidem voluptatibus cumque.</p>
      </div>
    </div>
  </div>

  <div class="doc-footer" id="contact">
    <div class="overl">
      <div class="footer-section">
        <div class="container">
          <div class="footer-cta pt-4 pb-2">
            <div class="row">
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="fas fa-map-marker-alt"></i>
                  <div class="cta-text">
                    <h4>Find us</h4>
                    <span>Ahmedabad</span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="fas fa-phone"></i>
                  <div class="cta-text">
                    <h4>Call us</h4>
                    <span>9026076769</span>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-md-4 mb-30">
                <div class="single-cta">
                  <i class="far fa-envelope-open"></i>
                  <div class="cta-text">
                    <h4>Mail us</h4>
                    <span>docaremail@info.com</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="footer-content pt-4 pb-2">
            <div class="row">
              <div class="col-xl-4 col-lg-4 mb-50">
                <div class="footer-widget">
                  <div class="footer-logo">
                    <a href="index.html"><img src="img/logo.png" class="img-fluid" alt="logo"></a>
                  </div>
                  <div class="footer-text">
                    <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, </p>
                  </div>
                  <div class="footer-social-icon">
                    <span>Follow us</span>
                    <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                    <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 mb-1">
                <div class="footer-widget">
                  <div class="footer-widget-heading">
                    <h3>Useful Links</h3>
                  </div>
                  <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Gallery</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Expert Team</a></li>
                    <li><a href="#">Contact us</a></li>
                    <li><a href="#">Latest News</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-6 mb-30">
                <div class="footer-widget">
                  <div class="footer-widget-heading">
                    <h3>Contact Us</h3>
                  </div>
                  <!-- <div class="footer-text mb-25">
                    <p>Don’t miss to subscribe to our new feeds, kindly fill the form below.</p>
                  </div> -->
                  <div class="subscribe-form">
                    <form action="#">
                      <input type="text" placeholder="Your Name">
                      <input type="text" placeholder="Email Address">
                      <input type="textarea" placeholder="Massage Type here">
                      <button><i class="fab fa-telegram-plane"></i></button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <img src="img/imgFooter.jpg" class="img-footer" alt="">
  </div>
  <div class="copyright-area">
    <div class="container ">
      <div class="row ">
        <div class="col-xl-6 col-lg-6 ">
          <div class="copyright-text text-lg-center">
            <p>Copyright &copy; 2021, All Right Reserved <a href="#">DoCare</a></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>