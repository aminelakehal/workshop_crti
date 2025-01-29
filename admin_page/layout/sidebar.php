
<?php require_once __DIR__ . '/../core/router.php';?>

<div class="layer"></div>
<!-- ! Body -->
<a class="skip-link sr-only" href="#skip-target">Skip to content</a>
<div class="page-flex">
  <!-- ! Sidebar -->
  <aside class="sidebar">
    <div class="sidebar-start">
        <div class="sidebar-head">
            <a href="##" class="logo-wrapper" title="Home">
                <span class="sr-only">Home</span>
                <span class="icon logo" aria-hidden="true"></span>
                <div class="logo-text">
                    <span class="logo-title">CRTI</span>
                    <span class="logo-subtitle">Dashboard</span>
                </div>
            </a>
            <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                <span class="sr-only">Toggle menu</span>
                <span class="icon menu-toggle" aria-hidden="true"></span>
            </button>
        </div>
        <div class="sidebar-body">
            <ul class="sidebar-body-menu">
                <li>
                    <a href="index.php?view=dashboard"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon user-3" aria-hidden="true"></span>Users
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                     <?php if ($_SESSION['Role'] === 'super_admin') { ?>
                     <li><a href="index.php?view=Admin">Admin</a></li>
                    <?php } ?>                        
                        <li><a href="index.php?view=user">Candidates</a></li>
                    </ul>
                </li>


                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>file
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                    <li><a href="index.php?view=condidates">file condidates</a></li>
                    <li><a href="index.php?view=fields">Add input File </a></li>
                    </ul>
                </li>
               
                 



                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span>Logo
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                    <li><a href="index.php?view=navigateur">Title Site</a></li>
                        <li><a href="index.php?view=logo">Logo</a></li>
                        <li><a href="index.php?view=sponsore">Sponsor</a></li>
                    </ul>
                </li>
               

                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Theme
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li><a href="index.php?view=contenu">Content</a></li>
                        <li><a href="index.php?view=theme">theme</a></li>
                        <li><a href="index.php?view=color">Color Site</a></li>
                        
                    </ul>
                </li>





                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Topic
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li><a href="index.php?view=topic">Topic</a></li>
                    </ul>
                </li>
                

                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Concession
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li><a href="index.php?view=organisationnelle">Organization</a></li>
                        <li><a href="index.php?view=scientifique">Scientifique</a></li>
                    </ul>
                </li>





                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>Social Media
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li><a href="index.php?view=social_media">Social Media</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
  </aside>

  <div class="main-wrapper">
    <!-- ! Main nav -->
    <nav class="main-nav--bg">
      <div class="container main-nav">
        <div class="main-nav-start">
          <div class="search-wrapper">
          </div>
        </div>
        <div class="main-nav-end">
          <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
            <span class="sr-only">Toggle menu</span>
            <span class="icon menu-toggle--gray" aria-hidden="true"></span>
          </button>
          <div class="lang-switcher-wrapper">
            <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
              <span class="sr-only">Switch theme</span>
              <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
              <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
            </button>
          </div>
          <div class="nav-user-wrapper">
            <button class="nav-user-btn dropdown-btn" title="My profile" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <style>
.profil-icon {
  display: inline-block;
  width: 40px;
  height: 40px;
  background-image: url('ressource/img/svg/profile-user.svg');
  background-size: cover;
  margin-right: 10px;
  cursor: pointer;
}

</style>
<br>
          <p>
  <span class="profil-icon"></span> 
  <br>
  <?php echo $fullName; ?>
</p>
               
              </span>
            </button>
           
            <ul class="dropdown-menu users-item-dropdown nav-user-dropdown">
              <li></li>
              <li>
                <a class="dropdown-item danger" href="./logout.php">
                  <i data-feather="log-out" aria-hidden="true"></i>
                  <span>Log out</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </nav>
 
