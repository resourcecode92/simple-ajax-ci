<html>
	<head>
		<title>Todo List - Bekup</title>

        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
        <!-- <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/css/bootstrap.min.css"/> -->
        <!-- <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/js/bootstrap.min.js"/> -->
       
        <!-- <script src="<?=base_url();?>assets/js/jQuery-2.1.4.min.js" type="text/javascript"></script> --> 
	</head>
	<body>

        <div class="container">
        <!-- method="POST" action="< ? php echo base_url('index.php/task/simpan')?>" -->
        <form class="submit" >
            <label>Task</label>
            <input type="text" name="task" maxlength="50" size="25">
            <button id="btnSubmit" type="submit">Simpan</button>
	    </form>

        <table id="tbl_task" class="table table-bordered table-hover" data-form="deleteForm">
            <thead>
                <th>ID</th>    
                <th>Task</th>    
                <th>Date</th>    
                <th>Time</th>    
                <th></th>    
            </thead>

            <tbody>
                <?php foreach ($tasks as $row ) { ?>
                        <tr>
                        <td><?php echo $row['id'] ?></td>;
                        <td><?php echo $row['task'] ?></td>;
                        <td><?php echo $row['date'] ?></td>;
                        <td><?php echo $row['time'] ?></td>;
                        <td class="parent"><table><tr>
                            <td class="child"> 
                                <a href="<?php echo site_url('task/ubah/' . $row['id']);?>">
                                    <button type="button" class="btn btn-info btn-sm"><i class="fa fa-file-text-o"></i></button>
                                </a>
                            </td>
                            <td class="child"> 
                                <form class="form-delete" action="<?php echo site_url('task/hapus/' . $row['id']);?>" method="POST">
                                    <button type="button" name="confirm" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr></table>
                        </tr>
                <?php } ?>
            </tbody>

            <tfooter>
            
            </tfooter>
        </table>
	
        <div id="confirm" class="modal fade" role="dialog">
             <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Confirmation Delete</h4>
                    </div>

                    <div class="modal-body">
                        Apakah Anda ingin menghapus <span id="idData"></span>
                    </div>

                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Delete</button>
                        <button type="button" data-dismiss="modal" class="btn btn-primary">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        </div> <!-- ./ container -->

       
	</body>

    <script src="<?php echo base_url('assets/js/jQuery-2.1.4.min.js')?>" type="text/javascript"></script> 
    <script src="<?php echo base_url('assets/js/bootstrap.min.js')?>" type="text/javascript"></script> 

     <script type="text/javascript">
            $(function () {

                $('table[data-form="deleteForm"]').on('click', '.form-delete', function(e){
                    e.preventDefault();
                    var $form=$(this);
                    $('#confirm').modal({ backdrop: 'static', keyboard: false })
                        .on('click', '#delete', function(){
                            $form.submit();
                        });
                });


                $('#btnSubmit').click(function(e){
                    e.preventDefault();

                    var form = $('form.submit').serialize();
                    // alert(form);
                    $.ajax({
                        url: "<?php echo base_url('index.php/task/simpan')?>",
                        type: "POST",
                        data: form,
                        dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            $("#tbl_task tr").remove();
                            alert(data);
                        },
                        fail: function(jqXHR, textStatus, errorThrown) {
                            alert(errorThrown);
                        }
                    });
                });
            });
        </script>
</html>
