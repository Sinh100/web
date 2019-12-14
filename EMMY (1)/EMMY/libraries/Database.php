

<?php 

    /**
    * 
    */
    class Database
    {
        /**
         * Khai báo biến kết nối
         * @var [type]
         */
        public $link;

        public function __construct()
        {
            $this->link = mysqli_connect("localhost","root","","emmy") or die ();
            mysqli_set_charset($this->link,"utf8");
        }

        

        /**
         * [insert description] hàm insert 
         * @param  $table
         * @param  array  $data  
         * @return integer
         */
        public function insert($table, array $data)
        {
            //code
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',', array_keys($data));
            $values  = "";
            $sql .= '(' . $columns . ')';
            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $values .= "'". mysqli_real_escape_string($this->link,$value) ."',";
                } else {
                    $values .= mysqli_real_escape_string($this->link,$value) . ',';
                }
            }
            $values = substr($values, 0, -1);
            $sql .= " VALUES (" . $values . ')';
            // _debug($sql);die;
            mysqli_query($this->link, $sql) or die("Lỗi  query  insert ----" .mysqli_error($this->link));
            return mysqli_insert_id($this->link);
        }

        public function update($table, array $data, array $conditions)
        {
            $sql = "UPDATE {$table}";

            $set = " SET ";

            $where = " WHERE ";

            foreach($data as $field => $value) {
                if(is_string($value)) {
                    $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\',';
                } else {
                    $set .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ',';
                }
            }

            $set = substr($set, 0, -1);


            foreach($conditions as $field => $value) {
                if(is_string($value)) {
                    $where .= $field .'='.'\''. mysqli_real_escape_string($this->link, xss_clean($value)) .'\' AND ';
                } else {
                    $where .= $field .'='. mysqli_real_escape_string($this->link, xss_clean($value)) . ' AND ';
                }
            }

            $where = substr($where, 0, -5);

            $sql .= $set . $where;
             // _debug($sql);die;

            mysqli_query($this->link, $sql) or die( "Lỗi truy vấn Update -- " .mysqli_error());

            return mysqli_affected_rows($this->link);
        }
        public function updateview($sql)
        {
            $result = mysqli_query($this->link,$sql)  or die ("Lỗi update view " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);

        }
        public function countTable($table)
        {
            $sql = "SELECT id FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

         public function countTable_categorySort($table,$table1,$id_loai)
        {
            $sql = "select * from {$table} LEFT JOIN {$table1} on {$table}.maloai = {$table1}.id_loai WHERE {$table}.maloai=$id_loai";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

           public function countTable_search($table,$table1,$tukhoa)
        {
            $sql = "SELECT * from sanpham,loaisanpham WHERE  tensp like N'%$tukhoa%' AND sanpham.maloai = loaisanpham.id_loai";
            
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
             // _debug($num);die;
            return $num;
        }



        public function countTable_category_blog($table)
        {
            $sql = "SELECT id_dm FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

        public function countTable_category($table)
        {
            $sql = "SELECT id_loai FROM  {$table}";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

        public function countTable_hinhanh($table)
        {
            $sql = "SELECT hinhID FROM  {$table} where status = 1";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }
        public function countTable_hoadon($table)
        {
            $sql = "SELECT maHD FROM  {$table} WHERE status = 1";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }
        public function countTable_hoadonngay($table,$day1)
        {
            $sql = "SELECT maHD FROM  {$table} WHERE status = 1 and {$table}.ngaylap = '$day1' ";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

        public function countTable_danhsach_hoadon($table)
        {
            $sql = "SELECT ma_HD FROM  {$table} WHERE   {$table}.status =1  ";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

         public function countTable_detail($table,$ma_HD)
        {
            $sql = "SELECT id FROM  {$table} where status = 1 and ma_HD = $ma_HD";
            $result = mysqli_query($this->link, $sql) or die("Lỗi Truy Vấn countTable----" .mysqli_error($this->link));
            $num = mysqli_num_rows($result);
            return $num;
        }

        /**
         * [delete description] hàm delete
         * @param  $table      [description]
         * @param  array  $conditions [description]
         * @return integer             [description]
         */
        public function delete ($table ,  $id )
        {
            $sql = "DELETE FROM {$table} WHERE id = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }
         public function delete_hoadon ($table ,  $id )
        {
            $sql = "DELETE FROM {$table} WHERE maHD = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }


        public function deletecategory ($table ,  $id ) /* >0 xóa thành công <0 xóa thất cbại*/
        {
            $sql = "DELETE FROM {$table} WHERE id_loai = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        public function deleteblog ($table ,  $id ) /* >0 xóa thành công <0 xóa thất cbại*/
        {
            $sql = "DELETE FROM {$table} WHERE id_dm = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }
        public function deletehinh ($table ,  $id ) /* >0 xóa thành công <0 xóa thất cbại*/
        {
            $sql = "DELETE FROM {$table} WHERE hinhID = $id ";

            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        /**
         * delete array 
         */
        
        public function deletewhere($table,$data = array())
        {
            foreach ($data as $id)
            {
                $id = intval($id);
                $sql = "DELETE FROM {$table} WHERE id = $id ";
                mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            }
            return true;
        }

         public function delete_cthoadon($table,$data = array())
        {
            foreach ($data as $id)
            {
                $id = intval($id);
                $sql = "DELETE FROM {$table} WHERE ma_HD = $id ";
                mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            }
            return true;
        }

        public function fetchsql( $sql )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn sql " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        } 

        public function fetchID_mahoadon($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE ma_HD = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

         public function fetchID_macthoadon($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE id = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

         public function fetchID_hoadon($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE maHD = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function fetchID($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE id = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchID " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }


        public function fetchIDloai($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE id_loai = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchIDloai " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function fetchIDblog($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE id_dm = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchIDblog " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function fetchIDhinhanh($table , $id ) // lấy tất cả các sản phẩm có id mình chuyền vào
        {
            $sql = "SELECT * FROM {$table} WHERE hinhID = $id ";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchIDblog " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

       
        public function fetchOne($table , $query)
        {
            $sql  = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $sql .= "LIMIT 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi  truy vấn fetchOne " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function deletesql ($table ,  $sql )
        {
            $sql = "DELETE FROM {$table} WHERE " .$sql;
            // _debug($sql);die;
            mysqli_query($this->link,$sql) or die (" Lỗi Truy Vấn delete   --- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        

         public function fetchAll($table)/* chuyền vào tên bảng sẽ lấy hết dữ liệu của bảng */
        {
            $sql = "SELECT * FROM {$table} WHERE 1" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

         public function fetchAll_sp($table)/* chuyền vào tên bảng sẽ lấy hết dữ liệu của bảng */
        {
            $sql = "SELECT * FROM {$table} WHERE 1=1 order by id DESC" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

          public function fetchAll_category($table)/* chuyền vào tên bảng sẽ lấy hết dữ liệu của bảng */
        {
            $sql = "SELECT * FROM {$table} WHERE trangthai = 1" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

         public function fetchcountnumber($table)
         {
            $sql = "SELECT COUNT(*) as SL FROM {$table}" ;
            $result = mysqli_query($this->link,$sql) or die("Lỗi Truy Vấn fetchAll " .mysqli_error($this->link));
            $data = [];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
         }

    
        public  function fetchJones($table,$sql,$total = 1,$page,$row ,$pagi = true )
        {
            
            $data = [];

            if ($pagi == true )
            {
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row ";
                $data = [ "page" => $sotrang];
              
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            
            return $data;
        }
         public  function fetchJone($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }

         public  function fetchJone_categorySort($table,$table1,$id_loai,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_categorySort($table,$table1,$id_loai);

                $sotrang = ceil($total / $row);

                $start = ($page - 1 ) * $row ;
                
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
                // _debug($result);die();
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             
            return $data;
        }

         public  function fetchJone_search($table,$table1,$tukhoa,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_search($table,$table1,$tukhoa);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             
            return $data;
        }




         public  function fetchJone_category_blog($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_category_blog($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }



         public  function fetchJone_category($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_category($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            // _debug($result);die();
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             
            return $data;
        }
         public  function fetchJone_hoadon($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_hoadon($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }

         public  function fetchJone_hoadonngay($table,$sql,$day1 ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_hoadonngay($table,$day1);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }


         public  function fetchJone_danhsach_hoadon($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_danhsach_hoadon($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }

        public  function fetchJone_chitiet($table,$ma_HD,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_detail($table,$ma_HD);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }

         public  function fetchJone_hinhanh($table,$sql ,$page = 0,$row ,$pagi = false )
        {
            
            $data = [];
           
            if ($pagi == true )
            {
                $total = $this->countTable_hinhanh($table);
                $sotrang = ceil($total / $row);
                $start = ($page - 1 ) * $row ;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];
               
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));
            }
            
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
             // _debug($data);die();
            return $data;
        }


        public  function fetchJoneDetail($table , $sql ,$page = 0,$total ,$pagi )
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone ---- " .mysqli_error($this->link));

            $sotrang = ceil($total / $pagi);
            $start = ($page - 1 ) * $pagi ;
            $sql .= " LIMIT $start,$pagi";

            $result = mysqli_query($this->link , $sql);
            $data = [];
            $data = [ "page" => $sotrang];
            if( $result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function total($sql)
        {
            $result = mysqli_query($this->link  , $sql);
            $tien = mysqli_fetch_assoc($result);
            return $tien;
        }


        //Thực thi chuổi truy vấn
      

       

       
    }
   
?>