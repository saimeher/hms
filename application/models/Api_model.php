<?php

class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->database();
    }
    
    // validate login details
    function login($username, $password) 
    {
        $this->db->where('reg_no', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $ugt = $this->db->get('users');
        $cnt = $ugt->num_rows();

        if ($cnt) {
            $data = $ugt->row();
            return array("success"=>true, "reg_no"=>$data->reg_no, "utype"=>$data->utype, "name"=>$data->name);
        } else {
            return array("success"=>false, "error"=>$username);
        }
    }

    // user data
    function userData($eid) {
        $this->db->where('eid', $eid);
        $this->db->limit(1);
        $ugt = $this->db->get('examiner');
        $data = $ugt->row();
        return $data;
    }

   // changePassword
    function changePassword($eid, $params)
    {
        $old_pass = $params[0];
        $new_pass = $params[1];

        $data = $this->userData($eid);
        if($data->password == md5($old_pass)) {
            $upd['password'] = md5($new_pass);
            $this->db->where('eid', $data->eid);
            $st = $this->db->update("examiner", $upd);
            if($st) {
                $dt['sus'] = "true";
                $dt['message'] = "Password Changed Successfully...!";
                return $dt;
            } else {
                $dt['sus'] = "false";
                $dt['message'] = "Unable Change Password.. Try Again..";
                return $dt;
            }
        } else {
            $dt['sus'] = "false";
            $dt['message'] = "Old Password Does Not Match...!";
            return $dt;
        }
    }
    
    // getStaffData
    function getStaffData($reg_no, $params)
    {
        $utype = $params[0];
        if($utype == "adm") {
            $data = $this->db->query("select * from staff")->result();
        } else if($utype == "stf") {
            $roll = $this->db->query("select count(*) as count from staff where reg_no='".$reg_no."' and roll='ps' and status='1' ")->row()->count;
            if($roll) {
                $data = $this->db->query("select * from staff")->result();
            } else {
                $data = [];
            }
        } else {
            $data = [];
        }
        $return['success'] = true;
        $return['data'] = $data;
        return $return;
    }


 

    // Get Multiple query results function
    public function GetMultipleQueryResult($queryString)
    {
        if (empty($queryString)) {
                    return false;
                }

        $index     = 0;
        $ResultSet = array();

        /* execute multi query */
        if (mysqli_multi_query($this->db->conn_id, $queryString)) {
            do {
                if (false != $result = mysqli_store_result($this->db->conn_id)) {
                    $rowID = 0;
                    while ($row = $result->fetch_assoc()) {
                        $ResultSet[$index][$rowID] = $row;
                        $rowID++;
                    }
                }
                $index++;
            } while (mysqli_more_results($this->db->conn_id) && mysqli_next_result($this->db->conn_id));
        }

        return $ResultSet;
    }

}
?>
