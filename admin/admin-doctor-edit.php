<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
 
    <link rel="stylesheet" href="css/adminpage.css">
    <link href="css/doctoradmin.css" rel="stylesheet">
    <link href="css/admin-doctor-edit.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<?php include 'navbar/navbar.php';?>

  <div class="main-page" id="main-page">


    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
        </li>
        <li class="breadcrumbs-item">
          <a href="adminpage.html" class="breadcrumbs-link">Dashboard</a> 
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link">Doctor</a>
        </li>
        <li class="breadcrumbs-item">
          <a href="#" class="breadcrumbs-link active">Add Doctor</a>
        </li>
    
      </ul>
    </div>
    
    
    
        <div class="add-doctor" id="add-doctor" style="display: none;">
            <h1>ADD DOCTOR</h1>
            <form>
    
                <div class="input-row">
                    <div class="input-group">
                      <label>Fist Name</label>
                      <input type = "text" />
                    </div>
                
                    <div class="input-group">
                      <label>Last Name</label>
                      <input type="text" />
                    </div>
                  </div>
                  
                  <div class="input-row">
                    <div class="input-group">
                      <label>Gender</label>
                      <input type = "text" />
                    </div>
                
                    <div class="input-group">
                      <label>Mobile</label>
                      <input type="number" />
                    </div>
                  </div>
    
                  <div class="input-row">
                    <div class="input-group">
                      <label>Designation</label>
                      <input type = "text" />
                    </div>
                
                    <div class="input-group">
                      <label>Department</label>
                      <input type="number" />
                    </div>
                  </div>
    
                  <div class="input-row">
                    <div class="input-group">
                      <label>Date</label>
                      <input type = "date" />
                    </div>
                
                    <div class="input-group">
                      <label>Email</label>
                      <input type="email" />
                    </div>
                  </div>
    
                  <div class="input-row">
                    <div class="input-group">
                      <label>Password</label>
                      <input type = "password" />
                    </div>
                
                    <div class="input-group">
                      <label>Confirm</label>
                      <input type="password" />
                    </div>
                  </div>
    
                  <div class="input-row">
                    <div class="input-group">
                      <label>Adddress</label>
                      <input type = "text" />
                    </div>
                  </div>
    
                  <div class="input-row">
                    
                    <div class="input-group">
                        <label></label>
                        <input type = "submit" />
                      </div>
                  </div>
    
    
                </div>
    
    
            </form>
      
    
    
    
    
        <div class="container">
            <div class="table-content">
    
                
                    <div class="top-circle" ><button id="toggle-btn"class="circle"><i class="fa-solid fa-plus"></i></button>
                 
    
                <h2>Table admin to see doctors</h2>
                <b>
    
                    <div class="form__group">
                        <input type="text" class="form__input" id="gfg"
                            placeholder="Search the table for Doctor's Name, Major, or ID:" required="" />
                        <label for="name" class="form__label">Search the table for Doctor's Name, Major, or ID:</label>
                    </div>
    
                </b>
    
    
                <table class="tbl" id="filter">
                    <thead>
                        <tr>
                            <th>Doctor ID</th>
                            <th>Doctor Name</th>
                            <th>Doctor Email</th>
                            <th>Major</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-label="Doctor ID">0001</td>
                            <td data-label="Doctor Name">John Doe</td>
                            <td data-label="Doctor Email">example@gmail.com</td>
                            <td data-label="Major">Dentist</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Doctor ID">0002</td>
                            <td data-label="Doctor Name">Ronny Halabi</td>
                            <td data-label="Doctor Email">ronnydoctor@gmail.com</td>
                            <td data-label="Major">surgeon</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Doctor ID">0003</td>
                            <td data-label="Doctor Name">Taylor Eid</td>
                            <td data-label="Doctor Email">Taylor@gmail.com</td>
                            <td data-label="Major">Heart</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Doctor ID">0004</td>
                            <td data-label="Doctor Name">Eyad Saber</td>
                            <td data-label="Doctor Email">saber@gmail.com</td>
                            <td data-label="Major">Plastic</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Doctor ID">0005</td>
                            <td data-label="Doctor Name">Will Smith</td>
                            <td data-label="Doctor Email">willsmith@gmail.com</td>
                            <td data-label="Major">Scientist</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                        <tr>
                            <td data-label="Doctor ID">0006</td>
                            <td data-label="Doctor Name">Kevin Heart</td>
                            <td data-label="Doctor Email">kevinheart@gmail.com</td>
                            <td data-label="Major">OB/GYN</td>
                            <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                            <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
            </div>
        </div>
  </div>


</body>

</html>

<script>
    
    $(document).ready(function () {
        $("#gfg").on("keyup", function () {
            var value = $(this).val().toLowerCase();
            $("#filter tr").filter(function () {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });


    const toggle = document.getElementById('toggle-btn');
    const form = document.getElementById('add-doctor');

    toggle.addEventListener('click',() =>{
        if (form.style.display === "none") {
    form.style.display = "block";
  } else {
   form.style.display = "none";
  }
})


</script>

<!--SCRIPT FOR PIE CHART-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/chart.js"></script>
<script src="navbar/include.js"></script>