<?php

class Api_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();

        $this->load->database();
        // $CI =   &get_instance();
        // $this->db2 = $this->load->database('db2', TRUE);   
    }
    
    // validate login details
    function login($username, $password){
        $this->db->where('reg_no', $username);
        $this->db->where('password', md5($password));
        $this->db->limit(1);
        $ugt = $this->db->get('users');
        $cnt = $ugt->num_rows();

        if ($cnt) {
            $data = $ugt->row();
            return array("success"=>true, "reg_no"=>$data->reg_no, "utype"=>$data->utype, "name"=>$data->name);
        } 
        else {
            return array("success"=>false, "error"=>$username);
        }
    }

   

   


    // ###################
    // colleges list for form
    // function allCollegesAndDepts($reg_no, $params) {
    //     $utype = $params[0];
    //     if($utype == "adm" || $utype == "stf") {
    //         if($utype == 'stf')
    //             $roll = $this->db->query("select count(*) as count from raghuerp_db.staff where reg_no='".$reg_no."' and roll='ps' and status='1' ")->row()->count;
    //         else
    //             $roll = true;
    //         if($roll) {
    //             $college_data = $this->db->query("select * from colleges where status=1 order by college asc")->result();
    //             $dept_rs = $this->db->query("select * from departments where status = 1 order by department asc")->result();

    //             foreach($dept_rs as $dp) {
    //                 $depts[$dp->college][] = $dp;
    //             }
    //         } 
    //         else {
    //             $college_data = [];
    //             $depts = [];
    //         }
    //     } 
    //     else {
    //         $college_data = [];
    //         $depts = [];
    //     }

    //     $return['success'] = true;
    //     $return['colleges'] = $college_data;
    //     $return['departments'] = $depts;
    //     return $return;
    // }
    
    // gettign designations data
    // function getDesignations($reg_no, $params){
    //     $utype = $params[0];
    //     if($utype == "adm") {
    //         $data = $this->db->query("select * from raghuerp_db.designations where status=1")->result();
    //     } 
    //     else if($utype == "stf") {
    //         $roll = $this->db->query("select count(*) as count from raghuerp_db.staff where reg_no='".$reg_no."' and roll='ps' and status='1' ")->row()->count;
    //         if($roll) {
    //             $data = $this->db->query("select * from raghuerp_db.designations where status=1")->result();
    //         } 
    //         else {
    //             $data = [];
    //         }
    //     } 
    //     else {
    //         $data = [];
    //     }
    //     $return['success'] = true;
    //     $return['data'] = $data;
    //     return $return;
    // }
    


    
    // designation get
    public function getdesignationss(){
        $sql="select * from designations";
        $data=$this->db->query($sql);
        return $data->result();         
    }
    // year update
     public function updateyear($data){
       $this->db->where('id',$data['id']);
       $this->db->update('year',$data);         
    }


    // add new booking
     public function addbooking($data){
       $this->db->insert('raghuerp_hostel.bookings',$data);
             
    }


    // venkat
    // add room type
     public function addtype($data){
       $this->db->insert('raghuerp_hostel.roomtype',$data);       
    }


    //  get room type
    public function getroomtype(){
        $sql="select * from roomtype";
        $data=$this->db->query($sql);
        return $data->result();
    }
    //get list for mess
     public function getlist(){
        // $sql="select * from stocks";
        $sql ="SHOW COLUMNS FROM `stocks`";
        $data=$this->db->query($sql);
        return $data->result();         
    }

    // add registration
     public function addregistration($data){ 
        // echo date('Y-m-d H:i:s');
       $data['registerdate']=date('Y-m-d H:i:s');
       $this->db->insert('raghuerp_hostel.registrationdetails',$data);       
    }

// insert fee configuration
    //  public function feeconfig($data){
    //      $roomtype=$data['roomtype'];
    //      $totalamount=$data['totalamount'];
    //      $totaldues=$data['totaldues'];
    //      $data['amt_perdue']=$totalamount/$totaldues;
         
    //     //  $sql="update raghuerp_hostel.feeconfig f set f.roomtype='$roomtype',f.totalamount='$totalamount',f.totaldues='$totaldues'  ";
    //    $this->db->insert('raghuerp_hostel.feeconfig',$data);
             
    // }



    // Get Multiple query results function
    public function GetMultipleQueryResult($queryString)  {
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

 public function insertlist($data){
       $this->db->insert('product',$data);
             
    }

}
?>
