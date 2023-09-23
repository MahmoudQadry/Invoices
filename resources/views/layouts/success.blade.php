@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{session()->get("success")}}</strong>
    </div>
@endif
{{-- notifiy msg. --}}

{{-- @if (session()->has('success'))
    <script>
        window.onload = function() {
            notif({
                msg: "deleted succesfully",
                type: "error"
            })
        }
    </script>
@endif --}}
