<?php
session_start();
if (isset($_SESSION["isLogin"])) {
    include('connect.php');
    include('header.php');
    include('sidebar.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // $checkArray = implode(',', $_REQUEST['chekedSubjects']);
        $checkArray = $_REQUEST['id'];
        $sql = "DELETE FROM subjects where id in (" . $checkArray . ")";
        if ($conn->query($sql) === TRUE) {
            header('Location:subjects.php?msg=Data deleted Successfully.!');
        } else {
            header('Location:subjects.php?msg=Error in Data Deletion.!');
        }
    }
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Subjects</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                            <li class="breadcrumb-item active">Subjects</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <?php if (isset($_GET['msg'])) { ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                                        <?php echo $_GET['msg']; ?>
                                    </div>
                                <?php } ?>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form action="" method="post">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Delete</th>
                                                <th>subject_name</th>
                                                <th>subject_code</th>
                                                <th>Action&nbsp;&nbsp;
                                                    <a href='subject_add.php'>
                                                        <span style='color:green'>
                                                            <i class="fas fa-user-plus"></i>
                                                        </span></a>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $sql = "SELECT * FROM subjects";
                                            $result = $conn->query($sql);
                                            if ($result->num_rows > 0) {
                                                // output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>";
                                                    echo "<td><input type='checkbox' value=" . $row['id'] . " name='chekedSubjects[]' class='delete_check'></td>";
                                                    echo "<td>" . $row["subject_name"] . "</td>";
                                                    echo "<td>" . $row["subject_code"] . "</td>";
                                                    echo "<td><a href='subject_edit.php?id=" . $row['id'] . "'><span style='color:blue'><i class='fas fa-edit'></i></span></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-id='" . $row['id'] . "' href='javascript:;' data-toggle='modal' data-target='#exampleModalLong' class='delete_btn'><span style='color:red'><i class='fas fa-trash'></i></span></a></td>";

                                                }
                                            } else {
                                                echo "<tr><td colspan='10' align='center'>No Records Found.!</td></tr>";
                                            }
                                            $conn->close();
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Delete</th>
                                                <th>subject_name</th>
                                                <th>subject_code</th>
                                                <th>Action&nbsp;&nbsp;
                                                    <a href='subject_add.php'><span style='color:green'>
                                                            <i class="fas fa-user-plus"></i>
                                                        </span></a>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                    <a href='javascript:;' data-toggle='modal' data-target='#exampleModalLong'
                                        class='btn btn-primary delete_all_btn'>Delete</a>

                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Record Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="subjects.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="delete_id">
                        Are you sure you want to delete this record ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- /.content-wrapper -->
    <?php include('footer.php');
} else {
    header('Location:index.php?msg=Unauthorized Access.!');
}
?>