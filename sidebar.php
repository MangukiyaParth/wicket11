<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="page/manage_dashboard" class="logo logo-light">
        <span class="logo-lg py-2">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo.png" alt="logo" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-sm.png" alt="small logo" height="25">
        </span>
    </a>

    <!-- Logo Dark -->
    <a href="index.php" class="logo logo-dark">
        <span class="logo-lg py-2">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark.png" alt="dark logo" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark-sm.png" alt="small logo" height="25">
        </span>
    </a>

    <button class="button-toggle-menu button-toggle-menu-desktop">
        <i class="fa-solid fa-chevron-left"></i>
        <i class="fa-solid fa-chevron-right"></i>
    </button>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </button>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <?php
        if(str_contains($userObj['userroleid'], $const->admin_role_id))
        {
            $manage_apps_viewright =1;
            $manage_removed_apps_viewright =1;
            $manage_play_store_viewright =1;
            $manage_adx_viewright =1;
            $manage_notification_viewright =1;

        }else{
            $manage_apps_Array = $gh->findArrayByValue($setrights, 'pagename','manage_apps');
            $manage_removed_apps_Array = $gh->findArrayByValue($setrights, 'pagename','manage_removed_apps');
            $manage_play_store_Array = $gh->findArrayByValue($setrights, 'pagename','manage_play_store');
            $manage_adx_Array = $gh->findArrayByValue($setrights, 'pagename','manage_adx');
            $manage_notification_Array = $gh->findArrayByValue($setrights, 'pagename','manage_notification');

            //====================================================  View Rights ====================================================
            
            $manage_apps_viewright =$manage_apps_Array['viewright'];
            $manage_removed_apps_viewright =$manage_removed_apps_Array['viewright'];
            $manage_play_store_viewright =$manage_play_store_Array['viewright'];
            $manage_adx_viewright =$manage_adx_Array['viewright'];
            $manage_notification_viewright =$manage_notification_Array['viewright'];
        }
        
        ?>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <hr class="sapreter">
            <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_dashboard')" class="side-nav-link" data-name="manage_dashboard"><i class="fa-solid fa-house"></i><span> Dashboard </span></a></li>
            <?php
            if($manage_apps_viewright == 1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_apps')" data-name="manage_apps"  class="side-nav-link"><i class="fa-solid fa-table-cells-large"></i><span>Apps</span></a></li>
                <?php
            }
            if($manage_removed_apps_viewright == 1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_removed_apps')" data-name="manage_removed_apps"  class="side-nav-link"><i class="fa-solid fa-eraser"></i><span>Removed Apps</span></a></li>
                <?php
            }
            if($manage_play_store_viewright == 1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_play_store')" data-name="manage_play_store"  class="side-nav-link"><i class="fa-brands fa-google-play"></i><span>Play Store</span></a></li>
                <?php
            }
            if($manage_adx_viewright == 1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_adx')" data-name="manage_adx"  class="side-nav-link"><i class="fa-solid fa-bullhorn"></i><span>ADX</span></a></li>
                <?php
            }
            if($manage_notification_viewright == 1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="OpenNotification()" class="side-nav-link"><i class="fa-regular fa-bell"></i><span class="badge bg-success float-end noti-cnt d-none">0</span><span>Notification</span></a></li>
                <?php
            }
            ?>
            <hr class="sapreter">
            <li class="side-nav-item"><a href="<?php echo ADMIN_PANEL_URL; ?>logout" class="side-nav-link"><i class="fa-solid fa-arrow-right-from-bracket"></i><span>Logout</span></a></li>
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->