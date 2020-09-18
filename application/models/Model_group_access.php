<?php
    Class Model_group_access extends CI_Model
    {
        function showParentMenuGroup($group,$group_module){
            $sql = "SELECT c.id,a.group_user,b.module_name,c.module_title,c.class_icon,
            c.module_group,c.module_url,c.is_parent 
            FROM m_group_user a
            INNER JOIN m_group_user_detail b ON a.group_user=b.group_user
            INNER JOIN m_module c ON b.module_name=c.module_name
            WHERE a.group_user='$group' AND c.is_parent=1 AND c.module_group='$group_module'";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showChildMenuGroup($group,$parent_id){
            $sql = "SELECT c.id,a.group_user,b.module_name,c.module_title,
            c.class_icon,c.module_group,c.module_url,c.is_parent 
            FROM m_group_user a
            INNER JOIN m_group_user_detail b ON a.group_user=b.group_user
            INNER JOIN m_module c ON b.module_name=c.module_name
            WHERE a.group_user='$group' AND c.is_parent=0 AND c.parent_id='$parent_id'";
            $query = $this->db->query($sql);
            return $query;
        }
    }