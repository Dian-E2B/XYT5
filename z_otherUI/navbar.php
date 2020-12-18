<!DOCTYPE html>



<nav class="navbar navbar-default navbar-fixed">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                            data-target="#navigation-example-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" >Product Lists</a>
                    </div>
                    <div class="collapse navbar-collapse">
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-dashboard"></i>
                                    <p class="hidden-lg hidden-md">Dashboard</p>
                                </a>
                            </li>
                            <li class="dropdown">

                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification 1</a></li>
                                    <li><a href="#">Notification 2</a></li>
                                    <li><a href="#">Notification 3</a></li>
                                    <li><a href="#">Notification 4</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>

                            <!-- <li>
                                <form id="searchform" method="POST" action="tablesearch.php" >
                                  <input  id="myInput" name="thissearch" style="margin-top:10px;" class="form-control result" placeholder="Search Items">
                                </form>
                            </li>

                            <li>

                                <i style="border:0px;  font-size: 20px; padding:20px;" class="fa fa-search" aria-hidden="true" ></i>

                            </li> -->

                        </ul>

                        <ul class="nav navbar-nav navbar-right">

                            <li class="dropdown  ">
                                <a href="#" class="dropdown-toggle"  data-toggle="dropdown" >
                                    <p>
                                    <i class="fas fa-bars"></i>
                                            &nbsp;
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="./add_productform.php"><i style="font-size:16px;"class="fas fa-cubes"></i>&nbsp;Add Product</a></li>
                                    <li><a href="./add_supplierform.php"><i class="fas fa-parachute-box"></i>&nbsp;Add Supplier</a></li>
                                    <li><a href="./table1.php"><i style="font-size:20px;" class="fad fa-window-close"></i>&nbsp;Inactive Products</a></li>
                                    <li><a href="#">Temp</a></li>
                                    <li><a href="#">Temp</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Temp</a></li>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>

<!-- Bootstrap core JavaScript-->
<script src="assets/js/jquery-3.5.1.min.js" type="text/javascript"></script>
<script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
<!--  Charts Plugin -->
<script src="assets/js/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/bootstrap-notify.js"></script>

<!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
<script src="assets/js/light-bootstrap-dashboard.js"></script>
<!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>
<script>

var input = document.getElementById("myInput");
input.addEventListener("keyup", function(event) {
  if (event.keyCode === 13) {
   event.preventDefault();
   document.getElementById("myBtn").click();
  }
});
</script>
