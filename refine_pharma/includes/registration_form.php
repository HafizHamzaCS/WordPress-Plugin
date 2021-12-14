<?php 
//===============================================================================
//=============refine pharma registration form ==================================
//===============================================================================

add_shortcode('refine_registration_form', 'refine_registration_form_function');
function refine_registration_form_function(){ ?>
    <div class="container">
    <div class="row">
        <div class="col-xl-6">
            <div class="multistep-container">
                <div class="multistep-form-area" id="hide_form_jquery">
                    <form id="refine_form" > 
                        <input type="hidden" name="meta[approved]" value="unapproved">
                        <!--action='<?php //echo admin_url('admin-ajax.php'); ?>'  -->
                        <!-- <input name='action' type="hidden" value='custom_form_submit'> -->
                        <div class="form-box refine_form_section_1" id="personal_info">
                            <ul class="active-button">
                                <li class="active">
                                    <span class="round-btn">1</span>
                                </li>
                                <li >
                                    <span class="round-btn">2</span>
                                </li>
                                <li>
                                    <span class="round-btn">3</span>
                                </li>
                            </ul>
                            <h4>Personal Information</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <!-- <label for="email">Email<span class="required">*</span></label>
                                    <input type="email"  name="data[user_email]" class="form-control" id="email" placeholder="Email" > -->
                                    <label for="username">User Name</label>
                                    <input type="username" name="data[user_login]" class="form-control" id="username" placeholder="username">
                                    <label for="password">Password<span class="required">*</span></label>
                                    <input type="password"  name="data[user_pass]"  class="form-control" id="password" placeholder="Password" >
                                    <label for="password">Confirm Password<span class="required">*</span></label>
                                    <input type="password"   class="form-control" id="cpassword" placeholder="Confirm Password">
                                </div>
                            </div>
                            <div class="button-row">
                                <input type="button" value="Next" name="next" id="first_next" class="next">
                            </div>
                        </div>
                        <div class="form-box refine_form_section_2" id="contact_info" >
                            <ul class="active-button">
                                <li class="active">
                                    <span class="round-btn">1</span>
                                </li>
                                <li class="active">
                                    <span class="round-btn">2</span>
                                </li>
                                <li>    
                                    <span class="round-btn">3</span>
                                </li>
                            </ul>
                            <h4>Contact info</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="FirstName">First Name<span class="required">*</span></label>
                                    <input type="text" name="data[first_name]"  class="form-control" id="FirstName" placeholder="First Name" autocomplete="off">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="LastName">Last Name<span class="required">*</span></label>
                                    <input type="text" name="data[last_name]"  class="form-control" id="LastName" placeholder="LastName">
                                    <label for="phone_no">Phone No<span class="required">*</span></label>
                                    <input type="number" name="meta[phone_no]"  class="form-control" id="phone_no" placeholder="Phone NO">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress">Address<span class="required">*</span></label>
                                    <input type="text" name="meta[address_1]"  class="form-control" id="inputAddress1" placeholder="1234 Main St">
                                </div>
                                <div class="form-group">
                                    <label for="inputAddress2">Address 2<span class="required">*</span></label>
                                    <input type="text" name="meta[address_2]"  class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputCity">City<span class="required">*</span></label>
                                    <input type="text" name="meta[city]"  class="form-control" id="inputCity">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="inputState">Country<span class="required">*</span></label>
                                    <input type="text" name="meta[country]"  class="form-control" id="inputcountry ">
                                    <label for="inputState">Post Code<span class="required">*</span></label>
                                    <input type="text" name="meta[post_code]"  class="form-control" id="post_code ">
                                </div>
                            </div>
                            <div class="button-row">
                                <input type="button" value="previous" name="previous" class="previous">
                                <input type="button" value="next" name="next" class="next" id="second_next">
                            </div>
                        </div>  
                        <div class="form-box refine_form_section_3 form_3">
                            <ul class="active-button">
                                <li class="active" >
                                    <span class="round-btn">1</span>
                                </li>
                                <li class="active">
                                    <span class="round-btn">2</span>
                                </li>
                                <li class="active">
                                    <span class="round-btn">3</span>
                                </li>
                            </ul>
                            <h4>Account Verification</h4>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="medical_type">Medical Type</label>
                                    <select id="medical_type" name="data[role]">
                                        <option value="medical" id="medical" >Medical</option>
                                        <option value="other" selected>Other</option>
                                    </select>
                                </div>
                                <div class="medical_form_show">
                                    <div class="form-group">
                                        <label for="Profession">Profession</label>
                                        <select id="Profession" name="meta[Profession]">
                                            <option value="medical">Doctor</option>
                                            <option value="Nurse/Midwife">Nurse/Midwife</option>
                                            <option value="Dentist">Dentist</option>
                                            <option value="Pharmacist">Pharmacist</option>
                                            <option value="Allied Health Professional">Allied Health Professional</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="GoverningBody">Governing Body</label>
                                        <select id="GoverningBody" name="meta[GoverningBody]">
                                            <option value="medical">NMC</option>
                                            <option value="GDC">GDC</option>
                                            <option value="GMC">GMC</option>
                                            <option value="GPHC">GPHC</option>
                                            <option value="HCPC">HCPC</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="PrescriberType">Prescriber Type</label>
                                        <select id="PrescriberType" name="meta[PrescriberType]">
                                            <option value="prescriber" id="prescriber">Prescriber</option>
                                            <option value="non_prescriber" selected>Non Prescriber</option>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="PrescriberType">Registration No<span class="required">*</span></label>
                                        <input type="password" name="meta[registration_no]">
                                        
                                    </div>
                                    <div class="four_digit_password">
                                        <div class="eform-row">
                                            <div class="werform-group">
                                                <p>Create a unique 4 digit PIN<span class="required">*</span></p>
                                                <div class="password">
                                                    <input type="password" name="meta[user_pass_1]" maxlength="1" id="pass_1" />
                                                    <input type="password" name="meta[user_pass_2]" maxlength="1" id="pass_2" />
                                                    <input type="password" name="meta[user_pass_3]" maxlength="1" id="pass_3" />
                                                    <input type="password" name="meta[user_pass_4]" maxlength="1" id="pass_4" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="upload_id">Upload Photo ID - Passport/Driving License:<span class="required">*</span></label>
                                    <input type="file" name="photo_id"  class="form-control-file" id="upload_id">
                                </div><br>
                                <div class="form-group">
                                    <label for="upload_certificate">Aesthetics Training Certificate:<span class="required">*</span></label>
                                    <input type="file" name="industry_certificate"  class="form-control-file" id="upload_certificate">
                                </div><br>
                                <div class="form-group">
                                    <label for="upload_bill">Upload Utility Bill from Last 3 Months:<span class="required">*</span></label>
                                    <input type="file" name="utility_bill"  class="form-control-file" id="upload_bill">
                                </div><br>
                                <div class="form-group">
                                    <label for="insurance">Insurance</label>
                                    <input type="file" name="insurance"  class="form-control-file" id="insurance">
                                </div><br>
                                <div class="form-group">
                                    <label for="treatment">Treatment</label>
                                    <input type="file" name="treatment"  class="form-control-file" id="treatment">
                                </div>
                            </div>
                            <div class="custom_button">
                                <div class="button-row">
                                    <input type="button"  value="previous" name="previous" class="previous">
                                    <!-- <button type="submit" name="submit" value="submit" class="btn btn-primary submit" >Register</button> -->
                                    <input type="submit" name="submit" value="submit" class="submit_refine submit">
                                    <div class="center_spinner">
                                        <div id="ajaxSpinnerImage">
                                            <img src="<?php echo plugin_dir_url(dirname( __FILE__ )) . 'assets/images/ajax-loader.gif'; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php } ?>