
<?php  require_once __DIR__. '/layout/sidbar.php';?>
<?php require_once __DIR__ . '/controllers/controllers_theme.php';?>
<?php require_once __DIR__ . '/controllers/controllers_topics.php';?>
<?php require_once __DIR__ . '/controllers/sponsore_controller.php';?>
<?php require_once __DIR__ . '/controllers/social_media_controller.php';?>
<?php require_once __DIR__ . '/controllers/controller_contenu.php';?>
<?php require_once __DIR__ . '/controllers/controllers_organisationnelle.php';?>
<?php require_once __DIR__ . '/controllers/controllers_Scientific.php';?>




<?php



$settings = get_all_contenu($pdo);


if (!$settings || empty($settings)) {
    $settings = [];
}

if (isset($settings[0]) && is_array($settings[0])) {
    $settings = $settings[0];
}

function getSettingValue($key, $default = '') {
    global $settings;
    return isset($settings[$key]) ? htmlspecialchars($settings[$key]) : $default;
}

function getVideoSrc() {
    $src = getSettingValue('video_src', 'path/to/default/video.mp4');
    return $src;
}

function getDownloadLink() {
    $link = getSettingValue('download_link',);
    return $link;
}

function getAboutImage() {
    $img = getSettingValue('about_image', 'path/to/default/image.jpg');
    return $img;
}
?>


<?php
$logo1 = get_all_logo($pdo); 
$logo2 = get_all_logo($pdo); 
$theme = get_theme($pdo); 
?>


  <!-- =============================  intro    =================================== -->
    
    <section id="intro" class="clearfix pt-md-4">
        <div class="container-fluid d-flex h-100">
          <div class="row justify-content-center align-items-center">
    <div class="header">
        
    <?php foreach ($logo1 as $logo1): ?>
        <div class="header">
                    <img src="<?php echo htmlspecialchars($logo1['logo1']); ?>" class="logo" alt="">
                </div>
            <?php endforeach; ?>






        <div class="col-md-6 intro-info text-center">
            <h3 class="color_content">People's Democratic Republic of Algeria<br/>
              Ministry of Higher Education and Scientific Research<br/></h3>
            <h1 class="color_content"><b>The Research centre in Industrial Technologies </b><br/></h1>
            <h3 class="color_content" ><b>ORGANIZES</b><br/></h3>
            <?php foreach ($theme as $theme): ?>
             <h3><?php echo htmlspecialchars($theme['title_home']); ?></h3>
             <?php endforeach; ?>




            <?php
             $registration= get_theme($pdo);
             ?>
              <?php foreach ($registration as $info): ?>
             <h3><?php echo htmlspecialchars($info['workshop_dates']); ?></h3><br/>
             <?php endforeach; ?>
            <!-- <b>On May 7<sup>th</sup> - 8<sup>th</sup> 2024</b></h3><br/>   -->
          </div>


          
          <?php foreach ($logo2 as $logo2): ?>
            <div class="header">
                    <img src="<?php echo htmlspecialchars($logo2['logo2']); ?>" class="logo" alt="">
                </div>
            <?php endforeach; ?>
   
    </div> 
    
    
    <div class="col-md-6 intro-info text-center p-md-5">
                <video src="<?php echo getVideoSrc(); ?>" style="width: 50%;height: 25%;" autoplay></video>
            </div>
            <div class="col-md-6 intro-info text-center">
                <a href="<?php echo getDownloadLink(); ?>" class="btn-get-started scrollto btn btn-lg" target="_blank">Download The <?php echo getSettingValue('workshop_title', 'Workshop'); ?></a>
            </div>
        </div>
    </div>
</section>





<!-- =============================   about   =================================== -->


