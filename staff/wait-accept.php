<?php
include("includes/head.php");
?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php include('includes/sidebar.php'); ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('includes/topbar.php'); ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Danh sách bán hàng</h1>
                        <a href="" id="export" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Xuất báo cáo bán</a>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label>
                                                <select id="status" class="custom-select custom-select-sm form-control form-control-sm">
                                                    <option value="" selected>Tìm theo trạng thái</option>
                                                    <option value="Chưa tiếp nhận">Chưa tiếp nhận</option>
                                                    <option value="Hoàn thành">Hoàn thành</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_length">
                                            <label style="display:inline-block">
                                                Tìm theo giá
                                                <input type="number" step="100000" class="form-control form-control-sm" id="minp">
                                                đến
                                                <input type="number" step="100000" class="form-control form-control-sm" id="maxp">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Tên</th>
                                            <th>Địa chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Thời gian đặt</th>
                                            <th class="noExp">Chi tiết</th>
                                            <th>Duyệt đơn</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM donhang WHERE STATUS = 0";
                                        $result = DataProvider::executeQuery($sql);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            switch ($row['STATUS']) {
                                                case 0:
                                                    $trangthai = "Chưa tiếp nhận";
                                                    break;
                                                case 1:
                                                    $trangthai = "Hoàn thành";
                                                    break;
                                                default:
                                                    $trangthai = "Chưa tiếp nhận";
                                            }
                                            ?>
                                                <tr id="<?php echo $row['MADH']; ?>">
                                                    <td><?php echo $row['NAME']; ?></td>
                                                    <td><?php echo $row['ADDRESS']; ?></td>
                                                    <td><?php echo $row['PHONE']; ?></td>
                                                    <td><?php echo $row['TONGTIEN']; ?></td>
                                                    <td><?php echo $row['NGAYDH']; ?></td>
                                                    <td class="noExp"></td>
                                                    <td style="display:flex"></td>
                                                </tr>

                                            <?php } ?>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('includes/footer.php'); ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
    
    <!--Activation Modal -->
    <div class="modal fade" id="activationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Xác nhận duyệt đơn hàng này ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="submit-active">Duyệt</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Thoát</button>
                </div>
            </div>
        </div>
    </div>


    <?php
    include('ordermodal.php');
    include('alertModal.php');
    include('includes/scroll-logout.php');
    include('includes/scripts.php')
    ?>
    <!-- Page level plugins -->
    <script src="vendor/jquery/jquery.table2excel.js"></script>
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        var manv = "<?php echo $re['IDUSER'];?>";
        $('#dataTable').dataTable({
            "columnDefs": [{
                    "orderable": false,
                    "targets": [5, 6]
                },
                {
                    "targets": 5,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-primary m-1 ct">Chi tiết</button>'
                },
                {
                    "targets": -1,
                    "data": null,
                    "defaultContent": '<button class="btn btn-outline-info m-1 activation"><i class="fa fa-check"></i></button>'
                }
            ]
        });
        $('#dataTable tbody').on('click', '.ct', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('id');
            var x = {
                'action-dh': 'select-detail',
                'id': id,
                
            };


            console.log(JSON.stringify(x));
            $.ajax({
                type: "POST",
                url: "handler.php",
                data: x,
                success: function(results) {
                    $('#detailz tbody').html(results);
                }
            });
            $("#ordermodal").modal("show");
            e.preventDefault();
        });

        $('#dataTable tbody').on('click', '.activation', function(e) {
            var selector = $(this).closest('tr');
            var id = selector.attr('id');


            //console.log(JSON.stringify(x));
            // $.ajax({
            //     type: "POST",
            //     url: "handler.php",
            //     data: x,
            //     success: function(results) {
                    
            //     }
            // });
            $("#activationModal").modal("show");
            $('#activationModal').on('click', '#submit-active', function(e) {
                    $.ajax({
                        type: "POST",
                        url: "handler.php",
                        data: {
                            'order-action': 'add',
                            'id': id,
                            'manv': manv
                        },
                        success: function(response) {
                            
                            if(response == 0) {
                                $('#alertModal .modal-body p').html("Số lượng sản phẩm không đủ để bán ! <br> Chờ quản lý kho nhập thêm hàng");
                                $('#alertModal').modal('show');
                            } else {
                                $('#dataTable').DataTable().row(selector).remove().draw(false);
                            }
                            $("#activationModal").modal("hide");
                        },
                        error: function(jqXHR, textStatus, errorThrown) {

                            alert("Duyệt thất bại");

                        }
                    });
                });
            e.preventDefault();
        });

        //export report
        $("a#export").click(function() {
            $("#dataTable").table2excel({
                // exclude CSS class
                name: "Worksheet Name",
                exclude: ".noExp",
                filename: "DS_hoadon_ban", //do not include extensi
                fileext: ".xls", // file extension
                exclude_img: true,
                exclude_links: true,
                exclude_inputs: true,
            });
        });
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            $('#status').on('change', function() {
                table.columns(6).search(this.value).draw();
            });
        });
        /* Custom filtering function which will search data in column four between two values */
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = parseInt($('#minp').val(), 10);
                var max = parseInt($('#maxp').val(), 10);
                var price = parseFloat(data[3]) || 0; // use data for the age column

                if ((isNaN(min) && isNaN(max)) ||
                    (isNaN(min) && price <= max) ||
                    (min <= price && isNaN(max)) ||
                    (min <= price && price <= max)) {
                    return true;
                }
                return false;
            }
        );
        $(document).ready(function() {
            var table = $('#dataTable').DataTable();

            // Event listener to the two range filtering inputs to redraw on input
            $('#minp, #maxp').change(function() {
                table.draw();
            });
            $('#minp, #maxp').keyup(function() {
                table.draw();
            });
        });
    </script>

</body>
<style>
    .ct {
        padding: 0.1rem 0.1rem;
    }
</style>

</html>