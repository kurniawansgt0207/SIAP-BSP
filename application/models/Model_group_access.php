<?php
    Class Model_group_access extends CI_Model
    {        
        function showParentMenuGroup($group,$group_module){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT c.id,a.group_user,b.module_name,c.module_title,c.class_icon,
            c.module_group,c.module_url,c.is_parent 
            FROM ".$prefixTbl."m_group_user a
            INNER JOIN ".$prefixTbl."m_group_user_detail b ON a.group_user=b.group_user
            INNER JOIN ".$prefixTbl."m_module c ON b.module_name=c.module_name
            WHERE a.group_user='$group' AND c.is_parent=1 AND c.module_group='$group_module'
            ORDER BY c.visual_order ASC";
            $query = $this->db->query($sql);
            return $query;
        }
        
        function showChildMenuGroup($group,$parent_id){
            $prefixTbl = $this->db->dbprefix;
            $sql = "SELECT c.id,a.group_user,b.module_name,c.module_title,
            c.class_icon,c.module_group,c.module_url,c.is_parent 
            FROM ".$prefixTbl."m_group_user a
            INNER JOIN ".$prefixTbl."m_group_user_detail b ON a.group_user=b.group_user
            INNER JOIN ".$prefixTbl."m_module c ON b.module_name=c.module_name
            WHERE a.group_user='$group' AND c.is_parent=0 AND c.parent_id='$parent_id'
            ORDER BY c.visual_order ASC";
            $query = $this->db->query($sql);
            return $query;
        }
    }