<div class="row pt-5">
   <p>
      <strong>Prescription Requests</strong>
   </p>
   <div id="my_prescriptions_wrapper" class="dataTables_wrapper no-footer">
      <div class="dataTables_length" id="my_prescriptions_length">
         <label>
            Show 
            <select name="my_prescriptions_length" aria-controls="my_prescriptions" class="">
               <option value="10">10</option>
               <option value="25">25</option>
               <option value="50">50</option>
               <option value="100">100</option>
            </select>
            entries
         </label>
      </div>
      <table class="table table-striped dataTable no-footer" id="my_prescriptions" role="grid">
         <thead>
            <tr role="row">
               <th rowspan="1" colspan="1">ID</th>
               <th rowspan="1" colspan="1">Date</th>
               <th rowspan="1" colspan="1">Partner Email</th>
               <th rowspan="1" colspan="1">Patient Name</th>
               <th rowspan="1" colspan="1">Status</th>
               <th rowspan="1" colspan="1">Actions</th>
            </tr>
            <tr role="row">
               <td class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 43.0625px;"></td>
               <td class="sorting sorting_desc" tabindex="0" aria-controls="my_prescriptions" rowspan="1" colspan="1" aria-label=": activate to sort column ascending" style="width: 74.1094px;"></td>
               <td class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                  All
                  samabbas33@gmail.com
                  developer@maxenius.com
                  " style="width: 240.344px;">
                  <select class="sb_status" id="partner_filter">
                     <option value="all">All</option>
                     <option value="samabbas33@gmail.com">samabbas33@gmail.com</option>
                     <option value="developer@maxenius.com">developer@maxenius.com</option>
                  </select>
               </td>
               <td class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                  All
                  hamza
                  james
                  william
                  " style="width: 107.156px;">
                  <select class="sb_status" id="patient_filter">
                     <option value="all">All</option>
                     <option value="hamza">hamza</option>
                     <option value="james">james</option>
                     <option value="william">william</option>
                  </select>
               </td>
               <td class="sorting_disabled sorting_asc" rowspan="1" colspan="1" aria-label="
                  All
                  Pending
                  Approved
                  Cancelled
                  Purchased
                  " style="width: 130.188px;">
                  <select class="sb_status" id="status_filter">
                     <option value="all">All</option>
                     <option value="pending">Pending</option>
                     <option value="approved">Approved</option>
                     <option value="cancelled">Cancelled</option>
                     <option value="purchased">Purchased</option>
                  </select>
               </td>
               <td class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 69.1406px;"></td>
            </tr>
         </thead>
         <tbody>
            <tr class="sb_result odd">
               <td>
                  <b>1</b>
               </td>
               <td class="sorting_2">
                  <b>2021-11-10</b>
               </td>
               <td>
                  <div class="ss-td-div">
                     hafizhamza810@gmail.com                                        
                  </div>
               </td>
               <td>
                  <div class="ss-td-div">
                     abc                                        
                  </div>
               </td>
               <td class="sorting_1">
                  Purchased                                    
               </td>
               <td>
                  <div class="ss-td-div ss-view-order-a">
                     <a href="#" style="background: #1E446E; border-radius: 10px !important; padding:10px !important;color:#fff;">View</a>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
        <!-- <div class="dataTables_paginate paging_simple_numbers" id="my_prescriptions_paginate">
            <a class="paginate_button previous disabled" aria-controls="my_prescriptions" data-dt-idx="0" tabindex="-1" id="my_prescriptions_previous">Previous</a>
            <span>
                <a class="paginate_button current" aria-controls="my_prescriptions" data-dt-idx="1" tabindex="0">1</a>
            </span>
                <a class="paginate_button next disabled" aria-controls="my_prescriptions" data-dt-idx="2" tabindex="-1" id="my_prescriptions_next">Next</a>
        </div> -->
   </div>
</div>