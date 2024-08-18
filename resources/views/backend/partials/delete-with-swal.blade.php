<a tabindex="0" class="btn btn-danger btn-sm me-1 swal_delete_button">
    <i class="ri-delete-bin-line"></i>
</a>
<form method='post' action="{{ $url }}" class="d-none">
    @method("DELETE")
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br >
    <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>