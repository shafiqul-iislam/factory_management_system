<?php if ($message = session()->get('success')) { ?>
    <div class="d-flex justify-content-end">
    <div class="col-lg-4 alert alert-success alert-dismissible fade show text-light" role="alert">
        <strong><?php echo $message ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    </div>  
<?php } ?>