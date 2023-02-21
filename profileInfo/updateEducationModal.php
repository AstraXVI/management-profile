<?php
    require "../db.php";

    $email = $_POST['email'];

    // GET EDUCATION UPDATE INFO
    $q = "SELECT * FROM `educationalbg` WHERE email='$email'";
    $list = $con->query($q);
    $educInfo = $list->fetch_assoc();
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

<!-- get user email -->
<input type="hidden" value="<?php echo $email ?>" id='userEmailProfile'>
<!--  -->
    <table class='table text-center'>
        <thead>
            <tr>
                <th>Level</th>
                <th width='300px'>Name of School</th>
                <th>Basic Education/Degree/Course</th>
                <th colspan='2'>Period of attendance <br><span class="me-5 text-secondary pe-2">From</span><span class="ms-5 ps-2 text-secondary">To</span></th>
                <th>Highest Level/Unit Earned</th>
                <th>Year Graduate</th>
                <th>Scholarship/Academic Honors Received</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Elementary</th>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['elemSchool'] ?>' id='Eschool'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['elemEduc'] ?>' id='Ecourse'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['elemFrom'] ?>' id='Efrom'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['elemTo'] ?>' id='Eto'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['elemHighLvl'] ?>' id='Ehigh'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['elemGraduate'] ?>' id='Eyear'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['elemScholar'] ?>' id='Escholar'></td>
            </tr>
            <tr>
                <th>Secondary</th>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['secSchool'] ?>' id='Sschool'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['secEduc'] ?>' id='Scourse'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['secFrom'] ?>' id='Sfrom'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['secTo'] ?>' id='Sto'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['secHighLvl'] ?>' id='Shigh'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['secGraduate'] ?>' id='Syear'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['secScholar'] ?>' id='Sscholar'></td>
            </tr>
            <tr>
                <th>Vocational/Trade course</th>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['vocSchool'] ?>' id='Vschool'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['vocEduc'] ?>' id='Vcourse'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['vocFrom'] ?>' id='Vfrom'></td>
                <td><input type="date" class="form-control" value='<?php echo $educInfo['vocTo'] ?>' id='Vto'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['vocHighLvl'] ?>' id='Vhigh'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['vocGraduate'] ?>' id='Vyear'></td>
                <td><input type="text" class="form-control" value='<?php echo $educInfo['vocScholar'] ?>' id='Vscholar'></td>
            </tr>
            <tr>
                <th>College</th>
                <td><input class="form-control" value='<?php echo $educInfo['schoolCollege'] ?>' type="text" id='Cschool'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeCourse'] ?>' type="text" id='CCourse'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeFrom'] ?>' type="date" id='CFrom'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeTo'] ?>' type="date" id='CTo'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeHigh'] ?>' type="text" id='CHigh'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeYear'] ?>' type="text" id='CYear'></td>
                <td><input class="form-control" value='<?php echo $educInfo['collegeScholar'] ?>' type="text" id='CScholar'></td>
            </tr>
            <tr>
                <th>Graduate Studies</th>
                <td><input class="form-control" type="text" value='<?php echo $educInfo['graduateStudies'] ?>' id='Gschool'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateCourse'] ?>' type="text" id='GCourse'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateFrom'] ?>' type="date" id='GFrom'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateTo'] ?>' type="date" id='GTo'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateHigh'] ?>' type="text" id='GHigh'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateYear'] ?>' type="text" id='GYear'></td>
                <td><input class="form-control" value='<?php echo $educInfo['graduateScholar'] ?>' type="text" id='GScholar'></td>
            </tr>
        </tbody>
    </table>
</body>
</html>