<div class="modal" id="skillModal"> <div class="modal-content">
        <h2 id="modalTitle">Create Skills</h2>
        <span class="close-modal">×</span>
        <hr>
        <form id="skillForm" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">

            <div>
                <label>Name</label>
                <input type="text" name="name" id="inputName">

                <label>User Photo</label>
                <input type="file" name="image" id="inputImage">

                <label>Service</label>
                <select name="service_id" id="selectService">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>
            <hr>
            <div class="modal-footer">
                <button type="button" class="close-modal">Cancel</button>
                <button type="submit" class="btn btn-secondary" id="submitBtn">Save</button>
            </div>
        </form>
    </div>
</div>
