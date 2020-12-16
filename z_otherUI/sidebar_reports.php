<!DOCTYPE HTML>

<div class="sidebar" data-color="blue">

<!--   you can change the color of the sidebar using: data-color="blue | azure | green | orange | red | purple" -->


<div class="sidebar-wrapper">
    <div class="logo">
        <a class="simple-text">
            <?php echo $_SESSION['username'];  ?>
        </a>
    </div>

    <ul class="nav">
        <li class="active">
            <a href="reports.php">
              <i class="fas fa-chart-pie"></i>
                <p>Reports</p>
            </a>
        </li>
        <li>

            <a href="table.php">
                <i class="fad fa-clipboard"></i>
                <p>Product Lists</p>

            </a>

        <li>
            <a href="supplier_table.php">
                <i class="fad fa-dolly"></i>
                <p>Suppliers</p>
            </a>
        </li>
        <li>
            <a href="icons.php">
                <i class="fal fa-money-check-edit-alt"></i>
                <p>Sales</p>
            </a>
        </li>
        <li>
            <a href="ordersummary.php">
                <i class="fal fa-truck"></i>
                <p>Orders</p>
            </a>
        </li>
        <li>
            <a style="display:none;" href="notifications.html">
                <i class="pe-7s-bell"></i>
                <p>TEMP</p>
            </a>
        </li>
    </ul>
</div>
</div>
