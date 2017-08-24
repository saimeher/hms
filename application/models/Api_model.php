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

 // public function insertlist($data){
 //       $this->db->insert('product',$data);
             
 //    }





    ////Mess
 //     public function insertlist($data)
 //    {  
       
 //        $val1 = $data['insert_date'];
 //       $insert_date = $val1['jsdate'];
        

 //        $active_list = $data['active_list'];
 //        $reg_no = $data['reg_no'];
 //        $type =$data['type']; 

       
 //        $sql = "insert into stock_register(reg_no,item,quantity,price,edate,trans_type) values";
 //        for($i=0; $i<sizeof($active_list); $i++) {
 //            $val = $active_list[$i];
        
 //                $sql .= "('$reg_no','" . $val['name'] . "','" . $val['quantity'] . "','".$val['price']."','$insert_date','$type'),"; 
          
 //            }
 //            $sql = substr($sql, 0, strlen($sql)-1);
 //           if($this->db->query($sql)){
 //            return array("success" => true);

 //            }
 //         else
 //        {
 //            return array("success" => false);
 //        }

 //     }
 // public function itemoutlist($data)
 //    {  
 //         $val1 = $data['out_date'];

 //          $out_date = $val1['jsdate'];
 //        // $out_date = $data['out_date'];

 //        $active_list1 = $data['active_list1'];
 //        $type =$data['type'];
 //        $slot =$data['slot']; 
 //        $reg_no = $data['reg_no'];

 //        $sql = "insert into stock_register(reg_no,item, quantity,edate,slot_type,trans_type) values";
 //        for($j=0; $j<sizeof($active_list1); $j++) {
 //            $val1 = $active_list1[$j];


 //          $sql .= "('$reg_no','" . $val1['name'] . "','" . $val1['quantity'] . "','$out_date','$slot','$type'),"; 
                  
 //        }

 //     $sql = substr($sql, 0, strlen($sql)-1);

 //       if($this->db->query($sql)){
 //      return array("success" => true);

 //    }else{
 //      return array("success" => false);
 // }
    public function insertlist($data)
    {  
        $latest_inn=0;
       //  $val1 = $data['insert_date'];
       // $insert_date = $val1['jsdate'];
       $insert_date1=$data['insert_date'];
        

        $active_list = $data['active_list'];
        $type =$data['type']; 
        $reg_no = $data['reg_no'];

       
      
        for($i=0; $i<sizeof($active_list); $i++) {
           $sql = "insert into stock_register(reg_no,item, quantity,price,receipt_no,edate,trans_type,balance) values";
           $val = $active_list[$i];
           $quantity=  $this->db->query('SELECT * FROM `material` where mid="'.$val['name'].'" ORDER BY mid DESC limit 1')->row();
          
         
           if($quantity->latest_in==0){
           // echo 'if condition';
            $last_in_updated = date('Y-m-d h:i:s');
            $sql .= "('$reg_no','" . $val['name'] . "','" . $val['quantity'] . "','".$val['price']."','".$val['receipt_no']."','$insert_date1','$type','" . $val['quantity'] . "'),"; 
            $inupdate=  $this->db->query('update `material` set latest_in="'.$val['quantity'].'" , total_balance = "'.$val["quantity"].'", last_in_updated =  "'.$last_in_updated.'" where mid="'.$val['name'].'" ');
    
           }else{
          
            $bal1 = $quantity->total_balance;
            $bal = $quantity->total_balance + $val['quantity'];

            $latest_inn += $val['quantity'];
            $last_in_updated = date('Y-m-d h:i:s');
             $sql .= "('$reg_no','" . $val['name'] . "','" . $val['quantity'] . "','".$val['price']."','".$val['receipt_no']."','$insert_date1','$type',($bal1 + ".$val["quantity"].")),";
            $inupdate=  $this->db->query('update `material` set latest_in="'.$latest_inn.'" ,total_balance =  "'.$bal.'", last_in_updated =  "'.$last_in_updated.'"    where mid="'.$val['name'].'" ');
            }     
              $sql = substr($sql, 0, strlen($sql)-1);    
              $result = $this->db->query($sql);
           }
           
           if($result){
            return array("success" => true);

            }
         else
        {
            return array("success" => false);
        }

     }
