 
 <form method="POST" action="<?php echo base_url('index.php/task/ubahSimpan/' . $task->id)?>">
            <label>Task</label>
            <input type="text" name="task" value="<?php echo $task->task ?>" maxlength="50" size="25">
            <button id="btnSubmit" type="submit">Ubah</button>
    </form>