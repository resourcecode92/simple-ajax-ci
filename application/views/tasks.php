<html>
	<head>
		<title>Todo List - Bekup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css')?>"/>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/font-awesome.min.css')?>"/>
	</head>
	<body>


        <div class="container">
            <h1> Bekup - Syahriga - Simple Ajax  </h1>
            <hr>
            <form class="submit">
                <label>Task</label>
                <input id="taskInput" data-id="" type="text" name="task" maxlength="50" size="25"/>
                <button id="btnSubmit" class="btn btn-primary btn-sm" type="submit">Simpan</button>
	        </form>

            <table id="tbl_task" class="table" data-form="deleteForm">
                <thead>
                    <tr>
                        <th>ID</th>    
                        <th>Task</th>    
                        <th>Date</th>    
                        <th>Time</th>    
                        <th></th>
                        <th></th>
                    </tr>
                </thead>

                <tbody id="table-body">
                    <?php foreach ($tasks as $row) { ?>
                            <tr id="<?php echo $row['id'] ?>">
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['task'] ?></td>
                                <td><?php echo $row['date'] ?></td>
                                <td><?php echo $row['time'] ?></td>
                            <td> 
                                <button type="button" class="btn btn-info btn-sm" onclick="editBtn('<?php echo $row['id'] ?>')"><i class="fa fa-edit"></i></button>
                            </td>
                            <td> 
                                <form class="form-delete" data-id="<?php echo $row['id'] ?>">
                                    <button type="button" name="confirm" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                            </tr>
                    <?php } ?>
                </tbody>
            
            </table>
	
            <div id="confirm" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Konfirmasi Hapus</h4>
                        </div>

                        <div class="modal-body">
                            Apakah Anda ingin menghapus Data ini?
                        </div>

                        <div class="modal-footer">
                            <button type="button" data-dismiss="modal" class="btn btn-danger" id="delete">Hapus</button>
                            <button type="button" data-dismiss="modal" class="btn btn-primary">Kembali</button>
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
                    var id = $(this).attr("data-id");
                    var $form = $(this);

                    $('#confirm').modal({ backdrop: 'static', keyboard: false })
                        .on('click', '#delete', function(){
                            e.preventDefault();

                             $.ajax({
                                url:"<?php echo site_url('task/hapus')?>",
                                type: "POST",
                                data:{id:id},
                                success: function(){
                                    e.preventDefault();

                                    $form.parent().parent().remove();
                                }
                            });
                        });
                });


                $('#btnSubmit').click(function(e){
                    e.preventDefault();
                    
                    if($(this).text() === "Simpan") {
                        // alert(form);
                        var form = $('form.submit').serialize();
                        
                        $.ajax({ // save ajax
                            url: "<?php echo base_url('index.php/task/simpan')?>",
                            type: "POST",
                            data: form,
                            dataType: "json",
                            success: function(data) {
                                // alert(data);
                                e.preventDefault();
                                // console.log(data);
                            var ele="";
                                $.each(data, function(index, item) {
                                    $.each(item, function(index, it){
                                        ele += "<tr id='"+it.id+"'>";
                                        ele += "<td>"+it.id+"</td>";
                                        ele += "<td>"+it.task+"</td>";
                                        ele += "<td>"+it.date+"</td>";
                                        ele += "<td>"+it.time+"</td>";
                                        // ele += "<td><button type='button' class='btn btn-info btn-sm editBtn' data-id='"+it.id+"'><i class='fa fa-file-text-o'></i></button></td>";
                                        ele += "<td><button type='button' class='btn btn-info btn-sm' onclick='editBtn("+it.id+ ")'><i class='fa fa-edit'></i></button></td>";
                                        ele += "<td>";
                                        ele += "<form class='form-delete' data-id='"+it.id+"'><button type='button' class='deleteBtn btn btn-danger btn-sm' data-id='"+it.id+"'><i class='fa fa-file-text-o'></i></button></form>"
                                        ele += "</td>";
                                        ele += "</tr>";
                                    });
                                });
                                // console.log(ele);
                                var element = $(ele);
                                element.prependTo('#table-body');
                                // $('#tbl_task tr').append()

    
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(textStatus);
                            }
                        }); // save ajax
                    }
                    else {
                        var id = $("#taskInput").attr('data-id');
                        var task = $("#taskInput").val();
                        // alert(id,task);

                        $.ajax({
                            url: "<?php echo base_url('index.php/task/ubahSimpan')?>",
                            type: "POST",
                            data: {id:id, task:task},
                            dataType: "json",
                            success: function(data) {
                                e.preventDefault();

                                $.each(data, function(index, item) {
                                    $.each(item, function(index, it){
                                        $("#"+it.id+ " td:nth-child(2)").html(it.task);
                                        $("#"+it.id+ " td:nth-child(3)").html(it.date);
                                        $("#"+it.id+ " td:nth-child(4)").html(it.time);
                                    });
                                });
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                alert(textStatus);
                            }
                        });
                        
                    }

                    $("#taskInput").attr('data-id', '');
                    $("#taskInput").val('');
                    $("#btnSubmit").html('Simpan');
                    
      
                });
            });

            function editBtn(idData) {
                // e.preventDefault();
                var id = idData;
                
                // alert(id);
                $.ajax({ // get edit
                    url: "<?php echo base_url('index.php/task/detail')?>",
                    type: "POST",
                    data: {id:id},
                    dataType: "json",
                    success: function(data) {
                        // console.log(data);
                        // e.preventDefault();
                        var valTask = "";
                        var dataId = "";
                        $.each(data, function(index, item) {
                            $.each(item, function(index, it){
                                valTask = it.task;
                                dataId = it.id 
                            });
                        });
                        $("#taskInput").val(valTask);
                        $("#taskInput").attr('data-id', dataId);
                        $("#btnSubmit").html('Ubah');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert(textStatus);
                    }
                }); // get edit
            }

        </script>
</html>