//  public function itemoutlist($data)
//     {  
//         $latest_out=0;
        
//          $out_date1 = $data['out_date'];

//         $active_list1 = $data['active_list1'];
//         $type =$data['type'];
//         $slot =$data['slot']; 
//         $reg_no = $data['reg_no'];
                    

//         for($j=0; $j<sizeof($active_list1); $j++) {
//             $val1 = $active_list1[$j];
//             $sql = "insert into stock_register(reg_no,item, quantity,units,edate,slot_type,trans_type,balance) values";
//             $quantity= $this->db->query('SELECT * FROM `material` where mid="'.$val1['name'].'" ORDER BY mid DESC limit 1')->row();
           
//             if($quantity){
         
//             $bal1 = $quantity->total_balance; 


//             if($bal1 >= $val1['quantity'])
//             {
//             $bal = $quantity->total_balance - $val1['quantity'];
//             $latest_out += $val1['quantity'];
//             $last_out_updated = date('Y-m-d h:i:s');
//             $sql .= "('$reg_no','" . $val1['name'] . "','" . $val1['quantity'] . "','" . $val1['units'] . "','$out_date1','$slot','$type',($bal1 - ".$val1["quantity"].")),";
//             $inupdate=  $this->db->query('update `material` set latest_out="'.$latest_out.'" ,total_balance =  "'.$bal.'", last_out_updated= "'.$last_out_updated.'"  where mid="'.$val1['name'].'" ');

//             $sql = substr($sql, 0, strlen($sql)-1);
//             $result = $this->db->query($sql);    
//                     if($result){
//                   return array("success" => true);
//                   } 
//                   else
//                   {
//                  return array("success" => false);
//                  }
//             }
     

//            else{
//             // echo 'sai';
//              // return array("success" => false,"data" => $bal1);
//               return array("success" => false);
//            } 
//            }
//     }

