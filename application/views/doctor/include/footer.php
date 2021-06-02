<footer class="main-footer">
  <div class="pull-right d-none d-sm-inline-block">
    <div class="version">Version: <?php echo html_escape($settings->version) ?></div>
  </div>
  <a href="<?php echo base_url() ?>"><?php echo html_escape($settings->copyright) ?></a>
</footer>

<?php include'js_msg_list.php'; ?>

<?php $success = $this->session->flashdata('msg'); ?>
<?php $error = $this->session->flashdata('error'); ?>
<input type="hidden" id="success" value="<?php echo html_escape($success); ?>">
<input type="hidden" id="error" value="<?php echo html_escape($error);?>">
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>">

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery3.min.js"></script>
<!-- popper -->
<script src="<?php echo base_url() ?>assets/admin/js/popper.min.js"></script>
<!-- bootstrap 4 -->
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap.min.js"></script>
<!-- Custom js -->
<script src="<?php echo base_url() ?>assets/admin/js/admin.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/toast.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/admin/js/sweet-alert.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/validation.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url() ?>assets/admin/js/jquery.slimscroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin/plugins/ckeditor/ckeditor.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>assets/admin/js/fastclick.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/template.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/demo.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/printThis.js"></script>
<!-- select 2 -->
<script src="<?php echo base_url() ?>assets/admin/js/select2.min.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap4-toggle.min.js"> </script>
<script src="<?php echo base_url() ?>assets/front/js/aos.js"></script>
<script src="<?php echo base_url() ?>assets/admin/js/bootstrap-switch.min.js"></script>
<!-- <script src="<?php echo base_url() ?>assets/admin/js/timepicki.js"></script> -->
<script src="<?php echo base_url() ?>assets/admin/js/lightbox.min.js"></script>

<?php if (isset($page) && $page == 'Appointment'): ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<script>
    $(document).on("focusin",".timepicker", function () {
        $('input.timepicker').timepicker({});
    });
</script>
<?php endif ?>

<!-- stripe js -->
<?php $this->load->view('admin/include/stripe-js'); ?>

<!-- admin chart js -->
<?php if (isset($page_title) && $page_title == 'Dashboard'): ?>
  <?php $this->load->view('admin/include/charts'); ?>
<?php endif ?>

<!-- user chart js -->
<?php if (isset($page_title) && $page_title == 'User Dashboard'): ?>
  <?php $this->load->view('admin/include/charts_user'); ?>
<?php endif ?>

<!-- <script>
	$('.timepicker').timepicki();
	
	lightbox.option({
      'resizeDuration': 200,
      'wrapAround': true
    })
</script> -->

</body>
</html>
