<form method="get" class="mb-4">
<div class="row">
<div class="col-md-3">
<input type="date" name="start_date" class="form-control" value="<?php echo $this->input->get('start_date'); ?>">
</div>

<div class="col-md-3">
<input type="date" name="end_date" class="form-control" value="<?php echo $this->input->get('end_date'); ?>">
</div>

<div class="col-md-2">
<button type="submit" class="btn btn-primary">Search</button>
</div>
</div>
</form>

<div class="row">

<div class="col-xl-3 col-md-6">
<div class="card bg-danger text-white mb-4">
<div class="card-body">
<div class="d-flex align-items-center">
<div style="font-size:30px;margin-right:15px;">💰</div>
<div>
<h6>User Add Amount</h6>
<h3><?php echo $user_add_amount; ?></h3>
</div>
</div>
</div>
</div>
</div>


<div class="col-xl-3 col-md-6">
<div class="card bg-warning text-white mb-4">
<div class="card-body">
<div class="d-flex align-items-center">
<div style="font-size:30px;margin-right:15px;">💰</div>
<div>
<h6>User Subtract Amount</h6>
<h3><?php echo $user_sub_amount; ?></h3>
</div>
</div>
</div>
</div>
</div>


<div class="col-xl-3 col-md-6">
<div class="card bg-info text-white mb-4">
<div class="card-body">
<div class="d-flex align-items-center">
<div style="font-size:30px;margin-right:15px;">💰</div>
<div>
<h6>Total Game Play</h6>
<h3><?php echo $total_game_amount; ?></h3>
</div>
</div>
</div>
</div>
</div>


<div class="col-xl-3 col-md-6">
<div class="card bg-success text-white mb-4">
<div class="card-body">
<div class="d-flex align-items-center">
<div style="font-size:30px;margin-right:15px;">💰</div>
<div>
<h6>Admin Profit</h6>
<h3><?php echo $admin_profit; ?></h3>
</div>
</div>
</div>
</div>
</div>

</div>