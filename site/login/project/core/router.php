<?php
// Simple router to include the right view based on a query parameter


if (isset($_GET['view'])) {
    $view = $_GET['view'];
    switch ($view) {
        case 'user':
            require_once 'views/user_view.php';
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
                    case 'Admin':
                        require_once 'views/Admin_view.php';
                        break;
                        case 'logo':
                            require_once 'views/logo_view.php';
                            break;
                            case 'contenu':
                                require_once 'views/contenu_view.php';
                                break;
                                case 'add_user':
                                    require_once 'views/add_views/add_user_view.php';
                                    break;
                                    case 'add_admin':
                                        require_once 'views/add_views/add_admin_view.php';
                                        break;
                                    case 'edit_user':
                                        require_once 'views/edit_views/user_edit_view.php';
                                        break;
                                        case 'edit_admin':
                                            require_once 'views/edit_views/edit_admin_view.php';
                                            break;
                                            case 'add_form.php':
                                                require_once 'views/add_views/add_form_view.php';
                                                break;
                                                case 'condidates_viwes.php':
                                                    require_once 'views/condidates_viwes.php';
                                                    break;
                                        
        default:
            echo "View not found!";
    }
} else {
    // Default view 
    require_once 'logine/signup.php';
}
?>
