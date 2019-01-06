<?php 
require_once(APPPATH.'../public/admin/Header.php');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Surah
        
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Add Surah</li>
      </ol>
    </section>
    <section class="shop-posts light-blue">
         <div class="container">
         	<div class="row">
            <div class="col-md-6 col-md-offset-2 col-vertical-3">			        
			          <div class="form-group col-md-12 col-sm-12 col-xs-12">
			            <label for="snum">Surah Number</label>
			            <input type="number" class="form-control" id="snum" name="snum" placeholder=""  required>
                  <span id="snummsg"></span>
			          </div>
			          <div class="form-group col-md-12 col-sm-12 col-xs-12">
			            <label for="sname">Surah Name</label>
			            <input type="text" class="form-control" id="sname" name="sname" placeholder="" value="">
			            <span id="snamemsg"></span>
			          </div>
			         <div class="form-group col-md-12 col-sm-12 col-xs-12">
                  <label for="juzuh">Juzuh</label>
                  <input type="text" class="form-control" id="juzuh" name="juzuh" placeholder="" value="">
                  <span id="juzuhmsg"></span>
                </div>			        			        
			        <div class="col-md-12 col-sm-12 col-xs-12" align="middle">                    
			        <button type="submit" id="submit" class="btn btn-primary">Add</button>
			        <span id="messages" style="color: red;">
                
              </span>
			        </div>
			      <section>
                   <table class="table table-bordered tblsurah">
                  <thead>
                    <tr>
                      <th>Surah Number</th>
                      <th>Surah Name</th>  
                    </tr>
                  </thead>
                  <tbody id="tablecontent">
                  <?php                   
                  foreach($slist as $row)
                  {
                  ?>
                    <tr>
                      <td class="snumber"><?=$row->surah_no;?></td>
                      <td><?=$row->surah_name;?></td>
                    </tr>
                 <?php                   
                  } ?>
                  </tbody>
                </table>   
            </section>
            </div>       	
         	</div>
        </div>
    </section>
</div>
<?php 
require_once(APPPATH.'../public/admin/Footer.php');
?>
<script type="text/javascript">
	$('#submit').click(function(){
		var snum=$('#snum').val();
    if(snum == '')
    {
      $('#snummsg').html('Enter the surah number').fadeIn('fast').delay(2000).fadeOut('slow');;
    }
    var sname=$('#sname').val();
    if(sname == '')
    {
      $('#snamemsg').html('Enter the surah title').fadeIn('fast').delay(2000).fadeOut('slow');;
    }
    var juzuh=$('#juzuh').val();
    if(juzuh == '')
    {
      $('#juzuhmsg').html('Enter the juzuh number').fadeIn('fast').delay(2000).fadeOut('slow');;
    }
    else
    {
      // alert(snum);
	   $.ajax({
            url: "<?php echo base_url('Admin/addsurah');?>",
            type: "POST",
            data: {'snum':snum,'sname':sname,'juzuh':juzuh},
            dataType: 'json',
            success:function(response) 
            {   
              if(response.success=='true')
              {
                $('#messages').html(response.message).fadeIn('fast').delay(2000).fadeOut('slow');
                $('#tablecontent').html(response.table);
              }
              else 
              {
                $('#messages').html(response.message).fadeIn('fast').delay(2000).fadeOut('slow');
              }                     
            },
            error:function(response) 
            {        
                $('#messages').html(response).fadeIn('fast').delay(2000).fadeOut('slow');
            }
          });
    }
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