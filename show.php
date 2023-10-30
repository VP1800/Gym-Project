<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enquiry list</title>
    <link rel="stylesheet" href="CSS/w3.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="CSS/w3schools.com_w3css_4_w3.css">
    <link rel="stylesheet" href="CSS/FONT/font-awesome.min.css">

    <?php include 'nav.php'; ?>
    <style>
    table, td, th {
  border: 0.5px solid #E5E4E2;
  text-align: center;
}
body{
  background: linear-gradient(rgba(0,0,0,0.6),rgba(0,0,0,0.2)), url("image/show.jpeg");
  background-size:cover;
  background-repeat: no-repeat;
  background-attachment: fixed;
  font-family: Arial, Helvetica, sans-serif;
  font-size: 17px;
}
h1{
  text-align: center;
  font-family: Arial, Helvetica, sans-serif;
  margin-top: 70px; 
}
table {
  width: 100%;
  border-collapse: collapse;
  border-radius: 0.5px;
}
table tbody tr:nth-child(odd){
      background: white;  
}
table tbody tr:nth-child(even){
      background: #dddddd;
      border-bottom: 1px solid #b4b4b4;
      border-top: 1px solid #b4b4b4;
}
#DataTables_Table_0_filter{
  margin-bottom: 14px;
  margin-top: 10px;
}
#DataTables_Table_0_length{
  margin-bottom: 14px;
  margin-top: 10px;
}
.container-fluid{
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}
.h_name
{
  position: sticky;
  top:0;
  text-shadow: 8px 6px 8px black;
  color: white;
  font-weight: 600;
}
.w3-card{
  border-radius: 0.35rem;
  background: #dddddd;
}
tr{
  background: black; 
  color: #f2f2f2;
}
td{
  color: black;
}
.fa-trash{
  color: red;
}
.fa-share{
  color: green;
}

a{
    text-decoration: none;
}
.dataTables_wrapper .dataTables_filter input {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    margin-left: 3px;
}
.dataTables_wrapper .dataTables_length select {
    border: 1px solid #aaa;
    border-radius: 3px;
    padding: 5px;
    background-color: white;
    padding: 4px;
}

</style>
</head>

<body>
    <h1 class="h_name" style="text-align: center;">Enquiries</h1>
    <div class="container-fluid">
        <div class="w3-card w3-padding w3-margin">
            <div style="overflow-x: auto;">
                <table class="table table-striped" style="border-color:#e5e4e2">
                    <thead>
                        <tr>
                            <th>Sr.No.</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Reference No.</th>
                            <th>Enquiry Type</th>



                            <!-- Add other table headers here -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="Elist">
                        <?php
                        require_once("Database/connection.php");
                        // Your database query logic here
                        // $query = "SELECT * FROM `enquiry_master` ORDER BY updated_at DESC";
                        $query = "SELECT `enquiry_master`.*,COALESCE(`membership_form`.m_id, 0) as m_id FROM `enquiry_master` 
                        left join membership_form ON
                        enquiry_master.e_id=membership_form.e_id order by `enquiry_master`.`updated_at` desc";
                        $result = mysqli_query($connection, $query);

                        // $querym = "SELECT m_id from membership_form";
                        // $resultm = mysqli_query($connection, $querym);
                        // $rowm = mysqli_fetch_assoc($resultm);
                        $count = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Your data processing logic here
                            if($row["work"]==0){$row["work"]=null;}
                            if($row["telephone"]==0){$row["telephone"]=null;}
                            $flg = false;
                            $tmp = true;
                            if ($row["type"] == "Enquiry") {
                                $flg = true;
                            }
                            if ($row["m_id"] != 0) {
                                $tmp = false;
                            }
                            // if(rowm['e_id'] && row['e_id']]){$tmp = true;}
                        ?>
                            <tr>
                                <td><?php echo ++$count; ?></td>
                                <td><?php echo $row["name"]; ?></td>
                                <td><?php echo $row["gender"]; ?></td>
                                <td style="width: 5%;">
                                    <?php echo $row["contact"]; ?>
                                    <?php echo $row["work"]; ?>
                                    <?php echo $row["telephone"]; ?>
                                </td>
                                <td style="width: 5%;">
                                    <?php echo $row["email"]; ?>
                                    <?php echo $row["alternate_email"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["refno1"]; ?><br>
                                    <?php echo $row["refno2"]; ?>
                                </td>
                                <td><?php echo $row["type"]; ?></td>                                
                           
                                <td>
                                <a href="enquiry_update.php?e_id=<?php echo $row['e_id'];?>">
                                        <i class="fa fa-edit" title="Update Record" style="font-size:20px; color:blue; cursor: pointer;"></i>
                                </a> &nbsp
                                    <a onclick="confirmDelete(<?php echo $row['e_id']; ?>)" hidden>
                                        <i class="fa fa-trash" title="Delete Record" style="font-size:20px; color:red; cursor: pointer;"></i>
                                    </a>&nbsp
                                    
                                    <?php if ($flg == true && $tmp ==true): ?>
                                        <a onclick="membership(<?php echo $row['e_id']; ?>)" id="type">
                                        <i class="fa fa-share" title="Convert to membership" style="font-size:20px; color:green; cursor: pointer;"></i>
                                        </a>
                                    <?php elseif ($flg == true && $tmp ==false): ?>
                                        <a onclick="showmembers(<?php echo $row['e_id']; ?>)" id="type">
                                        <i class="fa fa-check" title="Already a member" style="font-size:20px; color:gray; cursor: pointer;"></i>
                                        </a>
                                    <!-- <?php //elseif($tmp == true):?>
                                        <a onclick="" id="type">
                                        <i class="fa fa-check" title="You are already a member!" style="font-size:20px; color:red; cursor: pointer;"></i>
                                        </a> -->
                                    <?php else:?>
                                        <a onclick="staff()" id="type">
                                        <i class="fa fa-close" title="Sorry! Staff cann't convert to membership" style="font-size:20px; color:red; cursor: pointer;"></i>
                                        </a>

                                    <?php endif; ?>
                                   

                                   

                                </td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Your scripts here -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.table').DataTable();
        });

        function confirmDelete(e_id) {
            const response = confirm("Are you sure you want to delete this record?");
            if (response) {
                window.location.href = 'Ajax/delete.php?id=' + e_id;
            }
        }

        function membership(e_id) {
            const response = confirm("Convert to membership");
            if (response) {
                // Add your membership logic here
                window.location.href = 'membership_form.php?e_id=' + e_id;
            }
        }
        function showmembers(e_id) {
            const response = confirm("Already a member");
            if (response) {
                // Add your membership logic here
                window.location.href = 'showmembers.php';
            }
        }
        function staff() {
                alert("Sorry! Staff can't be converted to member!");
        }

    </script>
</body>

</html>
