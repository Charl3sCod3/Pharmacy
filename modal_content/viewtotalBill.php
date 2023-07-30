<?php 
include '../dbcon.php';
$gcdq = getSpActiveCustomer($c_id);
$gcdr = $gcdq->fetch_array();
$totalamount = getTotalAmmount($c_id);
if (!empty($gcdr['cphone'])) {
  $cphone = $gcdr['cphone'];
}else{
  $cphone = "&nbsp";
}

?>
<div class="modal-dialog modal-lg" style="font-size:30px !important;">
  <div class="modal-content bg-secondary">
    <div class="modal-header">
      <h4 class="modal-title">Payment Form</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
    </div>
    <form id="paynowbutton">
    <div class="modal-body">
      <div class="row">
        <div class="col-6">
          <div class="form-group">
            <p style="margin-bottom: 2px; font-size: 16px;">Customer Name: </p>
            <h5 style="background: #e9e9e9;padding: 2px;color:black;font-size:25px !important;"><?php echo $gcdr['cname'] ?></h5>
          </div>
        </div>
        <div class="col-6">
          <div class="form-group">
            <p style="margin-bottom: 2px; font-size: 16px;">Discount: </p>
            <select onchange="AddDiscount('<?php echo $totalamount ?>',this.value)" name="discount" id="discount" class="form-control select">
              <option value="0">N/A</option>
              <?php 
                $gd = getDiscounts();
                while ($gdr = $gd->fetch_array()) {
               ?>
               <option value="<?php echo $gdr[0] ?>"> <?php echo $gdr[2] ?></option>
             <?php } ?>
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-4">
            <div class="form-group">
            <p style="margin-bottom: 2px; font-size: 16px;">Total Amount: </p>
            <h5 style="background: #e9e9e9;padding: 2px;color:black;font-size:25px !important;" id="vb_total"><?php echo number_format($totalamount) ?></h5>
          </div>
        </div>
        <div class="col-4">
            <div class="form-group">
            <p style="margin-bottom: 2px; font-size: 16px;">Cash: </p>
            <input oninput="getthechangeis()" type="text" style="font-size:30px !important;padding: 5px;" name="customer_cash" id="customer_cash" totalamount="<?php echo $totalamount ?>" customer_id="<?php echo $c_id ?>" discount_id="0" class="form-control" autofocus>
          </div>
        </div>
        <div class="col-4">
            <div class="form-group">
            <p style="margin-bottom: 2px; font-size: 16px;">Change: </p>
            <h4 id="thechangehere" class="is-invalid" style="background-color: white;padding: 5px;border-radius: 5px;text-align: right;color:black">&nbsp</h4>
          </div>
        </div>
      </div>
      
    </div>
    <div class="modal-footer justify-content-between">
     &nbsp
    </div>
    </form>
  </div>
  <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->