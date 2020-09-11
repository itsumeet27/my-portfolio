<?php 
    include('includes/header.php');
    include('includes/init.php');
?>
    <div class="container-fluid">
        <div class="page-title p-4">
            <h1 class="p-2">CONTACT <hr></h1>        
        </div>
        <div class="contact px-4">
            <div class="row">
                <div class="contact-form col-md-6 px-4">
                    <h4 class="pb-3">SEND ME YOUR QUERY</h4>
                    <form name="contact-form" method="post" enctype="multipart/form-data" id="contact-form">
                        <!-- Name input -->
                        <div class="form-outline mb-4">
                            <input type="text" id="name" class="form-control" />
                            <label class="form-label" for="name">Name</label>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <input type="email" id="email" class="form-control" />
                            <label class="form-label" for="email">Email address</label>
                        </div>

                        <!-- Message input -->
                        <div class="form-outline mb-4">
                            <textarea class="form-control" id="message" rows="4"></textarea>
                            <label class="form-label" for="message">Message</label>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-portfolio mb-4">Send &nbsp;<i class="fas fa-paper-plane"></i></button>
                    </form>
                </div>
                <div class="contact-details col-md-6 px-4">
                    <h4 class="pb-3">REACH OUT TODAY</h4>
                    <p class="py-2">&nbsp;<i class="fas fa-map-marker-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;302, B-7, Sector-9, Shanti Nagar, Mira Road (E), Thane-401107</p>
                    <p class="py-2">&nbsp;<i class="fas fa-mobile-alt fa-2x"></i>&nbsp;&nbsp;&nbsp;<a href="tel:+918286864601">+91 82868 64601</a></p>
                    <p class="py-2"><i class="fas fa-envelope fa-2x"></i>&nbsp;&nbsp;&nbsp;<a href="mailto:sksksharma0@gmail.com">sksksharma0@gmail.com</a></p>
                </div>
            </div>
            <div class="location px-2 mb-4">
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1883.0897740917924!2d72.86277540807464!3d19.274556646743605!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7b05a0dd5123b%3A0xf9e5543510f58f4f!2sSector%209%2C%20Shanti%20Nagar%2C%20Mira%20Road%2C%20Mira%20Bhayandar%2C%20Maharashtra%20401107!5e0!3m2!1sen!2sin!4v1574403408310!5m2!1sen!2sin" height="300" frameborder="0" style="border:0;width: 100%" allowfullscreen=""></iframe>
			</div>
        </div>
    </div>
<?php include('includes/footer.php'); ?>