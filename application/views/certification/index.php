<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Certifications Listing</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('certification/add'); ?>" class="btn btn-success btn-sm">Add</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>ID</th>
						<th>Date</th>
						<th>ExpirationDate</th>
						<th>WorkerId</th>
						<th>FrontOfCertification</th>
						<th>BackOfCertification</th>
						<th>AdministeredBy</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($certifications as $c){ ?>
                    <tr>
						<td><?php echo $c['id']; ?></td>
						<td><?php echo $c['date']; ?></td>
						<td><?php echo $c['expirationDate']; ?></td>
						<td><?php echo $c['workerId']; ?></td>
						<td><?php echo $c['frontOfCertification']; ?></td>
						<td><?php echo $c['backOfCertification']; ?></td>
						<td><?php echo $c['administeredBy']; ?></td>
						<td>
                            <a href="<?php echo site_url('certification/edit/'.$c['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('certification/remove/'.$c['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
