<!-- JavaScript Libraries -->
<script src="{{ asset('asset/backend/js/iconify.min.js') }}"></script>
<!-- jQuery library js -->
<script src="{{ asset('asset/backend/js/lib/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap js -->
<script src="{{ asset('asset/backend/js/lib/bootstrap.bundle.min.js') }}"></script>
<!-- Apex Chart js -->
<!-- {{-- <script src="{{ asset('asset/backend/js/lib/apexcharts.min.js') }}"></script> --}} -->
<!-- Data Table js -->
<script src="{{ asset('asset/backend/js/lib/dataTables.min.js') }}"></script>
<script src="https://geodata.solutions/includes/countrystatecity.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!-- Iconify Font js -->
<script src="{{ asset('asset/backend/js/lib/iconify-icon.min.js') }}"></script>
<!-- jQuery UI js -->
<script src="{{ asset('asset/backend/js/lib/jquery-ui.min.js') }}"></script>
<!-- Vector Map js -->
<script src="{{ asset('asset/backend/js/lib/jquery-jvectormap-2.0.5.min.js') }}"></script>
<script src="{{ asset('asset/backend/js/lib/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- Popup js -->
<script src="{{ asset('asset/backend/js/lib/magnifc-popup.min.js') }}"></script>
<!-- Slick Slider js -->
<script src="{{ asset('asset/backend/js/lib/slick.min.js') }}"></script>
<!-- prism js -->
<script src="{{ asset('asset/backend/js/lib/prism.js') }}"></script>
<!-- file upload js -->
<script src="{{ asset('asset/backend/js/lib/file-upload.js') }}"></script>
<!-- audioplayer -->
<script src="{{ asset('asset/backend/js/lib/audioplayer.js') }}"></script>
<script src="{{ asset('asset/backend/js/homeTwoChart.js') }}"></script>

<!-- main js -->
<script src="{{ asset('asset/backend/js/app.js') }}"></script>

<!-- main js -->
<script>
    let table = new DataTable('#dataTable');

    $('#categoryFilter').on('change', function () {
        let selectedCategory = $(this).val();
        console.log(selectedCategory);

        // Column index 3 = 4th column (Category)
        table.column(3).search(selectedCategory).draw();
    });
    $('#sectionFilter').on('change', function () {
        let selectedSection = $(this).val();
        console.log(selectedSection);

        // Column index 3 = 4th column (Category)
        table.column(2).search(selectedSection).draw();
    });
    $('#standardFilter').on('change', function () {
        let selectedStandard = $(this).val();
        console.log(selectedStandard);

        // Column index 3 = 4th column (Category)
        table.column(2).search(selectedStandard).draw();
    });
</script>


<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#177dff",
        fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#f3545d",
        fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
        type: "line",
        height: "70",
        width: "100%",
        lineWidth: "2",
        lineColor: "#ffa534",
        fillColor: "rgba(255, 165, 52, .14)",
    });
</script>

@stack('custom-js')



{{-- sweet alerts script --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-delete').forEach(function(button) {
            button.addEventListener('click', function() {
                const form = this.closest('form');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                    customClass: {
                        popup: 'small-swal',
                        title: 'small-swal-title',
                        htmlContainer: 'small-swal-text',
                        confirmButton: 'small-swal-button',
                        cancelButton: 'small-swal-button'
                    },
                    width: 400, // Adjust width as needed
                    padding: '1rem'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

<style>
    .small-swal {
        font-size: 0.9rem !important;
    }

    .small-swal-title {
        font-size: 1.2rem !important;
    }

    .small-swal-text {
        font-size: 0.9rem !important;
    }

    .small-swal-button {
        font-size: 0.8rem !important;
        padding: 0.3rem 0.8rem !important;
    }
</style>


{{-- icons Adjust Script --}}
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>
<script>
    $('#dataTable').on('draw.dt', function () {
        Iconify.scan();
    });
</script>
