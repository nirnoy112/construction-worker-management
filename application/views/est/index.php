<?php

/*****
*
* @Author: Nasid Kamal.
* @Project Keyword: OHS.
*
*****/

defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <h3 style="color: #ffffff;" class="box-title">ESTs</h3>
            	<div class="box-tools">
                    <a href="<?php echo site_url('est/add'); ?>" class="btn btn-success btn-sm">Add New EST</a> 
                </div>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tr>
						<th>Title</th>
						<th>Description</th>
						<th>Actions</th>
                    </tr>
                    <?php foreach($ests as $e){ ?>
                    <tr>
						<td><?php echo $e['title']; ?></td>
						<td><?php echo $e['description']; ?></td>
						<td>
                            <a href="<?php echo site_url('est/edit/'.$e['id']); ?>" class="btn btn-info btn-xs"><span class="fa fa-pencil"></span> Edit</a> 
                            <a href="<?php echo site_url('est/remove/'.$e['id']); ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash"></span> Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                                
            </div>
        </div>
    </div>
</div>
