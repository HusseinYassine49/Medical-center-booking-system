<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  
  <link rel="stylesheet" href="../css/adminpage.css">
  <link rel="stylesheet" href="../css/adminsummary.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://kit.fontawesome.com/077562f806.js" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>

<body>

<?php include 'navbar.php';?>
  
  <div class="main-page" id="main-page">

    <div class="bread-container">
      <ul class="breadcrumbs">
        <li class="breadcrumbs-item">
          <a href="../../index.html" class="breadcrumbs-link"><i class="fa-solid fa-house"></i></a>     
        </li>
        <li class="breadcrumbs-item">
          <a href="adminpage.html" class="breadcrumbs-link active">Dashboard</a> 
        </li>
      </ul>
    </div>


    <div class="selection">
      <ul>
        <li class="active" id="doctor-btn">
          <label><i class="fa-solid fa-user-doctor"></i>
            <span>Doctor</span>
            <span>50</span>
          </label>
        </li>
        <li id="user-btn">
          <label><i class="fa-solid fa-user"></i>
            <span>User</span>
            <span>52</span>
          </label>
        </li>
        <li id="admin-btn">
          <label><i class="fa-solid fa-comment"></i>
            <span>Feedback</span>
          </label>
        </li>
      </ul>
    </div>

    <div class="bottom">
      <div class="summary-container">
        <div class="container">
          <h4>TABLE INFORMATION</h4>
          <div class="table-content">
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
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
                <tr>
                  <td data-label="Doctor ID">0002</td>
                  <td data-label="Doctor Name">Ronny Halabi</td>
                  <td data-label="Doctor Email">ronnydoctor@gmail.com</td>
                  <td data-label="Major">surgeon</td>
                  <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
                <tr>
                  <td data-label="Doctor ID">0003</td>
                  <td data-label="Doctor Name">Taylor Eid</td>
                  <td data-label="Doctor Email">Taylor@gmail.com</td>
                  <td data-label="Major">Heart</td>
                  <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
                <tr>
                  <td data-label="Doctor ID">0004</td>
                  <td data-label="Doctor Name">Eyad Saber</td>
                  <td data-label="Doctor Email">saber@gmail.com</td>
                  <td data-label="Major">Plastic</td>
                  <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
                <tr>
                  <td data-label="Doctor ID">0005</td>
                  <td data-label="Doctor Name">Will Smith</td>
                  <td data-label="Doctor Email">willsmith@gmail.com</td>
                  <td data-label="Major">Scientist</td>
                  <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
                <tr>
                  <td data-label="Doctor ID">0006</td>
                  <td data-label="Doctor Name">Kevin Heart</td>
                  <td data-label="Doctor Email">kevinheart@gmail.com</td>
                  <td data-label="Major">OB/GYN</td>
                  <td data-label="Edit"><Button class="btn-edit"><i class="fa-solid fa-pencil"></i></Button></td>
                  <td data-label="Delete"><Button class="btn-trash"><i class="fa-solid fa-trash"></i></Button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

      </div>

      <div class="donut-graph">
        <h2 class="chart-heading">Doctor Departments</h2>
        
        <div class="programming-stats">
          <div class="chart-container">
            <canvas class="my-chart"></canvas>
          </div><div class="details">
              <ul></ul>
            </div>
        </div>
            

      </div>



    </div>
  </div>

</body>

</html>




<script src="../js/include.js"></script>
<!-- Icon SCRIPT-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<!--SCRIPT FOR PIE CHART-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="../js/chart.js"></script>
