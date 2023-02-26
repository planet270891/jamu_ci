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
		<?php echo form_open("product/update",["class"=>"form-horizontal"]); ?>
		   <?php echo form_hidden("id",$data->id); ?>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Code</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp<?php echo $data->code;?></strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Name</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp<?php echo $data->name;?></strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Price</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp<?php echo $data->price;?></strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Expired</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp<?php echo $data->expired;?></strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Brand</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp<?php echo $brand->name;?></strong>
		         </label>
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Category</label>
		      <div class="col-sm-10">
		         <label class="control-label">
		         	<strong>:&nbsp <?php foreach($category as $c){ if(in_array($c->id, $categorySelected)) {  echo $c->name.", ";  } } ?> </strong>
		         </label>
		      </div>
		   </div>
		   <?php if ($data->images && file_exists($data->images)): ?>
	        <div class="form-group">
	            <label class="col-md-2 control-label" for="inputDefault"></label>
	            <div class="col-md-10">
	               <img class="img-responsive img-thumbnail" src="<?php echo "/" . $data->images; ?>" />
	            </div>
	        </div>
	        <?php endif; ?>
		<?php echo form_close(); ?>
	</div>
</div>
<?php $this->load->view("templates/footer"); ?>