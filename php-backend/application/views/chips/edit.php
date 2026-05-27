<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
            <?php
            echo form_open_multipart('backend/chips/update', ['autocomplete' => false, 'id' => 'edit_chips'
                ,'method'=>'post'], ['type' => $this->url_encrypt->encode('tbl_coin_plan'),
                'id'=> $Chips->id])
                ?>
                <div class="form-group row"><label for="coin" class="col-sm-2 col-form-label">Unit *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="coin" required id="coin" value="<?= $Chips->coin?>">
                    </div>
                </div>

                <div class="form-group row"><label for="price" class="col-sm-2 col-form-label">Price *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="number" min="0" name="price" required id="price" value="<?= $Chips->price?>">
                    </div>
                </div>

                <div class="form-group row"><label for="title" class="col-sm-2 col-form-label">Title *</label>
                    <div class="col-sm-10">
                    <input class="form-control" type="text" name="title" required id="title" value="<?= $Chips->title?>">
                    </div>
                </div>

                <?php
                // Convert comma-separated payment_method_id string to array for pre-selection
                $selectedMethods = explode(',', $Chips->payment_method_id ?? '');
                ?>

                <div class="form-group row">
                    <label for="payment_method_id" class="col-sm-2 col-form-label">Manual Gateway *</label>
                    <div class="col-sm-10">
                        <select class="form-control select2" name="payment_method_id[]" id="payment_method_id" multiple required>
                            <?php foreach ($ManualGateways as $gateway): ?>
                                <?php if ($gateway->status == 1 && $gateway->isDeleted == 0): ?>
                                    <option value="<?= $gateway->id ?>" <?= in_array($gateway->id, $selectedMethods) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($gateway->name) ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>



 
                <div class="form-group mb-0">
                    <div>
                        <?php
                        echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']);
                        echo form_reset(['class' => 'btn btn-secondary waves-effect', 'value' => 'Cancel']);
                        ?>
                    </div>
                </div>
            <?php
            echo form_close();
            ?>
            </div>
        </div><!-- end col -->
    </div>
    <!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Include jQuery (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Initialize Select2 -->
<script>
    $(document).ready(function() {
        $('#payment_method_id').select2();
    });
</script>
