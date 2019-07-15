        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('user/index'); ?>">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-book-open"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SUO Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Query Menu  -->
            <?php
            $role_id = $this->session->userdata('role_id');
            $queryMenu = "SELECT`mst_user_menu`.`nu_id`,`mst_user_menu`.`vc_menu` 
            FROM `mst_user_menu` JOIN`tr_access_menu`
            ON`mst_user_menu`.`nu_id`=`tr_access_menu`.`nu_id_user_menu` 
            WHERE`tr_access_menu`.`nu_role_id`=$role_id
            ORDER BY `tr_access_menu`.`nu_id_user_menu` ASC
            ";

            $menu = $this->db->query($queryMenu)->result_array();

            ?>




            <!-- Looping Menu-->
            <?php foreach ($menu as $m) : ?>

                <div class="sidebar-heading">
                    <?= $m['vc_menu'] ?>
                </div>



                <!-- Sub Menu Sesuai Menu -->
                <?php
                $menuId = $m['nu_id'];
                $querySubMenu = "SELECT* 
                FROM`mst_user_sub_menu` JOIN`mst_user_menu`
                ON`mst_user_sub_menu`.`nu_id_user_menu`=`mst_user_menu`.`nu_id`
                 WHERE`mst_user_sub_menu`.`nu_id_user_menu`=$menuId
                 AND `mst_user_sub_menu`.`is_active`=1
                 ";
                $subMenu = $this->db->query($querySubMenu)->result_array();
                ?>

                <?php foreach ($subMenu as $sm) : ?>
                    <!-- Nav Item - Dashboard -->
                    <?php if ($title == $sm['vc_title']) : ?>
                        <li class="nav-item active">
                        <?php else : ?>
                        <li class="nav-item ">
                        <?php endif; ?>

                        <a class="nav-link" href="<?= base_url($sm['vc_url']); ?>">
                            <i class="<?= $sm['vc_icon']; ?>"></i>
                            <span><?= $sm['vc_title']; ?></span></a>
                    </li>


                    <!-- Divider -->
                    <hr class="sidebar-divider">
                <?php endforeach; ?>

            <?php endforeach; ?>






            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('auth/logout') ?>">
                    <i class="fas  fa-fw fa-chart-area"></i>
                    <span>Log Out</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->