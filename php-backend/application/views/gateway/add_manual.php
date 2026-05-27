<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <?php
                echo form_open_multipart('backend/Gateway/storeManual', [
                    'autocomplete' => false,
                    'id' => 'add_gateway',
                    'method' => 'post'
                ], ['type' => $this->url_encrypt->encode('tbl_rummy_tournament_types')]);
                ?>

                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Gateway Name *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" id="name" required>
                    </div>
                </div>

                <!-- <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role" id="role" required>
                            <option value="">Select Role</option>
                            <option value="0">Super Admin</option>
                            <option value="1">Sub Admin</option>
                            <option value="2">Agent</option>
                            <option value="3">Distributer</option>
                        </select>
                    </div>
                </div> -->
                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="address" id="address" required>
                    </div>
                </div>

                <div class="form-group row"><label for="image" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="image" required id="image" required>
                    </div>
                </div>

                <div class="form-group mb-0">
                    <div>
                        <?php echo form_submit('submit', 'Submit', ['class' => 'btn btn-primary waves-effect waves-light mr-1']); ?>
                        <a href="<?= base_url('backend/Gateway/manual') ?>"
                            class="btn btn-secondary waves-effect">Cancel</a>
                    </div>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div><!-- end col -->
    </div>
</div>

<!-- Include CKEditor library before initializing -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    // Replace the textarea with CKEditor instance
    CKEDITOR.replace('instructions', {
        // optional configuration
        height: 200
    });
</script>