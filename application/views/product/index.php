<?php $this->load->view("templates/header"); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="<?php echo site_url("product/create");?>" class="btn btn-default">
				Create New
			</a>
			<a href="<?php echo site_url("product");?>" class="btn btn-default">
				Refresh
			</a>
		</div>
		<div class="col-md-6">
			<?php echo form_open("product"); ?>
				<div class="input-group">
	               <input type="text" class="form-control" name="search"  value="<?php echo isset($_GET['search']) ? $_GET['search'] : '';?>"  required/>
	               <span class="input-group-btn">
	                  <button class="btn btn-default" type="submit">
	                    Search
	                  </button>
	               </span>
	            </div>
			<?php echo form_close(); ?>
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<?php if($this->session->flashdata('message')): ?>
			<div class="alert alert-success alert-dismissable">
			   <button type="button" class="close" data-dismiss="alert" 
			      aria-hidden="true">
			      &times;
			   </button>
			   Success! , <?php echo $this->session->flashdata('message'); ?>
			</div>
		<?php EndIf; ?>
		<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>No</th>
						<th>Created At</th>
						<th>Code</th>
						<th>Name</th>
						<th>Brand</th>
						<th>Price</th>
						<th>Images</th>
						<th class="text-center">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php $num = 1; foreach($results as $row): ?>
					<tr>
						<td><?php echo $num++;?></td>
						<td><?php echo $row->created_at;?></td>
						<td><?php echo $row->code;?></td>
						<td><?php echo $row->name;?></td>
						<td><?php echo $row->brand_name;?></td>
						<td><?php echo $row->price;?></td>
						<td>
							<?php if(file_exists($row->images)): ?>
								<img src="<?php echo site_url($row->images);?>" class="thumbnail" width="100" alt="<?php echo $row->name;?>">
							<?php Else: ?>
								<label>No Images</label>
							<?php EndIf; ?>
						</td>
						<td class="text-center">
							<a class="btn btn-default btn-sm" href="<?php echo site_url("product/edit/".$row->id);?>">
								Edit
							</a>
							<a class="btn btn-default btn-sm" href="<?php echo site_url("product/show/".$row->id);?>">
								Show
							</a>
							<a class="btn btn-default btn-sm" href="<?php echo site_url("product/Delete/".$row->id);?>">
								Delete
							</a>
						</td>
					</tr>
					<?php EndForeach; ?>
				</tbody>
			</table>
			<ul class="pagination pull-right">
                <!-- Show pagination links -->
                <?php
                foreach ($links as $link) {
                    echo "<li>" . $link . "</li>";
                }
                ?>
            </ul>
		</div>
	</div>
</div>
<?php $this->load->view("templates/footer"); ?>