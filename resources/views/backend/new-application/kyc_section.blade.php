 {{-- KYC Section --}}
 <div class="card shadow-sm border-0 mt-4">
     <div class="card-body">

         <div class="section-title"><span>KYC Verification</span></div>

         <div class="row g-4">

            @if(in_array(Route::currentRouteName(), ['admin.gas', 'admin.electricity', 'admin.electric_gas']))

{{-- Meter Pictures --}}
<div class="col-md-6">

    <label class="fw-semibold mb-2">
        <i class="bi bi-speedometer me-1 text-primary"></i> Meter Pictures
    </label>

    <div class="kyc-upload-box" onclick="document.getElementById('meterPictures').click();">

        <p id="meterPicturesText" class="text-muted mb-0">
            Drop files here to upload
        </p>

        <input type="file"
               id="meterPictures"
               name="meter_pictures[]"
               multiple
               hidden
               onchange="showFiles(this,'meterPicturesPreview','meterPicturesText')">

    </div>

    <div id="meterPicturesPreview" class="mt-2"></div>

</div>

@endif

             {{-- Picture ID --}}
             <div class="col-md-6">

                 <label class="fw-semibold mb-2">
                     <i class="bi bi-person-badge me-1 text-primary"></i> Picture ID
                 </label>

                 <div class="kyc-upload-box" onclick="document.getElementById('pictureId').click();">

                     <p id="pictureIdText" class="text-muted mb-0">
                         Drop files here to upload
                     </p>

                     <input type="file" id="pictureId" name="picture_id[]" multiple hidden
                         onchange="showFiles(this,'pictureIdPreview','pictureIdText')">

                 </div>

                 <div id="pictureIdPreview" class="mt-2"></div>

             </div>



             {{-- Inside Outside Pics --}}
             <div class="col-md-6">

                 <label class="fw-semibold mb-2">
                     <i class="bi bi-building me-1 text-success"></i> Inside/Outside Pics
                 </label>

                 <div class="kyc-upload-box" onclick="document.getElementById('insidePics').click();">

                     <p id="insidePicsText" class="text-muted mb-0">
                         Drop files here to upload
                     </p>

                     <input type="file" id="insidePics" name="inside_outside_pics[]" multiple hidden
                         onchange="showFiles(this,'insidePicsPreview','insidePicsText')">

                 </div>

                 <div id="insidePicsPreview" class="mt-2"></div>

             </div>



             {{-- Bill --}}
             <div class="col-md-6">

                 <label class="fw-semibold mb-2">
                     <i class="bi bi-receipt me-1 text-warning"></i> Bill
                 </label>

                 <div class="kyc-upload-box" onclick="document.getElementById('billUpload').click();">

                     <p id="billUploadText" class="text-muted mb-0">
                         Drop files here to upload
                     </p>

                     <input type="file" id="billUpload" name="bill_upload[]" multiple hidden
                         onchange="showFiles(this,'billUploadPreview','billUploadText')">

                 </div>

                 <div id="billUploadPreview" class="mt-2"></div>

             </div>



             {{-- Bank Statement --}}
             <div class="col-md-6">

                 <label class="fw-semibold mb-2">
                     <i class="bi bi-bank me-1 text-info"></i> Bank Statement
                 </label>

                 <div class="kyc-upload-box" onclick="document.getElementById('bankStatement').click();">

                     <p id="bankStatementText" class="text-muted mb-0">
                         Drop files here to upload
                     </p>

                     <input type="file" id="bankStatement" name="bank_statement[]" multiple hidden
                         onchange="showFiles(this,'bankStatementPreview','bankStatementText')">

                 </div>

                 <div id="bankStatementPreview" class="mt-2"></div>

             </div>



             {{-- Additional Uploads --}}
             <div class="col-md-6">

                 <label class="fw-semibold mb-2">
                     <i class="bi bi-upload me-1 text-info"></i> Additional Uploads
                 </label>

                 <div class="kyc-upload-box" onclick="document.getElementById('additionalUploads').click();">

                     <p id="additionalUploadsText" class="text-muted mb-0">
                         Drop files here to upload
                     </p>

                     <input type="file" id="additionalUploads" name="additional_uploads[]" multiple hidden
                         onchange="showFiles(this,'additionalUploadsPreview','additionalUploadsText')">

                 </div>

                 <div id="additionalUploadsPreview" class="mt-2"></div>

             </div>


         </div>




     </div>
 </div>


 <script>
     let fileStore = {};

     function showFiles(input, previewId, textId) {

         fileStore[input.id] = Array.from(input.files);

         renderFiles(input.id, previewId, textId);
     }



     function renderFiles(inputId, previewId, textId) {

         let preview = document.getElementById(previewId);
         let text = document.getElementById(textId);

         preview.innerHTML = "";


         if (fileStore[inputId] && fileStore[inputId].length > 0) {

             text.style.display = "none";

         } else {

             text.style.display = "block";

         }


         fileStore[inputId].forEach((file, index) => {


             let div = document.createElement('div');

             div.className =
                 "d-flex justify-content-between align-items-center border rounded px-2 py-1 mb-1";


             div.innerHTML = `

            <span class="small text-truncate" style="max-width:220px;">
                <i class="bi bi-file-earmark"></i>
                ${file.name}
            </span>


            <button type="button"
                class="btn btn-sm text-danger p-0"
                onclick="removeFile('${inputId}',${index},'${previewId}','${textId}')">

                <i class="bi bi-x-circle-fill"></i>

            </button>

        `;


             preview.appendChild(div);


         });

     }




     function removeFile(inputId, index, previewId, textId) {


         fileStore[inputId].splice(index, 1);


         let dataTransfer = new DataTransfer();


         fileStore[inputId].forEach(file => {

             dataTransfer.items.add(file);

         });


         document.getElementById(inputId).files = dataTransfer.files;


         renderFiles(inputId, previewId, textId);

     }
 </script>
