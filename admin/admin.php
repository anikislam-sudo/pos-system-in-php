<?php include "includes/header.php" ?>

<div class="container-fluid px-4">
<div class="card mt-4 shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Admin/Staff
            <a href="admin-create.php" class="btn btn-primary float-end">ADD ADMIN</a>
        </h4>
    </div>
    <div class="card-body">
    <?php alert();?>
    <?php 
                $admins=getAllData('admins');
                if(!$admins){
                echo'<h4>Something went wrong</h4>';
                return false;
                }
                if(mysqli_num_rows($admins)> 0){
                    
                

                ?> 
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
             <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
             </thead>
             <tbody>
              
                <?php foreach($admins as $adminItem): ?>
                <tr>
                    <td><?=$adminItem['id']?></td>
                    <td><?=$adminItem['name']?></td>
                    <td><?=$adminItem['email']?></td>
                    <td>
                        <a href="admin-edit.php" class="btn btn-success btn-sm">Edit</a>
                        <a href="admin-delete.php" class="btn btn-danger btn-sm">Delete</a>
                    </td>
           
             </tr>
             <?php endforeach; ?>
             
             </tbody>
            </table>
        </div>
        <?php
            }
            else{
                ?>
             <h4 class="mb-0">No Record Found</h4>
             <?php
            }
            ?>
    </div>
</div>

</div>

<?php include("includes/footer.php") ?>