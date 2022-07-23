  <div class="modal fade" id="updateUserInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="updateUserInfoLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateUserInfoLabel">User Info</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('profile.update.info') }}" method="post" id="infoUpdate">
                @csrf
                <div class="form-group">
                    <label>
                        <i class="mr-1 feather-phone"></i>
                        Your Phone
                    </label>
                    <input type="text" name="phone" class="form-control" value="{{ auth()->user()->phone }}" required>
                    @error("phone")
                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label >
                        <i class="mr-1 feather-map"></i>
                        Address
                    </label>
                    <textarea name="address" class="form-control" rows="5" required></textarea>
                    @error("address")
                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="infoUpdate">Update</button>
        </div>
      </div>
    </div>
  </div>
<script>
  
const modal = new bootstrap.Modal('#updateUserInfo')
// modal.show()

// setInterval(() => {
//   const modal = new bootstrap.Modal('#updateUserInfo');
//   modal.show();
// }, 3000);

</script>
