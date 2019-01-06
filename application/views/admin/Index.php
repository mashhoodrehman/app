<?php 
require_once(APPPATH.'../public/admin/Header.php');
?>
<style type="text/css">
  .tblsurah>thead>tr>th, .tblsurah>tbody>tr>td, .snumber
  {
    /*width: 17% !important;*/
    text-align: center;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        List
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">List of Surah</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Surah Table</h3>
            </div>
              <?php if(empty($arr)){
                echo "<h3>Not Uploaded<h3>";
              }
              else{
                ?>
            <h3>Total Surah : <?php echo count($arr); ?> </h3>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover tblsurah">
                <thead>
                  <tr>
                    <th>Surah Number</th>
                    <th>Surah Name</th>  
                  </tr>
                </thead>
                <tbody>
                <?php 
                
                $i=1;
                foreach($arr as $row)
                {
                ?>
                  <tr>
                    <td class="snumber"><a href="<?php echo base_url('Admin/ayath');?>?surah=<?=$row['surah_no'];?>"><?=$row['surah_no'];?></a></td>
                    <td><?=$row['surah_name'];?></td>
                  </tr>
               <?php 
                $i++;
                } ?>
                </tbody>
              </table>    
            </div>
            <?php
          } ?>
        </div>
      </div>   
    </div>
  </section>
<?php 
require_once(APPPATH.'../public/admin/Footer.php');
?>
<script type="text/javascript">
	$('#mobile').change(function(){
		var mobile=$(this).val();
		// alert(mobile);
	   $.ajax({
            url: "<?php echo base_url('Admin/checkmobile_uae');?>",
            type: "POST",
            data: {'mobile':mobile},
            dataType: 'json',
            success:function(response) 
            {        
                if(response=='error')
                {
                  $('#errormobile').html('Already Exist').fadeIn('fast').delay(2000).fadeOut('slow');                  
                }
                else
                {
                	$('#errormobile').html('');
                }
            }
          });
	});
	$('#email').change(function(){
		var email=$(this).val();
		// alert(mobile);
	   $.ajax({
            url: "<?php echo base_url('Admin/checkemail_uae');?>",
            type: "POST",
            data: {'email':email},
            dataType: 'json',
            success:function(response) 
            {        
                if(response=='error')
                {
                  $('#erroremail').html('Already Exist').fadeIn('fast').delay(2000).fadeOut('slow');                 
                }
                else
                {
                	$('#erroremail').html('');
                }
            }
          });
	});
	$(document).ready(function() {
  $("#adduserprof").unbind('submit').bind('submit', function() {
    var form = $(this);

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(),
      dataType: 'json',
      success:function(response) {        
        if(response.success == true) {
          $("#messages").html(response.messages);

          $("#adduserprof")[0].reset();
          $(".text-danger").remove();
          $(".form-group").removeClass('has-error').removeClass('has-success');
        }
        else {
          $.each(response.messages, function(index, value) {
            var element = $("#"+index);

            $(element)
            .closest('.form-group')
            .removeClass('has-error')
            .removeClass('has-success')
            .addClass(value.length > 0 ? 'has-error' : 'has-success')
            .find('.text-danger').remove();

            $(element).after(value);

          });
        }
      } // /success
    });  // /ajax

    return false;
  }); 
});
</script>