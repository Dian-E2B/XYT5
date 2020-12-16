<!DOCTYPE HTML>
<!-- Modal content-->
<?php include 'z_execute/connection.php' ?>
<div id="Addproduct" class="modal fade" data-backdrop="true">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Details</h4>
            </div>
            <div class="modal-body">
                <div class="content">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>Supplier</label>
                                    <input type="text" class="form-control" disabled placeholder="Company"
                                        value="Creative Code Inc.">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" class="form-control" placeholder="Remarks">
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-3">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>Status</label>
                                    <input type="text" class="form-control" placeholder="Remarks">
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>Price Per Unit</label>
                                    <input type="text" class="form-control" placeholder="City" value="1000?">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>Priced</label>
                                    <input type="text" class="form-control" placeholder="Country" value="unit">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div style="margin-bottom: 5px;" class="form-group">
                                    <label>SKU</label>
                                    <input type="text" class="form-control" placeholder="ZIP Code">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea rows="5" class="form-control" placeholder="Here can be your description"
                                        value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info btn-fill pull-right">Update
                            Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>

            </div>
        </div>

    </div>
</div>