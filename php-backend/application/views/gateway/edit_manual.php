<?php
echo form_open_multipart('backend/Gateway/updateManual/' . $ManualGatway->id, [
    'autocomplete' => false,
    'id' => 'edit_gateway',
    'method' => 'post'
]);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">

                <!-- Gateway Name -->
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Gateway Name *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="name" id="name"
                            value="<?= set_value('name', $ManualGatway->name) ?>" required>
                    </div>
                </div>

                <!-- Role -->
                <!-- <div class="form-group row">
                    <label for="role" class="col-sm-2 col-form-label">Role *</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="role" id="role" required>
                            <option value="">Select Role</option>
                            <?php
                            $roles = [
                                0 => 'Super Admin',
                                1 => 'Sub Admin',
                                2 => 'Agent',
                                3 => 'Distributer'
                            ];
                            foreach ($roles as $key => $value): ?>
                                <option value="<?= $key ?>" <?= set_select('role', $key, $ManualGatway->role == $key) ?>>
                                    <?= $value ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div> -->

                <div class="form-group row">
                    <label for="address" class="col-sm-2 col-form-label">Address *</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="address" id="address" 
                        value="<?= set_value('name', $ManualGatway->address) ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="image" class="col-sm-2 col-form-label">Image <?= empty($ManualGatway->image) ? '*' : '' ?></label>
                    <div class="col-sm-10">
                        <input class="form-control" type="file" name="image" id="image" <?= empty($ManualGatway->image) ? 'required' : '' ?> accept="image/*">
                        
                        <?php if (!empty($ManualGatway->image)): ?>
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="<?= base_url('uploads/images/' . $ManualGatway->image) ?>" alt="Current Image" style="max-height: 120px; border: 1px solid #ccc; padding: 5px;">
                            </div>
                        <?php endif; ?>

                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="form-group mb-0">
                    <div>
                        <?= form_submit('submit', 'Update', ['class' => 'btn btn-primary waves-effect waves-light mr-1']); ?>
                        <a href="<?= base_url('backend/Gateway/manual') ?>"
                            class="btn btn-secondary waves-effect">Cancel</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- CKEditor -->
<script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('instructions', { height: 200 });
</script>