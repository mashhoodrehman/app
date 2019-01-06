<?php 
require_once(APPPATH.'../public/admin/Header.php');
?>
<style type="text/css">
  .tblsurah>thead>tr>th, .tblsurah>tbody>tr>td, .snumber
  {
    width: 17% !important;
    text-align: center;
  }
</style>
<div class="content-wrapper">
    <section class="content-header">
      <h1>
        Surah > <?=$surah;?>       
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Surah</a></li>
        <li class="active">List of Ayath</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Add Ayath</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" id="submit">
              <div class="box-body">
                <div class="form-group">
                  <label for="anum">Ayath Number</label>
                  <input type="hidden" class="form-control" id="surah" name="surah" value="<?=$sid;?>">
                    <input type="text" name="anum" class="form-control" placeholder="" required>
                </div>
                <div class="form-group">
                 <label for="aimage">Ayath image</label>
                  <input type="file" name="aimage" required>
                </div>
                <div class="form-group">
                  <label for="avideo">Ayath video</label>
                  <input type="file" name="avideo" required>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Add</button>
                <span id="messages" style="color: red;"></span>
              </div>
            </form>
            
                <div id="loader-icon" style="display:none;"><img src="<?php echo base_url();?>/assets/loader.gif" width="75" /></div>
          </div>
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Ayath Table</h3>
            </div>
            <?php if(empty($arr)){
              echo "<h3>Ayath not listed!<h3>";
            }
            else{
              ?>
    <h3>Total Ayath : <?php echo count($arr); ?> </h3>
    <div class="box-body">
      <table id="example2" class="table table-bordered table-hover tblsurah">
          <thead>
            <tr>
              <th>Ayath Number</th>
              <th>Image</th> 
              <th>Video</th> 
            </tr>
          </thead>
          <tbody>
          <?php           
          foreach($arr as $row)
          {
          ?>
            <tr>
              <td class="snumber"><?=$row->ayath_no;?></td>
              <td>
                <img src="<?php echo base_url();?>assets/uploads/images/<?=$row->ayath_image;?>" class="img-responsive" style="width: 100px;height: auto;">
              </td>
              <td>
                <video width="100" height="100" controls>
                  <source src="<?php echo base_url();?>assets/uploads/videos/<?=$row->ayath_video;?>" type="video/mp4">
                </video>
              </td>
            </tr>
         <?php 
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
    // $(document).ready(function(){
 
        $('#submit').submit(function(){
            // e.preventDefault(); 
            $('#loader-icon').show();
                 $.ajax({
                     url:'<?php echo base_url();?>/Addayath/do_upload',
                     type:'POST',
                     data:new FormData(this),
                     dataType: 'json',
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                     success: function(response){
                        $('#loader-icon').hide();
                        // if(alert(response)){window.location.reload();}
                        // else {window.location.reload();} 
                        $('#messages').html(response).fadeIn('fast').delay(2000).fadeOut('slow');
                        
                   },
                   complete: function(){
                    window.location.reload();
                  }
                 });
            });         
    // });
     
</script>