// }

     public function itemoutlist($data)
    {  
        $data1 = $data['active_list1'];

        $sum = array_reduce($data1, function ($a, $b) {
            isset($a[$b['name']]) ? $a[$b['name']]['quantity'] += $b['quantity'] : $a[$b['name']] = $b;
            return $a;
        });

        

 // print_r(array_values($sum));
foreach($sum as $s)
{
    // $qty=boolean;
   // echo $s['name'];
//   $p=0;
//     $item_history=array();
//     $itemdata= $this->db->query('SELECT * FROM `material` where mid="'.$s['name'].'" ORDER BY mid DESC limit 1')->row();
//     $item_history[$p]=$itemdata;
// $p++;
    $i=0;
       $quantity= $this->db->query('SELECT * FROM `material` where mid="'.$s['name'].'" ORDER BY mid DESC limit 1')->row();
           $bal12 = $quantity->total_balance;
           // echo $bal12.''.'ji';
           // echo $s['quantity'];
           // $name = $quantity->item;
            $item_history[$i] = $quantity->item.'---'.'Available Balance --'.$quantity->total_balance.' '.$quantity->units;
           // $avbal = $bal12;   
           if($bal12 >= $s['quantity'])
           {
            // echo 'test success';
            $qty = true;
            continue;
         
           }
           else
           {
            $qty = false;
            break;
           // echo 'test failed';
           }
 
}

        if($qty){
        $latest_out=0;
                
         $out_date1 = $data['out_date'];

        $active_list1 = $data['active_list1'];
        $type =$data['type'];
        $slot =$data['slot']; 
        $reg_no = $data['reg_no'];
                    

        for($j=0; $j<sizeof($active_list1); $j++) {
            $val1 = $active_list1[$j];
             $sql = "insert into stock_register(reg_no,item, quantity, edate,slot_type,trans_type,balance) values";
            $quantity= $this->db->query('SELECT * FROM `material` where mid="'.$val1['name'].'" ORDER BY mid DESC limit 1')->row();
          
             if($quantity){
                 $bal1 = $quantity->total_balance; 

            $bal = $quantity->total_balance - $val1['quantity'];
            $latest_out += $val1['quantity'];
            $last_out_updated = date('Y-m-d h:i:s');
            $sql .= "('$reg_no','" . $val1['name'] . "','" . $val1['quantity'] . "','$out_date1','$slot','$type',($bal1 - ".$val1["quantity"].")),";
            $inupdate=  $this->db->query('update `material` set latest_out="'.$latest_out.'" ,total_balance =  "'.$bal.'", last_out_updated= "'.$last_out_updated.'"  where mid="'.$val1['name'].'" ');

            $sql = substr($sql, 0, strlen($sql)-1);
            $result = $this->db->query($sql);  
         
         }


        } 
        return array("success" => true);
     }
     else
        {
        return array("success" => false, "data" => $item_history);
        }    
    }

 //get list for mess
     public function getlist(){
        
        $sql ="select * from material";
        $data=$this->db->query($sql);
        return $data->result();         
    }

    public function addnewitem($data)
    {
          $result = $this->db->query('SELECT item FROM material  where  item = "'.$data['item'].'" limit 1')->row();
        if($result){
             return array("success"=> false, $data);
        }else{
          $sql=$this->db->insert('material',$data);

          if($sql){
            return array("success"=> true);
        } 
        }
   
    }
      public function menulist($data)
    {
       $this->db->insert('menu_list',$data);
    }

    public function getmenulist(){
        
        $sql ="select * from menu_list";
        $data=$this->db->query($sql);
        return $data->result();         
    }
    public function updatelist($params)
    {
    $this->db->query('update menu_list set breakfast= "'.$params['breakfast'].'", lunch =  "'.$params['lunch'].'", snacks =  "'.$params['snacks'].'", dinner =  "'.$params['dinner'].'"  where id =  "'.$params['id'].'"');
     }



     public function stockRegister(){
      //  $result = $this->db->query('SELECT *, m.item,max(balance) as tot_balance , sum(price) as total_PRICE FROM stock_register s INNER join material m on m.mid=s.item GROUP by s.item order by balance')->result();
         $result = $this->db->query('SELECT s.*, m.item as item_name FROM stock_register s INNER join material m on m.mid=s.item   order by srid DESC ')->result();
        if($result){
            return array("success"=>true, "data"=>$result);
        }else{
            return array("success"=>false);
        }
    }

     public function stockBalance(){
      //  $result = $this->db->query('SELECT *, m.item,max(balance) as tot_balance , sum(price) as total_PRICE FROM stock_register s INNER join material m on m.mid=s.item GROUP by s.item order by balance')->result();
         $result = $this->db->query('SELECT * FROM  material order by item ASC ')->result();
        if($result){
            return array("success"=>true, "data"=>$result);
        }else{
            return array("success"=>false);
        }
    }

    public function getunits($params){
        // echo $params['mid'];
        
        $sql = 'select *  from material where mid = "'. $params['mid'] .'"';
        $data=$this->db->query($sql);
        return $data->result();         
    }
    public function updatematerialslist($params)
    {    
   $sql = $this->db->query('update material set item = "'.$params['item'].'", units =  "'.$params['units'].'", minvalue =  "'.$params['minvalue'].'" where mid =  "'.$params['mid'].'"');
   if($sql)
   {
    return array("success" => true);
   }
   else
   {
    return array("succses" => false);
   }

 //     }
  } 
  public function purchaserlist($data){
       $list = $data['list'];
   
   $sql = "insert into purchaser(mid,item,quantity,units) values";
        for($i=0; $i<sizeof($list); $i++) {
            $val = $list[$i];
           // if (strlen(trim($val['description'])) > 0) {
                $sql .= "('" . $val['mid'] . "','" . $val['item'] . "','" . $val['quantity'] . "','" . $val['units'] . "'),"; 
           //}
        }

        $sql = substr($sql, 0, strlen($sql)-1);

       if($this->db->query($sql))
       {
      return array("success" => true);
      }   
      else
      {
      return array("success" => false);
    }
  }
  public function deleteitem($params)
  {
    // $sql = 'delete from material where mid = "'. $params['mid'] .'"';
    // $data =  $this->db->query($sql);
    // return $data->result(); 
    $sql = $this->db->query('delete from material where mid = "'. $params['mid'] .'"');
    if($sql)
    {
        return array("success" => true);
    }

  }

    
}
?>
