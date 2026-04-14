
$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | COMMON FUNCTION FOR HANDLING FORM SUBMISSION
    |--------------------------------------------------------------------------
    | This function handles AJAX submit, validation errors, success message,
    | reset form, and file preview reset.
    */
    // function handleFormSubmit($form) {

    //     $form.on("submit", function (e) {
    //         e.preventDefault();

    //         let formData = new FormData(this);

    //         // REMOVE OLD VALIDATION ERRORS
    //         $form.find(".is-invalid").removeClass("is-invalid");

    //         $.ajax({
    //             url: $form.attr("action"), // same route for all forms
    //             type: "POST",
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //             headers: {
    //                 "X-CSRF-TOKEN": $("input[name='_token']").val(),
    //                 "X-Requested-With": "XMLHttpRequest"
    //             },

    //             // DISABLE SUBMIT BUTTON BEFORE REQUEST
    //             beforeSend: function () {
    //                 $form.find("button[type='submit']").prop("disabled", true);
    //             },

    //             // SUCCESS RESPONSE
    //             success: function (response) {

    //                 $form.find("button[type='submit']").prop("disabled", false);

    //                 // SUCCESS ALERT
    //                 Swal.fire({
    //                     icon: 'success',
    //                     title: 'Success!',
    //                     text: response.message || 'Application submitted successfully',
    //                     timer: 2000,
    //                     showConfirmButton: false
    //                 });

    //                 // RESET FORM AFTER SUCCESS
    //                 $form[0].reset();

    //                 // RESET FILE UPLOAD PREVIEW BOXES

    //                 // reset all upload boxes
    //                 resetUploader["#pictureId"]();
    //                 resetUploader["#insidePics"]();
    //                 resetUploader["#billUpload"]();
    //                 resetUploader["#bankStatement"]();
    //                 resetUploader["#additionalUploads"]();
    //             },

    //             // ERROR RESPONSE
    //             error: function (xhr) {

    //                 $form.find("button[type='submit']").prop("disabled", false);

    //                 // VALIDATION ERRORS (422)
    //                 if (xhr.status === 422) {

    //                     let errors = xhr.responseJSON.errors;
    //                     let errorMsg = "";

    //                     $.each(errors, function (field, messages) {

    //                         errorMsg += messages[0] + "\n";

    //                         // HIGHLIGHT INVALID FIELD
    //                         let $input = $form.find(`[name="${field}"]`);
    //                         if ($input.length) {
    //                             $input.addClass("is-invalid");
    //                         }
    //                     });

    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Validation Error',
    //                         text: errorMsg
    //                     });

    //                 } else {
    //                     // GENERIC SERVER ERROR
    //                     Swal.fire({
    //                         icon: 'error',
    //                         title: 'Error',
    //                         text: 'Something went wrong. Please try again.'
    //                     });
    //                 }
    //             }
    //         });

    //     });
    // }

    /*
    |--------------------------------------------------------------------------
    | APPLY AJAX TO EACH FORM (ONLY ID DIFFERENT)
    |--------------------------------------------------------------------------
    */

    handleFormSubmit($("#broadbrandForm"));   // Broadband Form
    handleFormSubmit($("#electricgasForm"));  // Electric + Gas Form
    handleFormSubmit($("#electricityForm"));  // Electricity Form
    handleFormSubmit($("#gasForm"));          // Gas Form
    handleFormSubmit($("#telecomForm"));      // Telecom Form

    handleFormSubmit($("#applicationForm"));   // Broadband Form
    handleFormSubmit($("#loanForm"));  // Electric + Gas Form
    handleFormSubmit($("#openBankingForm"));  // Electricity Form
    handleFormSubmit($("#waterForm"));          // Gas Form

});

// for all for handling kyc section last section of form

$(document).ready(function () {

    function initUploader(selector) {

        let input = $(selector);
        let box = input.closest(".kyc-upload-box");

        function reset() {
            box.find(".preview-img, .remove-btn").remove();
            box.find("p").show();
        }

        function show(file) {

            if (!file || !file.type.startsWith("image/")) return;

            let reader = new FileReader();

            reader.onload = function (e) {

                reset();

                box.css("position", "relative");

                box.append(`
                    <img class="preview-img"
                         src="${e.target.result}"
                         style="position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:1;border-radius:inherit;">

                    <span class="remove-btn"
                          style="position:absolute;top:6px;right:6px;z-index:2;
                          background:red;color:#fff;width:22px;height:22px;
                          display:flex;align-items:center;justify-content:center;
                          border-radius:50%;cursor:pointer;">×</span>
                `);

                box.find("p").hide();
            };

            reader.readAsDataURL(file);
        }

        box.on("click", function (e) {
            if ($(e.target).hasClass("remove-btn")) return;
            input.trigger("click");
        });

        input.on("change", function () {
            if (this.files[0]) show(this.files[0]);
        });

        box.on("dragover", e => e.preventDefault());

        box.on("drop", function (e) {
            e.preventDefault();

            let file = e.originalEvent.dataTransfer.files[0];
            if (!file) return;

            input[0].files = e.originalEvent.dataTransfer.files;
            show(file);
        });

        box.on("click", ".remove-btn", function (e) {
            e.stopPropagation();
            input.val("");
            reset();
        });

        reset();

        // ⭐ IMPORTANT: expose reset function globally
        window.resetUploader = window.resetUploader || {};
        window.resetUploader[selector] = reset;
    }

    [
        "#pictureId",
        "#insidePics",
        "#billUpload",
        "#bankStatement",
        "#additionalUploads"
    ].forEach(initUploader);

});
