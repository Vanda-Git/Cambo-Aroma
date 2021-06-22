<?php include'../layout/header.php';?>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/> -->
 
 
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <br/>
      <h2>Stock Balance Report</h2>
      <hr/>
      <table id="example1" class="display table table-hover" style="width:100%">
        <thead>
        <tr>
          <th>Code</th>
          <th>Product</th>
          <th>TOTAL IN QTY</th>
          <th>TOTAL OUT QTY</th>
          <th>Balance QTY</th>
          <th>Status</th>
        </tr>
        </thead>
        <tbody>
          <?php
            $sql= " SELECT
            IFNULL(stk_in.in_qty,0) AS IN_QTY,
            IFNULL(stk_out.out_qty,0)+IFNULL(stk_m_out.out_qty,0) AS OUT_QTY,
            IFNULL(stk_m_out.out_qty,0) AS OUT_QTY_MEM,
            IFNULL(stk_in.in_qty,0)-(IFNULL(stk_out.out_qty,0)+IFNULL(stk_m_out.out_qty,0)) AS B_QTY,
            A.pr_code,
            A.pr_name
    FROM tbl_product AS A
    left join
        (
            select
            stk_in_d.product_id,
            sum(stk_in_d.qty) AS in_qty
            from tbl_stock_in_detail AS stk_in_d
            group by stk_in_d.product_id
        ) AS stk_in on A.pr_id = stk_in.product_id
    left join
        (
            select
            stk_out_d.product_id,
            sum(stk_out_d.qty) AS out_qty
            from tbl_stock_out_detail AS stk_out_d
            group by stk_out_d.product_id
        ) AS stk_out on A.pr_id = stk_out.product_id
    left join
        (
            select
            stk_out_m_d.product_id,
            sum(stk_out_m_d.qty) AS out_qty
            from tbl_stock_out_to_member_detail AS stk_out_m_d
            group by stk_out_m_d.product_id
        ) AS stk_m_out on A.pr_id = stk_m_out.product_id
            ";
            
            $result=$conn->query($sql);
            $status = "Normal";
            $status_class = "success";
            if($result->num_rows>0){
              while($row=$result->fetch_array()){
              if($row['B_QTY'] > 50){
                $status = "Normal";
                $status_class = "success";
              }
              else if($row['B_QTY'] > 20 && $row['B_QTY'] <= 50){
                $status = "Low Stock";
                $status_class = "warning";
              }
              else if($row['B_QTY'] <= 20 && $row['B_QTY'] > 0){
                $status = "Low Stock";
                $status_class = "danger";
              }
              else{
                $status = "Out of Stock";
                $status_class = "danger";
              }
              echo '<tr role="row" class="odd">
                      <td tabindex="0" class="sorting_1">'.$row['pr_code'].'</td>
                      <td>'.$row['pr_name'].'</td>
                      <td>'.$row['IN_QTY'].'</td>
                      <td>'.$row['OUT_QTY'].'</td>
                      <td>'.$row['B_QTY'].'</td>
                      <td><span class="btn btn-'.$status_class.' btn-xs">'.$status.'</span></td>
                    </tr>';
              }
            }
          ?>
        </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content --> 
  </div>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg" >
    
      <!-- Modal content-->
      <div class="modal-content" style="height:300px;padding:0px;">
        <div class="modal-body" style="height:300px;padding:0px;">
          <iframe src="gg" id="myframe" frameborder="0" style="width:100%;height:300px;"></iframe>
        </div>
      </div>
      
    </div>
  </div>
<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jszip-2.5.0/dt-1.10.22/af-2.3.5/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script> -->
<?php include'../layout/footer.php';?>
  <script>
    function show_modal(id){
      $('#myframe').attr('src', "info.php?id="+id)
      $('#myModal').modal('show');
    }

//     $(document).ready(function() {
//     $('#example').DataTable( {
//         dom: 'Bfrtip',
//         buttons: [
//             'copy', 'csv', 'excel', 'pdf', 'print'
//         ]
//     } );
// } );
  </script>
