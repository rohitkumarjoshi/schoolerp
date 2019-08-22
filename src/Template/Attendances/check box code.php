 <td width="40%">
    <?php foreach ($attendanceData->attendances as $attendanceradio):  ?>
        
        <label class="radio-inline">
            <input type="radio" name="attendance" class="hello" value="0.5" 
             <?php if(@$attendanceradio->first_half=='0.5') { echo 'checked'; } ?>  /> Present 
        </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <label class="radio-inline">
            <input type="radio" name="attendance" value="0" <?php if(@$attendanceradio->first_half=='0') { echo 'checked'; } ?> /> Absent 
        </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <label class="radio-inline">
            <input type="radio" name="attendance" value="1" <?php if(@$attendanceradio->first_half=='1') { echo 'checked'; } ?> /> Leave 
        </label>
    <?php endforeach ?>
</td> 