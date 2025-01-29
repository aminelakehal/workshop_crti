<!-- =============================   CONTACT US   =================================== -->


<?php
$social_media = get_all_social_media($pdo);
function validateLink($link) {
  return (filter_var($link, FILTER_VALIDATE_URL) !== false) ? $link : '#';
}

$email_crti = isset($social_media[0]['email_crti']) ? $social_media[0]['email_crti'] : '';
$telephone = isset($social_media[0]['telephone']) ? $social_media[0]['telephone'] : '';
$facebook = isset($social_media[0]['facebook']) ? $social_media[0]['facebook'] : '#';
$twitter = isset($social_media[0]['twitter']) ? $social_media[0]['twitter'] : '#';
$youtube = isset($social_media[0]['Youtube']) ? $social_media[0]['Youtube'] : '#';
?>

<section id="contact">
      <div class="container">
        <div class="contact-info">
          <h2>CONTACT US</h2>
          <p>Research Centre in Industrial Technologies (CRTI)</p>
          <p>P.O.Box 64, Cheraga 16014 Algiers, Algeria</p>
          
<?php if (!empty($email_crti)): ?>
    <a href="mailto:<?php echo htmlspecialchars($email_crti); ?>"><?php echo htmlspecialchars($email_crti); ?></a><br>
<?php endif; ?>

<?php if (!empty($telephone)): ?>
    <a href="tel:+<?php echo htmlspecialchars($telephone); ?>"><?php echo htmlspecialchars($telephone); ?></a>
<?php endif; ?>

<div class="social-icons">
  <div class="wrapper">
    <?php if ($facebook !== '#'): ?>
    <div class="button">
      <div class="icon">
        <a href="<?php echo htmlspecialchars($facebook); ?>">
          <img src="images/facebook-svgrepo-com.svg" alt="Facebook"  width="30" height="30"  />
        </a>
      </div>
      <span>Facebook</span>
    </div>
    <?php endif; ?>

    <?php if ($twitter !== '#'): ?>
    <div class="button">
      <div class="icon">
        <a href="<?php echo htmlspecialchars($twitter); ?>">
          <img src="images/twitter-154-svgrepo-com.svg" alt="Twitter"  width="30" height="30" />
        </a>
      </div>
      <span>Twitter</span>
    </div>
    <?php endif; ?>

    <?php if ($youtube !== '#'): ?>
    <div class="button">
      <div class="icon">
        <a href="<?php echo htmlspecialchars($youtube); ?>">
          <img src="images/youtube-168-svgrepo-com.svg" alt="YouTube" width="30" height="30" />
        </a>
      </div>
      <span>YouTube</span>
    </div>
    <?php endif; ?>
  </div>
</div>
        </div>
        <div class="map">
          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d102330.9714997558!2d2.8203405957637653!3d36.726335050305956!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x128fb03b7a933895%3A0xf7092bf615e6e87a!2sCentre%20de%20Recherche%20en%20Technologies%20Industrielles%20CRTI!5e0!3m2!1sfr!2sdz!4v1721180713407!5m2!1sfr!2sdz" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>
   
    </body>


<!-- ======================= footer ====================== -->

<div class="footer">
  <div class="bubbles"></div>
  <div class="content">
    <p style="color: #F5F7F7 !important;">© Copyright CRTI. All Rights Reserved</p>
  </div>
</div>

<svg style="position: fixed; top: 100vh;">
  <defs>
      <filter id="blob">
          <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
          <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="blob" />
      </filter>
  </defs>
</svg>



<script src="layout//css/bootstrap/bootstrap.min.js"></script>
<script src="layout//css/bootstrap/scripte.js"></script>

<script>
// ======================= profile ==========================



$(document).ready(function() {
	$('#profileLink').click(function(e) {
		e.preventDefault();
		$('#profileModal').show();
	});

	$('.close').click(function() {
		$('#profileModal').hide();
	});

	$(window).click(function(e) {
		if (e.target == $('#profileModal')[0]) {
			$('#profileModal').hide();
		}
	});
});
</script>


</body>
</html>