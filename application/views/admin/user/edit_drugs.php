  <!-- Main content -->
  <section class="content container">
   

      <div class="box">
        <form id="cat-fom" method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/drugs/add')?>" role="form" novalidate>

          <div class="form-group">
            <label><?php echo trans('name') ?> <span class="text-danger">*</span></label>
            <input type="text" class="form-control" required name="name" value="4" >
          </div>

          <div class="form-group">
            <label><?php echo trans('details') ?></label>
            <textarea class="form-control" name="details" rows="6"><?php echo $drug[0]['details']; ?></textarea>
          </div>

          <input type="hidden" name="id" value="<?php echo html_escape($drug['0']['id']); ?>">
          <!-- csrf token -->
          <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

          <div class="row m-t-30">
            <div class="col-sm-12">
              <?php if (isset($page_title) && $page_title == "Edit"): ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
              <?php else: ?>
                <button type="submit" class="btn btn-primary pull-left"><i class="ficon flaticon-check"></i> <?php echo trans('save-changes') ?></button>
              <?php endif; ?>
            </div>
          </div>

        </form>

      </div>

      
    </div>
    
    </section>