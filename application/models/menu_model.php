<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu_model extends CI_model
{

    public function getSubMenu()
    {
        $query = "SELECT`mst_user_sub_menu`.*,`mst_user_menu`.`vc_menu` FROM `mst_user_sub_menu` JOIN `mst_user_menu` ON `mst_user_sub_menu`.`nu_id_user_menu`=`mst_user_menu`.`nu_id`";

        return   $this->db->query($query)->result_array();
    }
}
