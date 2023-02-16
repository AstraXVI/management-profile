<?php 
    require "db.php";

    $id = $_POST['id'];

    $q = "SELECT * FROM `schools` WHERE id='$id'";

    $list = $con->query($q);
    $fetch = $list->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <input type="hidden" id='idEditSchool' value='<?php echo $fetch['id'] ?>'>
    <div class="form-floating mb-3">
        <input type="text" value='<?php echo $fetch['school_name'] ?>' class="form-control" id="inputSchoolNameEdit" placeholder="School Name" disabled>
        <label for="floatingInput">School Name</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" value='<?php echo $fetch['school_id'] ?>' class="form-control" id="inputSchoolIDEdit" placeholder="School ID">
        <label for="floatingInput">School ID</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" value='<?php echo $fetch['contact_person'] ?>' class="form-control" id="inputContactPersonEdit" placeholder="Contact Person">
        <label for="floatingInput">Contact Person</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" value='<?php echo $fetch['contact_no'] ?>' class="form-control" id="inputContactNoEdit" placeholder="Contact No">
        <label for="floatingInput">Contact No</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" value='<?php echo $fetch['email'] ?>' class="form-control" id="inputEmailEdit" placeholder="Email">
        <label for="floatingInput">Email</label>
    </div>
    
    <label class='mt-2 mb-2 ps-2'>Division</label>
    <select class="form-select" aria-label="Default select example" id='inputDivisionEdit'>
        <option class='bg-primary' value="<?php echo $fetch['division'] ?>"><?php echo $fetch['division'] ?></option>
        <option value="DCS-Valenzuela">DCS-Valenzuela</option>
    </select>

    <label class='mt-3 mb-2 ps-2'>School Type</label>
    <select class="form-select" aria-label="Default select example" id='inputSchoolTypeEdit'>
        <option class='bg-primary' value="<?php echo $fetch['school_type'] ?>"><?php echo $fetch['school_type'] ?></option>
        <option value="Public">Public</option>
        <option value="Private">Private</option>
    </select>

    <label class='mt-3 mb-2 ps-2'>Grade/Level</label>
    <select class="form-select" aria-label="Default select example" id='inputSchoolLevelEdit'>
        <option class='bg-primary' value="<?php echo $fetch['level'] ?>"><?php echo $fetch['level'] ?></option>
        <option value="Elementary School">Elementary School</option>
        <option value="High School">High School</option>
    </select>

    <label class='mt-3 mb-2 ps-2'>District</label>
    <select class="form-select" aria-label="Default select example" id='inputDistrictEdit'>
        <option class='bg-primary' value="<?php echo $fetch['district'] ?>"><?php echo $fetch['district'] ?></option>
        <option value="Congressional I">Congressional I</option>
        <option value="Congressional II">Congressional II</option>
        <option value="South">South</option>
        <option value="North">North</option>
        <option value="East">East</option>
        <option value="Central">Central</option>
    </select>
</body>
</html>