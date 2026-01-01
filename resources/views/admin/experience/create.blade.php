<div id="experienceModal" class="modal" style="display:none;">
    <div class="modal-content">
        <h2 id="modalTitle">Create Experience</h2>
        <hr>
        <form id="experienceForm" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            @include('admin.experience.form') <div class="modal-footer">
                <button type="submit" id="submitBtn" class="btn btn-secondary">Save</button>
                <button type="button" class="btn-close close-modal">Close</button>
            </div>
        </form>
    </div>
</div>
