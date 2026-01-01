<div id="projectModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2 id="modalTitle">Create Project</h2>
        <hr>
        <form id="projectForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            @include('admin.projects.form') <div class="modal-footer">
                <button type="submit" id="submitBtn" class="btn btn-secondary">Save</button>
                <button type="button" class="btn-close close-modal">Close</button>
            </div>
        </form>
    </div>
</div>
