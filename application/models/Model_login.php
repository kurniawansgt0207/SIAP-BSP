<?php
    Class Model_login extends CI_Model
    {

        function user($username, $password)
        {
            /*$this -> db -> select('*');
            $this -> db -> from('users');
            $this -> db -> where('username', $username);
            $this -> db -> where('password', $password);
            $this -> db -> limit(1);

            $query = $this->db->get();*/
            
            $sql = "SELECT a.username,a.fullname,b.group_user,a.provinsi 
            FROM users a
            INNER JOIN users_detail b ON a.username=b.username
            WHERE a.username='$username' AND a.password='$password'";
            $query = $this->db->query($sql);
            if($query->num_rows() == 1)
            {
                return $query->result();
            }
            else
            {
                return false;
            }
        }
    }
?>