<?php $this->load->view("templates/header"); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="<?php echo site_url("product");?>" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6">
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<?php echo form_open("product/save",["class"=>"form-horizontal","enctype" => "multipart/form-data"]); ?>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Code</label>
		      <div class="col-sm-10">
		        <input type="text" class="form-control" id="code" name="code" value="<?php echo "P".rand(1000,1999)."".substr(time(), 0,3);?>" readonly="true" />
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		        <input type="text" class="form-control" id="name" name="name" />
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Price</label>
		      <div class="col-sm-10">
		        <input type="number" class="form-control" id="price" min="0" value="0" name="price" />
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Expired</label>
		      <div class="col-sm-10">
		        <input type="date" class="form-control" id="expired" name="expired" />
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Brand</label>
		      <div class="col-sm-10">
		         <select name="brand_id" class="form-control" required="true">
		         	 <option selected="true">Select Item</option>
		         	 <?php foreach($brand as $b): ?>
		         	 	<option value="<?php echo $b->id;?>"><?php echo $b->name;?></option>
		         	 <?php EndForeach; ?>
		         </select>
		      </div>
		   </div>
		    <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Category</label>
		      <div class="col-sm-10">
		      		<?php foreach($category as $c): ?>
		           <label class="checkbox-inline">
				      <input type="checkbox" name="category[]" value="<?php echo $c->id;?>"> <?php echo $c->name;?>
				   </label>
				   <?php EndForeach; ?>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Images</label>
		      <div class="col-sm-10">
		        <input type="file" class="form-control" id="images" name="file" />
		      </div>
		   </div>
		   <div class="form-group">
		      <div class="col-sm-offset-2 col-sm-10">
		         <button type="submit" class="btn btn-default">Save</button>
		      </div>
		   </div>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view("templates/footer"); ?>