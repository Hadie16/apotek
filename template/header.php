<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="--" />
  <meta name="author" content="--" />
  <title>Mahabbah | Admin</title>
  <link rel="icon" type="image/png" href="../assets/img/logo_mahabbah.jpeg">
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css" />
  <link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet" /> 

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css"> -->
    <style>
        /* Your CSS styles for the loading animation here */

        /* Overlay to darken the page */
        .overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 998;
}

.loading-container {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 999;
    /* Remove the background-color, border, and padding properties */
}


.loading-spinner {
    border: 4px solid rgba(0, 0, 0, 0.3);
    border-top: 4px solid  #17a2b8; /* Blue color */
    border-radius: 50%;
    width: 40px;
    height: 40px;
    animation: spin 1s linear infinite;
}


@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}


/* .transition-effect {
  transition: opacity 2.3s ease;
} */


/* .dataTables_wrapper {
  transition: height 0.3s ease;
}

.dataTables_scrollHeadInner table {
  transition: opacity 0.3s ease;
} */

</style>

     <link rel="stylesheet" href="../css/custom.css">
  <link rel="stylesheet" href="../css/sb-admin-2.min.css">
  <link rel="stylesheet" href="../vendor/datatables/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../css/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../css/select2/dist/css/select2-bootstrap4.min.css">


  <!-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style>
  /* Dark theme styles */
  .ui-datepicker {
    background-color: #333;
    color: #fff;
  }
  .ui-datepicker-header {
    background-color: #555;
    color: #fff;
  }
  .ui-datepicker-calendar .ui-state-default {
    background-color: #555;
    color: #fff;
  }
  /* Add more custom styles as needed */
</style> -->




<!-- override select2 -->
<style>
/* Override the background color of the Select2 dropdown options with info color */
.select2-container--bootstrap4 .select2-results__option--highlighted,
.select2-container--bootstrap4 .select2-results__option--highlighted.select2-results__option[aria-selected="true"] {
  color: #fff;
  background-color: #17a2b8; /* Replace with your desired info color */
}


</style>

  <?php
          date_default_timezone_set('Asia/Makassar');
     ?>   
<!-- pagination color -->
<style> 
.pagination > li > a
{
    background-color: white;
    color: #5bc0de;
     /* purple color */
    /* color: #5A4181;  */
   

}

.pagination > li > a:focus,
.pagination > li > a:hover,
.pagination > li > span:focus,
.pagination > li > span:hover
{
    color: #5a5a5a;
    background-color: #eee;
    border-color: #ddd;
}

.pagination > .active > a
{
    color: white;
    background-color: #5bc0de !Important;
    border: solid 1px #5bc0de !Important;
}

.pagination > .active > a:hover
{
    background-color: #5bc0de !Important;
    border: solid 1px #5bc0de;
}
</style>


  <!-- Tempus Dominus CSS -->
<!-- <link rel="stylesheet" href="path/to/tempusdominus-bootstrap-4.min.css"> -->

  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"> -->


  <!-- datatables -->
   <!-- DataTables CSS -->
   <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.2/css/jquery.dataTables.css"> -->
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

    <!-- <style>
        .dt-buttons {
            text-align: center;
        }
    </style> -->


<style>
  /* delete ss in accordionSidebar to activated */

#accordionSidebarss {
  max-height: 100vh; /* Set a maximum height for the sidebar container */
  overflow-y: auto; /* Enable vertical scrolling */
  overflow-x: hidden; /* Hide horizontal scrolling */

}

@media (max-width: 992px) {
  #accordionSidebarss {
    max-height: calc(100vh - 56px); /* Adjust the maximum height for smaller screens (accounting for header height) */
  }
}


</style>



  <style>
/* added code 19-07-23 */
/* .sidebar-scroll {
  height: 100%;
  overflow-y: auto;
} */
/* end added code */
 
/* sidebar scroll */
    .sidebar-scroll{
      height: 100vh;
      /* width: 100px; */
      /* height: 100vh; */

/* padding-right: 220px; keep comment*/
      /* overflow-y: scroll; */
      overflow-y: hidden;
      overflow-x: hidden;
      transition: width 0.3s ease;
      
     position: sticky;
     top:0;

      /* white-space: nowrap; keep comment */
    }

    .sidebar-scroll:hover {
  overflow-y: auto;
}


/* .sidebar-scroll::-webkit-scrollbar { */
  /* width: 8px; */
   /* Adjust the width of the scrollbar */
/* } */
/* .sidebar-scroll::-webkit-scrollbar-thumb { */
  /* background-color: #888;  */
  /* Set the color of the scrollbar thumb */
  /* border-radius: 4px;  */
  /* Set the border radius of the thumb */
/* }
::-webkit-scrollbar-track {
  background-color: #f1f1f1;
} */

/* .sidebar-scroll::-webkit-scrollbar-thumb:hover {
  background-color: #555; /* Set the color of the thumb on hover */
/* }  */

  </style>
          <style>
  /* Custom CSS to make checkbox input bigger */
  .form-check-input[type="checkbox"] {
    width: 20px;
    height: 20px;
  }
</style>
<!-- button test effect -->
<style>
/* hr {
  position: relative;
  border: none;
  border-top: 1px solid #000;
  margin: 20px 0;
}

.line-text {
  background-color: #fff;
  padding: 0 10px;
} */

</style>

<!-- load animation -->
<!-- <style>
  #loader{
    display: none; 
    border: 16px solid #f3f3f3; /* Light gray border */
  border-top: 16px solid #3498db; /* Blue border on top */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite; /* Animation for rotation */
  margin: 0 auto; /* Center the loader */
  }
  .loader {
  
  border: 16px solid #f3f3f3; /* Light gray border */
  border-top: 16px solid #3498db; /* Blue border on top */
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite; /* Animation for rotation */
  margin: 0 auto; /* Center the loader */
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

</style> -->

<!-- darkmode toggle -->
<!-- <style>
  body {
  background-color: #f4f4f4;
  color: #333;
  transition: background-color 0.3s, color 0.3s;
}

.container {
  text-align: center;
  margin-top: 20%;
}

/* Toggle switch styles */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  transition: 0.4s;
  border-radius: 34px;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  transition: 0.4s;
  border-radius: 50%;
}

</style> -->


<style>
.button-container {
    display: inline-flex;
    border-radius: 30px; /* Adjust the border-radius to control the capsule shape */
    overflow: hidden;
    transition: background-color 0.3s;
  }

  .toggle-button {
    padding: 10px 20px;
    background-color: gray;
    color: white;
    cursor: pointer;
    border: none;
    border-radius: 0; /* Remove button border radius */
  }

  /* .toggle-button:hover {
    background-color:  #f0ad4e;
  }

  .activee {
    background-color:  #f0ad4e;
  } */
</style>



</head>