<?php
session_start();
if (!isset($_SESSION['id_admin'])) {
    header("Location: index.php");
    exit();
}


?>
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
                    <!-- <a class="active" href="##"><span class="icon home" aria-hidden="true"></span>Dashboard</a> -->
                    <a href="##"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                </li>
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
                       
                        <li>
                            <a href="index.php?view=Admin">Admin</a>
                        </li>
                     
                        <li>
                            <a href="index.php?view=user">condidates</a>
                        </li>
                    </ul>
                </li>
                <!-- <li>
                  <a class="show-cat-btn" href="##">
                      <span class="icon user-3" aria-hidden="true"></span>Users
                      </span>
                  </a> -->
              </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon document" aria-hidden="true"></span>Conscesion 
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="index.php?view=organisationnelle">Orgaiszation</a>
                        </li>
                        <li>
                            <a href="index.php?view=scientifique">Scientifique</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="index.php?view=contenu">
                      <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h8M6 10h12M8 14h8M6 18h12"/>
                      </svg>  Content
                       
                            
                            <!-- <span class="icon arrow-down" aria-hidden="true"></span> -->
                        </span>
                    
                </li>
                <li>
                  <a class="show-cat-btn" href="##">
                    <span class="icon user-3" aria-hidden="true"></span> Division 
                    </span>
                </a>
                </li>
                <li>
                  <a class="" href="##">
                    <span class="" aria-hidden="true"></span>
                    Establishment
                    </span>
                </a>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon image" aria-hidden="true"></span> Logo
                        <span class="category__btn transparent-btn" title="Open list">
                            <span class="sr-only">Open list</span>
                            <span class="icon arrow-down" aria-hidden="true"></span>
                        </span>
                    </a>
                    <ul class="cat-sub-menu">
                        <li>
                            <a href="index.php?view=logo">logo</a>
                        </li>
                        <!-- <li>
                            <a href="logo-02.html">logo-02</a>
                        </li>
                        <li>
                          <a href="logo-03.html">logo-03</a>
                      </li> -->
                    </ul>
                </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <!-- <span class="icon paper" aria-hidden="true"></span>  -->
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                          <path fill-rule="evenodd" d="M9 7V2.221a2 2 0 0 0-.5.365L4.586 6.5a2 2 0 0 0-.365.5H9Zm2 0V2h7a2 2 0 0 1 2 2v6.41A7.5 7.5 0 1 0 10.5 22H6a2 2 0 0 1-2-2V9h5a2 2 0 0 0 2-2Z" clip-rule="evenodd"/>
                          <path fill-rule="evenodd" d="M9 16a6 6 0 1 1 12 0 6 6 0 0 1-12 0Zm6-3a1 1 0 0 1 1 1v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 1 1 0-2h1v-1a1 1 0 0 1 1-1Z" clip-rule="evenodd"/>
                        </svg>
                        Fichiers 
                            <!-- <span class="icon arrow-down" aria-hidden="true"></span>  -->
                        </span>
                    </a>
                </li>
                <li>
                  <a class="show-cat-btn" href="##">
                      <span class="icon category" aria-hidden="true"></span>social media
                      </span>
                  </a>
              </li>
              <li>
                <a class="show-cat-btn" href="##">
                    <span class="icon paper" aria-hidden="true"></span>sectors  
                        <!-- <span class="icon arrow-down" aria-hidden="true"></span>  -->
                    </span>
                </a>
            </li>
                <li>
                    <a class="show-cat-btn" href="##">
                        <span class="icon category" aria-hidden="true"></span>sponsorship
                        </span>
                    </a>
                </li>
                <li>
                <a class="show-cat-btn" href="##">
                  <span class="icon category" aria-hidden="true"></span>subject
                  </span>
                </li>
                <li>
                    <span class="icon category" aria-hidden="true"></span>theme 
                    </span>
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
      <i data-feather="search" aria-hidden="true"></i>
      <input type="text" placeholder="Enter keywords ..." required>
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
      <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
        <span class="sr-only">My profile</span>
        <span class="nav-user-img">
          <picture><source srcset="ressource/img/avatar/avatar-illustrated-02.webp" type="image/webp"><img src="ressource/img/avatar/avatar-illustrated-02.png" alt="User name"></picture>
        </span>
      </button>
      <ul class="users-item-dropdown nav-user-dropdown dropdown">
        <li><a href="##">
            <i data-feather="user" aria-hidden="true"></i>
            <span>Profile</span>
          </a></li>
        <li><a class="danger" href="##">
            <i data-feather="log-out" aria-hidden="true"></i>
            <span>Log out</span>
          </a></li>
      </ul>
    </div>
  </div>
</div>

</nav>

