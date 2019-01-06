<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Upload</title>
     <link rel="stylesheet" href="<?php echo base_url();?>/assets/admin/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="col-sm-4 col-md-offset-4">
        <h4>Upload Ayath image and Video</h4>
            <form class="form-horizontal" id="submit">
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
 
                <div class="form-group">
                    <button class="btn btn-success" id="btn_upload" type="submit">Upload</button>
                </div>
                <span id="messages" style="color: red;"></span>
                <div id="loader-icon" style="display:none;"><img src="<?php echo base_url();?>/assets/loader.gif" width="75" /></div>
            </form>   
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="<?php echo base_url();?>/assets/admin/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
 
        $('#submit').submit(function(e){
            e.preventDefault(); 
            $('#loader-icon').show();
                 $.ajax({
                     url:'<?php echo base_url();?>/Addayath/do_upload',
                     type:'POST',
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(response){
                        $('#loader-icon').hide();
                        $('#messages').html(response.message).fadeIn('fast').delay(2000).fadeOut('slow');
                        window.history.go(-1);
                   }
                 });
            });         
    });
     
</script>
</body>
</html>