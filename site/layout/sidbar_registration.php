<?php include 'header_registration.php'; ?>
<?php require_once __DIR__ . '/../controllers/logo_controller.php'; ?>

<?php
$logo_home = get_all_logo($pdo);
?>

<?php
$is_home = false; 

if (basename($_SERVER['PHP_SELF']) == 'index.php') {
    $is_home = true;
}
?>


<body>

    <div class="main">
 
        <nav class="navbar navbar-expand-custom navbar-mainbg">

            <?php foreach ($logo_home as $logo_home): ?>
                <a class="navbar-brand navbar-logo" href="index.php">
                    <img src="<?php echo htmlspecialchars($logo_home['logo_home']); ?>" class="logo-img" alt="logo">
                </a>
            <?php endforeach; ?>

            <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="lnr lnr-menu text-white"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <div class="hori-selector">
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                    <li class="nav-item">
                    <a class="nav-link" href="index.php"><i class="lnr lnr-home"></i>HOME</a></li>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php #about"><i class="lnr lnr-book"></i> ABOUT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php #TOPICS"><i class="lnr lnr-bookmark"></i> TOPICS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php #Committees"><i class="lnr lnr-users"></i> COMMITTEE</a>
                    </li>
                    <li class="nav-item">
                    <?php echo $is_home ? 'active' : ''; ?><a class="nav-link" href="registration.php"><i class="lnr lnr-calendar-full"></i> REGISTRATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="lnr lnr-envelope"></i> CONTACT US</a>
                    </li>

                    <?php if ($isLoggedIn): ?>
                        <li class="nav-item">
                            <a class="nav-link" id="profileLink" style="cursor: pointer;" >
                                <img src="./images/profil.svg" alt="Profile" class="profile-icon"> <?php echo htmlspecialchars($fullname); ?>
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./login/login.php"><i class="lnr lnr-enter"></i> LOG IN</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>

        <div id="profileModal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Welcome, <?php echo htmlspecialchars($fullname); ?>!</p>
                <a href="profile.php">Go to Profile</a><br>
                <a href="logout.php" class="logout">Log Out</a>
            </div>
        </div>



    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const navLinks = document.querySelectorAll('.nav-item .nav-link');
        
        if (navLinks.length === 0) return;

        const currentPath = window.location.pathname + window.location.hash;

        navLinks.forEach(link => {
            const linkPath = new URL(link.href).pathname + new URL(link.href).hash;

            if (linkPath === currentPath) {
                link.parentElement.classList.add('active');
            } else {
                link.parentElement.classList.remove('active');
            }
        });

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.forEach(l => l.parentElement.classList.remove('active'));

                this.parentElement.classList.add('active');
            });
        });
    });



    
</script>



