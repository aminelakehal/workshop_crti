
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_name('admin_session'); 
    session_start();
}


if (isset($_GET['view'])) {
    $view = htmlspecialchars($_GET['view']);
    switch ($view) {

        case 'dashboard':
            require_once 'views/dashboard-view.php';
            break;


        case 'user':
            require_once 'views/user_view.php';
            break;
            case 'condidates':
                require_once 'views/condidates_view.php';
                break;
            case 'organisationnelle':
                require_once 'views/organisationnelle_view.php';
                break;

                case 'add_organisationnelle':
                    require_once 'views/add_views/add_organisationnelle_view.php';
                    break;

                case 'scientifique':
                    require_once 'views/scientifique_view.php';
                    break;


                    case 'add_scientific':
                        require_once 'views/add_views/add_scientific.php';
                        break;
                       


                        case 'Admin':
                            if (!isset($_SESSION['id_admin'])) {
                                require_once 'logine/signup.php';
                                exit();
                            }
                            
                            if ($_SESSION['Role'] === 'super_admin') {
                                require_once 'views/Admin_view.php'; 
                            } else {
                                header("Location: views/403.php");
                                exit();
                            }

                            break;

                            case 'edit_admin':
                                if (!isset($_SESSION['id_admin'])) {
                                    require_once 'logine/signup.php';
                                    exit();
                                }
                                if ($_SESSION['Role'] === 'super_admin') {
                                    require_once 'views/edit_views/edit_admin_view.php';
                                } else {
                                    header("Location: views/403.php");
                                    exit(); 
                                }
                                break;
                            

                                case 'add_admin':
                                    if (!isset($_SESSION['id_admin'])) {
                                        require_once 'logine/signup.php';
                                        exit();
                                    }
                                    if ($_SESSION['Role'] === 'super_admin') {
                                        require_once 'views/add_views/add_admin_view.php';
                                    } else {
                                        header("Location: views/403.php");
                                        exit();
                                    }
                                    break;
                                




                                    case 'add_user':
                                        require_once 'views/add_views/add_user_view.php';
                                        break;

                                    case 'edit_user':
                                        require_once 'views/edit_views/user_edit_view.php';
                                        break;
                                       
                                            case 'add_form.php':
                                                require_once 'views/add_views/add_form_view.php';
                                                break;
                                            
                                                    case 'topic':
                                                        require_once 'views/topic_view.php';
                                                        break;
                                                        case 'add_topic':
                                                            require_once 'views/add_views/add_topics.php';
                                                            break;

                                                            case 'sponsore':
                                                                require_once 'views/views_sponsore.php';
                                                                break;

                                                                case 'add_sponsore':
                                                                    require_once 'views/add_views/add_sponsore.php';
                                                                    break;


                                                                    case 'social_media':
                                                                        require_once 'views/social_media_views.php';
                                                                        break;


                                                                    case 'add_social_media':
                                                                        require_once 'views/add_views/add_social_media.php';
                                                                        break;

                                                                        case 'add_theme_view':
                                                                            require_once 'views/add_views/add_theme_view.php';
                                                                            break;

                                                                            case 'theme':
                                                                                require_once 'views/theme_views.php';
                                                                                break;

                                                                                case 'contenu':
                                                                                    require_once 'views/contenu_view.php';
                                                                                    break;

                                                                                case 'add_contenu':
                                                                                    require_once 'views/add_views/add_contenu.php';
                                                                                    break;

                                                                                    case 'logo':
                                                                                        require_once 'views/logo_view.php';
                                                                                        break;

                                                                                    case 'add_logo':
                                                                                        require_once 'views/add_views/add_logo.php';
                                                                                        break;
                                                                                        
                                                                                        case 'navigateur':
                                                                                            require_once 'views/navigateur_views.php';
                                                                                            break;

                                                                                            case 'add_navigateur':
                                                                                                require_once 'views/add_views/add_navigateur.php';
                                                                                                break;

                                                                                                case 'color':
                                                                                                    require_once 'views/views_color.php';
                                                                                                    break;

                                                                                            case 'add_color':
                                                                                                require_once 'views/add_views/add_color.php';
                                                                                                break;
                                                                                                case 'edit_color':
                                                                                                    require_once 'views/edit_views/edit_color.php';
                                                                                                    break;
                                                                                                

                                                                                            case 'fields':
                                                                                                require_once 'views/views_file_fields.php';
                                                                                                break;
                                                                                            
                                                                                            case 'add_fields':
                                                                                                require_once 'views/add_views/add_fields.php';
                                                                                                break;
        default:
      
        header("HTTP/1.0 404 Not Found");
        require_once 'views/404.php'; 
        exit();

    }
} else {
    if (!isset($_SESSION['id_admin'])) {
        require_once 'logine/signup.php';
        exit();
    }
}
?>
