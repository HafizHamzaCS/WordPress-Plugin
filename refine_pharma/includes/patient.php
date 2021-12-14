<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<div class="patient_form">
  <div class="patient_form_section_1">
    <h3>Patient Details</h3>
    <hr style="opacity: 1;">
    <p>Enter or update the patient details for your current prescription.</p>
    <p>Select Patient form dropdown or enter new.</p>
    <!-- fetch data from database -->
     <?php 
      global $wpdb;
      $current_user_id = get_current_user_id();
      $table = 'wp_patient_detail';
      $results = $wpdb->get_results("SELECT * FROM $table ");
     ?>
    <hr style="opacity: 1;">
    <div class="form-group">
      <label>Patient List</label>
      <select name="" class="form-control" id="patient_list" required="" >
        <option style="opacity: 1;"></option>
         <?php foreach ($results as $value) { ?>
             <option  value="<?php echo $value->patient_name;?>"><?php echo $value->patient_name;?>
             </option>
           <?php } ?>
      </select>
    </div>
    <h4 style="opacity: 1;">
    <strong style="opacity: 1;">Patient Address</strong>
    </h4>
    <hr style="opacity: 1;">
  </div>
  <div class="patient_form_section_2">
    <form class="row g-3 needs-validation" novalidate id="patient-form">
      <!--       <input type="hidden" name="patient_data[created_by]" value="<?php //echo get_current_user_id() ?>">
      -->
      <div class="col-md-12">
        <label for="validationCustom01"  class="form-label">Patient Name:<span class="patient_span">*</span></label>
        <input type="text" name="patient_data[patient_name]" class="form-control" id="patient_name" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom02"  class="form-label">Patient Date of Birth:<span class="patient_span">*</span></label>
        <input type="date" name="patient_data[patient_dob]" class="form-control" id="patient_dob" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">Patient Address Line 1:<span class="patient_span">*</span></label>
        <input type="text" name="patient_data[patient_address1]" class="form-control" id="patient_address1" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">Patient Address Line 1:</label>
        <input type="text" name="patient_data[patient_address2]" class="form-control" id="patient_address2" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">Patient Town/City:<span class="patient_span">*</span></label>
        <input type="text" name="patient_data[patient_city]" class="form-control" id="patient_city" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">Patient Country:<span class="patient_span">*</span></label>
        <input type="text" name="patient_data[patient_country]" class="form-control" id="patient_country" required>
      </div><br>
      <div class="col-md-12">
        <label for="validationCustom03" class="form-label">Patient PostCode:<span class="patient_span">*</span></label>
        <input type="text" name="patient_data[patient_postcode]" class="form-control" id="patient_postcode" required>
      </div><br><br>
      <div class="col-12">
        <button class="patient_button" type="submit" value="submit">Save</button>
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
(function () {
'use strict'
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.querySelectorAll('.needs-validation')
// Loop over them and prevent submission
Array.prototype.slice.call(forms)
.forEach(function (form) {
form.addEventListener('submit', function (event) {
if (!form.checkValidity()) {
event.preventDefault()
event.stopPropagation()
}
form.classList.add('was-validated')
}, false)
})
})()
</script>