<section id="about" style="padding-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 col-md-6">
                <div class="about-img">
                    <img src="<?php echo getAboutImage(); ?>" alt="About Image">
                </div>
                <br/>
            </div>
            <div class="col-lg-7 col-md-6">
                <div class="about-content wow fadeIn text-justify">
                    <h2><?php echo getSettingValue('workshop_title', 'Workshop Title'); ?></h2>
                    <p><?php echo getSettingValue('workshop_description1', 'Workshop description 1 not available.'); ?></p>
                    <p><?php echo getSettingValue('workshop_description2', 'Workshop description 2 not available.'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
 

<!-- =============================   slider   =================================== -->

<?php
$sponsore_images = get_all_sponsore($pdo);
?>
<section id="slider" style="padding-top: 100px;">
    <div class="container">
        <div class="slide-track">
            <?php foreach ($sponsore_images as $image): ?>
                <div class="slide">
                    <img src="<?php echo htmlspecialchars($image['URL_imag_spon']); ?>" class="slide" alt="">
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>




<!-- =============================   TOPICS   =================================== -->


<section id="TOPICS" style="padding-top: 100px;">

        <div class="container_TOPICS">
        <h1 class="head_h1" >Topics</h1>
       
            <ul>
                <?php
                
                $topics = get_all_topics($pdo);
                foreach ($topics as $topic) {
                    echo '<li class="topic-item"><span class="check-icon">✓</span> ' . htmlspecialchars($topic['design_sujet']) . '</li>';
                }
                ?>
            </ul>
            
        </div>
    </section>
    
    
<!-- =============================   COMMITTE   =================================== -->

<?php
$membres = get_all_membres_organisationnelle($pdo);
$Vice_Chairman = get_all_vice_president_organisationnelle($pdo);
$Chairman = get_all_concession_organisationnelle($pdo);

$Chairman_S = get_all_president_scientific($pdo);
$membres_S = get_all_membres_scientific($pdo);
$Vice_Chairman_S = get_all_vice_president_scientific($pdo);
$theme = get_theme($pdo); 
?>

<section id="Committees" style="padding-top: 100px;">
    <h1 class="head_h1" >Committees</h1>
    <h6>Workshop Chairman</h6>
    <?php foreach ($theme as $theme): ?>
        <h6><?php echo htmlspecialchars($theme['presedant_workshop']); ?></h6>
    <?php endforeach; ?>

    <div class="committee">
        <div class="committee-item">
            <center>
            <h3>Organization Committee</h3>
            </center>
      
            <!-- ======================= president_organisationnelle =========================== -->
            <?php if (!empty($Chairman)): ?>

                

                <h4 id="organisationnelle">Chairman:</h4>
                <ul>
                    <?php foreach ($Chairman as $chair): ?>
                        <li id="organisationnelle"><?php echo htmlspecialchars($chair['president_O']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <!-- ======================= membres_organisationnelle =========================== -->
            <?php if (!empty($membres)): ?>
                <h4 id="organisationnelle">Members:</h4>
                <ul>
                    <?php foreach ($membres as $membre): ?>
                        <li id="organisationnelle"><?php echo htmlspecialchars($membre['membres_O']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <!-- ======================= vice_president_organisationnelle =========================== -->
            <?php if (!empty($Vice_Chairman)): ?>
                <h4 id="organisationnelle">Vice Chairman:</h4>
                <ul>
                    <?php foreach ($Vice_Chairman as $vice_chair): ?>
                        <li id="organisationnelle"><?php echo htmlspecialchars($vice_chair['vice_president_O']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
 
        <!-- =============================   COMMITTE Scientific  =================================== -->
        <div class="committee-item">
        <center>
            <h3>Scientific Committee</h3>
            </center>
        
            <!-- ======================= president_Scientific =========================== -->
            <?php if (!empty($Chairman_S)): ?>
                <h4 id="Scientific">Chairman:</h4>
                <ul>
                    <?php foreach ($Chairman_S as $chair_S): ?>
                        <li id="Scientific"><?php echo htmlspecialchars($chair_S['president_S']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <!-- ======================= membres_Scientific =========================== -->
            <?php if (!empty($membres_S)): ?>
                <h4 id="Scientific">Members:</h4>
                <ul>
                    <?php foreach ($membres_S as $membre_S): ?>
                        <li id="Scientific"><?php echo htmlspecialchars($membre_S['membres_S']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            
            <!-- ======================= vice_president_Scientific =========================== -->
            <?php if (!empty($Vice_Chairman_S)): ?>
                <h4 id="Scientific">Vice Chairman:</h4>
                <ul>
                    <?php foreach ($Vice_Chairman_S as $vice_chair_S): ?>
                        <li id="Scientific"><?php echo htmlspecialchars($vice_chair_S['V_president_S']); ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</section>


<br><br>

<!-- =============================   Registration_Fee    =================================== -->



<?php
$theme = get_theme($pdo);
?>
<center>
<section class="Registration_Fee" id="Registration" style="padding-top: 100px;">
    <h1 class="title">Registration Form</h1>

    <?php if (!empty($theme)): ?>
        <?php foreach ($theme as $info): ?>
            <?php if (!empty($info['description']) || !empty($info['paper_submission_date']) || !empty($info['acceptance_notification_date']) || !empty($info['workshop_dates']) || (!empty($info['registration_fee']) && $info['registration_fee'] > 0) || !empty($info['additional_info'])): ?>
                
                <?php if (!empty($info['description'])): ?>
                    <p class="description">
                        <?php echo htmlspecialchars($info['description']); ?>
                        <br>
                        <?php if (!empty($info['paper_submission_date'])): ?>
                            <span class="highlight"><?php echo date('F, jS', strtotime($info['paper_submission_date'])); ?>, 2024</span>.
                        <?php endif; ?>
                    </p>
                <?php endif; ?>

                <div class="dates">
                    <?php if (!empty($info['paper_submission_date'])): ?>
                        <div class="date-box">
                            <p><?php echo date('F, jS, Y', strtotime($info['paper_submission_date'])); ?> | Paper submission deadline</p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($info['acceptance_notification_date'])): ?>
                        <div class="date-box">
                            <p><?php echo date('F, jS, Y', strtotime($info['acceptance_notification_date'])); ?> | Notification of acceptance</p>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($info['workshop_dates'])): ?>
                        <div class="date-box">
                            <p><?php echo htmlspecialchars($info['workshop_dates']); ?> | Workshop dates</p>
                        </div>
                    <?php endif; ?>
                </div>

                <?php if (!empty($info['registration_fee']) && $info['registration_fee'] > 0): ?>
                    <div class="registration">
                        <p class="fee">Registration Fee | <?php echo number_format($info['registration_fee'], 2, ',', '.'); ?> DA</p>
                    </div>
                <?php endif; ?>

                <?php if (!empty($info['additional_info'])): ?>
                    <ul class="additional-info">
                        <?php 
                        $additional_info = explode('|', $info['additional_info']);
                        foreach ($additional_info as $detail): 
                        ?>
                            <li><?php echo htmlspecialchars($detail); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>

            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No information available at this time.</p>
    <?php endif; ?>

    <div class="qr-code">
    <a href="registration.php" style="text-decoration: none;" class="custom-btn">Registration</a>


    </div>
</section>
</center>





  

   <?php  include'./layout/footer.php';?>

  