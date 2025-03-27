<?php
//print_r(college_code);
 ?>
<section class="py-3">
	<div class="row mb-4">
		<div class="col-lg-12 mb-4 mb-lg-0">
			<div class="card">
				<div class="card-header">
					<h2 class="h6 text-uppercase mb-0">Search College</h2>
				</div>
				<div class="card-body">            
				<!-- search form-->
					<?php
					$form = array(
						'class'					=>	'form-material',
						'data-toggle'			=>	'validator',
						'role'					=>	'form',
						'id'					=> 'searchform',
						'data-parsley-validate'	=>	''
					);	
					echo form_open_multipart('admin/search_subject', $form);
					?>
					<div class="row mb-4">
						
						<div class="form-group col-md-6">
							<label class="control-label">College</label>
							
							<?php
								$extra_clg_name = array(
									'id'    => 	'clg_name',
									'class' => 	'form-control clg_name '
								);
								echo form_dropdown('clg_name', $college_options, $clg_code, $extra_clg_name);
								?>
						</div>

						<div class="form-group col-md-4">
							<label class="control-label">Category</label>

							<?php
								$extra_cat= array(
									'id'    => 	'category',
									'class' => 	'form-control category '
								);
								echo form_dropdown('category', $allot_category_options, $category, $extra_cat);
								?>
						</div>
						
						
						<div class="form-group col-md-2">
							<label class="control-label"> </label><br>
								
							<button type="button" class="btn btn-primary btn-clg-seats-search">Search</button>
						</div>
						
						
					</div>	
					
					
					</form>
					<!-- end search form-->

                    
					
					<table id="candidate_basic_listing" class="table table-striped table-bordered table-hover responsive" width="100%">
						<thead>
							<tr>
								<th style="width:3%">#</th>
								<th style="width:10%">Course Name</th>
								<th style="width:10%">Seats</th>
							
								
							</tr>
						</thead>
								
						<tbody>
			             	<?php
							  if(!empty($all_details)){
								  $n = 1;
								 foreach($all_details as $can){
								?>
								<tr>
								<td><?php echo $n;?></td>
								<td><?php echo $can['crs_name'];?></td>
								<td><?php echo $can['seats'];?></td>
								
							</tr>
							<?php	
								$n++;	
								}
							}
							 else{
              			         }
								?>
					</tbody>
								
					</table>
				</div>			
			</div>
		</div>
	</div>
</section>	


<?php
$this->load->view("common/footer");
?>

<script>
    $(document).on('click','.btn-clg-seats-search',function(){

	    var clg_name	=	$('#clg_name').val();
		var category	=	$('#category').val();

        if ((clg_name != '')&&(category != ''))  {
            window.location.href = "search_clg_seats?clg_code="+clg_name+"&category="+category;
		
        }else{
            swal('All field(s) are required');
        }

       

	
    });


</script>
