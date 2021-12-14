<div class="row">
    <div class="col-md-12">
        <h4><strong>Change PIN</strong></h4>
    </div>
    <br>
    <div class="col-md-12">
        <form method="post" action="">
            <div class="form-group">
                <label for="fname" style="display:block;">OLD PIN: <span style="color:red; font-size: 25px;">*</span></label>
                <input type="password" required="" name="first_pin" class="form-control mr-1 first_pin verify_pin pincode_move change_pin_input" data-nex="second_pin" placeholder="" id="first_pin" maxlength="1">
                <input type="password" required="" name="second_pin" class="form-control mr-1 verify_pin first_pin pincode_move change_pin_input" data-nex="third_pin" placeholder="" id="second_pin" maxlength="1">
                <input type="password" required="" name="third_pin" class="form-control mr-1 first_pin verify_pin pincode_move change_pin_input" data-nex="fourth_pin" placeholder="" id="third_pin" maxlength="1">
                <input type="password" required="" name="fourth_pin" class="form-control first_pin verify_pin pincode_move change_pin_input" data-nex="first_pin1" placeholder="" id="fourth_pin" maxlength="1">
            </div>
            <div class="form-group">
                <label for="fname" style="display:block;">NEW PIN: <span style="color:red; font-size: 25px;">*</span></label>
                <input type="password" required="" name="new_first_pin" class="form-control mr-1 first_pin verify_pin pincode_move change_pin_input" data-nex="second_pin1" placeholder="" id="first_pin1" maxlength="1">
                <input type="password" required="" name="new_second_pin" class="form-control mr-1 verify_pin first_pin pincode_move change_pin_input" data-nex="third_pin1" placeholder="" id="second_pin1" maxlength="1">
                <input type="password" required="" name="new_third_pin"  class="form-control mr-1 first_pin verify_pin pincode_move change_pin_input" data-nex="fourth_pin1" placeholder="" id="third_pin1" maxlength="1">
                <input type="password"  required="" name="new_fourth_pin" class="form-control first_pin verify_pin pincode_move change_pin_input" data-nex="comments" placeholder="" id="fourth_pin1" maxlength="1">
            </div>
            <button style="background: #1E446E; color:#fff;border-radius: 10px" type="submit" name="submit_change_pin" id="submit_change_pin">Change</button>
        </form>
    </div>
</div>