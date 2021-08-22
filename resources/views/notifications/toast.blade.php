<div>
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <svg class="bd-placeholder-img rounded me-2" width="20" height="20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#007aff"></rect></svg>
                <strong class="me-auto"></strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        window.addEventListener('toast', function (event) {
            var toastSelector = document.getElementById('liveToast');
            toastSelector.getElementsByClassName('me-auto')[0].innerText =  event.detail.title;
            toastSelector.getElementsByClassName('toast-body')[0].innerText = event.detail.message;

            var toast = new bootstrap.Toast(toastSelector);
            toast.show();
        })
    </script>
@endpush
