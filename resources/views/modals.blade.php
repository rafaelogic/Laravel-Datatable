<div id="edit" role="dialog" aria-labelledby="modalLabel" class="modal fade text-left" aria-hidden="true">
    <div role="document" class="modal-dialog">
      <div class="modal-content">
        
        <div class="modal-header">
          <h5 id="modalLabel" class="modal-title"></h5>
          <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
        </div>
  
        <form>
          <div class="modal-body">
            <div class="d-flex flex-column justify-content-center">
              <div class="form-group">
                <label>User Fullname</label>
                <input class="form-control" id="name" type="text">
              </div>
              <div class="form-group">
                  <label>User Email</label>
                  <input class="form-control" id="email" type="text">
                </div>
            </div>
          </div>

          <input id="id" type="hidden">
  
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal" type="button" >Close</button>
            <button class="btn btn-success btn-block" data-token="{{csrf_token()}}" id="save-edit" type="button">Save Changes</button>
          </div>
        </form>
  
      </div>
    </div>
  </div>


<div class="modal fade" id="delete" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
            <div id="message"></div>
            <input type="hidden" name="id" id="id">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
          <button id="deleteYesBtn" class="btn btn-danger float-right" data-token="{{ csrf_token() }}">Yes</button>
        </div>
    </div>
  </div>
</div>