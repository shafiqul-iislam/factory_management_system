<?php include(resource_path('/views/theme/admin_portal/dashboard/header.php')) ?>

<?php include(resource_path('/views/theme/admin_portal/global/success_alert.php')) ?>
<?php include(resource_path('/views/theme/admin_portal//global/error_alert.php')) ?>


<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="general_settings_tab" data-bs-toggle="pill" data-bs-target="#general_settings" type="button" role="tab" aria-controls="general_settings" aria-selected="true">General Settings</button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="software_settings_tab" data-bs-toggle="pill" data-bs-target="#software_settings" type="button" role="tab" aria-controls="software_settings" aria-selected="false">Software Settings</button>
            </li>
        </ul>


        <div class="tab-content" id="pills-tabContent">

            <!-- General Settings -->
            <div class="tab-pane fade show active" id="general_settings" role="tabpanel" aria-labelledby="general_settings_tab">
                <div class="card mb-4">

                    <div class="card-header d-flex justify-content-end">
                        <button class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target=".upload_logo_modal">Logo</button>
                        <button class="btn btn-primary">Favicon</button>
                    </div>
                    <div class="card-body">
                        <form class="form" method="POST" action="<?php echo url('settings/update-general-settings'); ?>">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Company Name</label>
                                    <input class="form-control" type="text" name="company_name" placeholder="Enter Company Name" value="<?php echo $generalSettings->company_name ?? ''; ?>" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Site Name</label>
                                    <input class="form-control" type="text" name="site_name" placeholder="Enter Site Name" value="<?php echo $generalSettings->site_name ?? ''; ?>" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">E-mail</label>
                                    <input class="form-control" type="email" name="email" placeholder="Enter E-mail" value="<?php echo $generalSettings->email ?? ''; ?>" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Country</label>
                                    <input class="form-control" type="text" name="country" placeholder="Enter Country Name" value="<?php echo $generalSettings->country ?? ''; ?>" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phoneNumber">Phone Number</label>
                                    <input class="form-control" type="number" name="phone" placeholder="Enter Phone" value="<?php echo $generalSettings->phone ?? ''; ?>" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">City</label>
                                    <input type="text" class="form-control" name="city" placeholder="Enter City" value="<?php echo $generalSettings->city ?? ''; ?>" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" placeholder="Enter Address" value="<?php echo $generalSettings->address ?? ''; ?>" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Zip Code</label>
                                    <input class="form-control" type="text" name="zip_code" placeholder="Enter Zip Code" value="<?php echo $generalSettings->zip_code ?? ''; ?>" />
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Currency</label>
                                    <select class="select2 form-select" name="currency">

                                        <?php if ($generalSettings->currency ?? '' == 'bdt') { ?>
                                            <option value="bdt" selected>BDT (*)</option>
                                        <?php } else if ($generalSettings->currency ?? '' == 'usd') { ?>
                                            <option value="usd">USD (*)</option>
                                        <?php } ?>

                                        <option value="">Select An Option</option>
                                        <option value="bdt">BDT</option>
                                        <option value="usd">USD</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label class="form-label">Time Zone</label>
                                    <select class="select2 form-select" name="time_zone">

                                        <?php if ($generalSettings->timezone ?? '' == 'asia/dhaka') { ?>
                                            <option value="bdt" selected>asia/dhaka (*)</option>
                                        <?php } else if ($generalSettings->timezone ?? '' == 'india/kolkata') { ?>
                                            <option value="usd">india/kolkata (*)</option>
                                        <?php } ?>

                                        <option value="">Select A Zone</option>
                                        <option value="asia/dhaka">asia/dhaka</option>
                                        <option value="india/kolkata">india/kolkata</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mt-2 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- software settings -->
            <div class="tab-pane fade show" id="software_settings" role="tabpanel" aria-labelledby="software_settings_tab">
                <div class="card mb-4">
                    <div class="card-body">
                        <form id="formAccountSettings" method="POST" onsubmit="return false">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="lastName" class="form-label">Last Name</label>
                                    <input class="form-control" type="text" name="lastName" id="lastName" value="Doe" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include(resource_path('/views/theme/admin_portal/settings/template/upload_logo_modal.php')); ?>

<?php include(resource_path('/views/theme/admin_portal/dashboard/footer.php')) ?>