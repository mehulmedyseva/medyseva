<div class="content-wrapper">
  <!-- Main content -->
  <section class="content container">
    <div class="box list_area">
      <div class="box-header with-border">
          <h3 class="box-title">Contacts </h3>
      </div>

      <div class="box-body">
        <div class="col-md-12 col-sm-12 col-xs-12 scroll">
            <table class="table table-hover <?php if(count($contacts) > 10){echo "datatable";} ?>">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                  <?php $i=1; foreach ($contacts as $contact): ?>
                    <tr id="row_<?php echo html_escape($contact->id); ?>">
                        
                        <td><?= $i; ?></td>
                        <td><?php echo html_escape($contact->name); ?></td>
                        <td><?php echo html_escape($contact->email); ?></td>
                         <td><?php echo html_escape($contact->mobile); ?></td>
                        <td><?php echo html_escape($contact->message); ?></td>
                        <td><span class="label label-default"> <?php echo my_date_show_time($contact->created_at); ?> </span></td>
                        
                        <td class="actions" width="12%">
                          <a data-val="Contact" data-id="<?php echo html_escape($contact->id); ?>" href="<?php echo base_url('admin/contact/delete/'.html_escape($contact->id));?>" class="on-default remove-row delete_item" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash-o"></i></a> &nbsp;

                        </td>
                    </tr>
                    
                  <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </div>

      </div>
    </div>
  </section>
</div>
