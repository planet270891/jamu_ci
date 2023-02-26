<?php $this->load->view("templates/header"); ?>
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="col-md-6">
			<a href="<?php echo site_url("user");?>" class="btn btn-default">
				Back to List
			</a>
		</div>
		<div class="col-md-6">
			
		</div>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">
		<?php if (validation_errors()): ?>
		    <div class="alert alert-warning">
		        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		        <span>
		            <i class="fa fa-warning"></i>&nbsp; <strong>Warning</strong>
		        </span>
		        <ul>
		            <?php echo validation_errors('<li>', '</li>'); ?>
		        </ul>
		    </div>
		<?php endif; ?>
		<?php echo form_open("user/save",["class"=>"form-horizontal"]); ?>
		   <div class="form-group">
		      <label for="firstname" class="col-sm-2 control-label">Username</label>
		      <div class="col-sm-10">
		        <input type="text" class="form-control" id="username" name="username" value="<?php echo set_value('username'); ?>">
		      </div>
		   </div>
		   <div class="form-group">
		      <label for="lastname" class="col-sm-2 control-label">Email</label>
		      <div class="col-sm-10">
		         <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
		      </div>
		   </div>
		   <div class="form-group">
	          <label for="lastname" class="col-sm-2 control-label">Password</label>
		      <div class="col-sm-10">
		         <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">
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