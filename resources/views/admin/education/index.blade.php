<x-layouts.app :title="__('Education')">
    <section class="educations" id="educations">
        <div class="titlebar">
            <h1>Educations </h1>     @if(session('flash_message'))
                <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('flash_message') }}
                </div>
            @endif
            <button class="btn secondary open-modal-create">
                New Education
            </button>
             </div>
        @include('admin.education.create')
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li><p class="table-filter-link link-active">
                            <a href={{route("admin.education.index")}} >All</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <form method="GET" action="{{route('admin.education.index')}}" id="filterForm">
            <div class="table-search">
                <div>
                    <select class="search-select" name="service_filter" onchange="this.form.submit()" id="">
                        <option>Filter Education</option>
                        @foreach($educations as $education)
                            <option value="{{ $education->id }}" {{ request('service_filter') == $education->id ? 'selected' : '' }}>
                            {{ $education->institution }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <input class="search-input"
                           type="text"
                           name="search"
                           placeholder="Search Education..."
                           value="{{ request('search') }}">

                </div>
            </div>
            </form>
            <div class="education_table-heading">
                <p>Institution</p>
                <p>Period</p>
                <p>Degree</p>
                <p>Department</p>
                <p>Actions</p>
            </div>

            @foreach($educations as $education)
            <div class="education_table-items">
                <p>{{$education->institution}}</p>
                <p>{{$education->period}}</p>
                <p>{{$education->degree}}</p>
                <p>{{$education->department}}</p>
                <div>

                    <button class="btn-icon success edit-education-btn"
                            data-id="{{ $education->id }}"
                            data-institution="{{ $education->institution }}"
                            data-period="{{ $education->period }}"
                            data-degree="{{ $education->degree }}"
                            data-department="{{ $education->department }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form method="POST" action="{{ route('admin.education.destroy', $education->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon danger" onclick="return confirm('Sigur vrei să ștergi?')">

                        <i class="far fa-trash-alt"></i>
                    </button>
                    </form>
                </div>
            </div>
            @endforeach

        </div>

    </section>
    <script>
        window.onload = function () {
            const modal = document.getElementById('educationModal');
            const educationForm = document.getElementById('educationForm');
            const modalTitle = document.getElementById('modalTitle');
            const formMethod = document.getElementById('formMethod');
            const submitBtn = document.getElementById('submitBtn');


            document.querySelector('.open-modal-create').addEventListener('click', function () {
                educationForm.reset();
                modalTitle.innerText = 'Create Education';
                submitBtn.innerText = 'Add';
                formMethod.value = 'POST';
                educationForm.action = "{{ route('admin.education.store') }}";
                modal.style.display = 'flex';
            });


            document.querySelectorAll('.edit-education-btn').forEach(button => {
                button.addEventListener('click', function () {

                    const id = this.getAttribute('data-id');
                    const inst = this.getAttribute('data-institution');
                    const period = this.getAttribute('data-period');
                    const degree = this.getAttribute('data-degree');
                    const dept = this.getAttribute('data-department');


                    document.getElementById('inputInstitution').value = inst;
                    document.getElementById('inputPeriod').value = period;
                    document.getElementById('inputDegree').value = degree;
                    document.getElementById('inputDepartment').value = dept;


                    document.getElementById('modalTitle').innerText = 'Edit Education';
                    document.getElementById('submitBtn').innerText = 'Update';
                    document.getElementById('formMethod').value = 'PATCH';
                    document.getElementById('educationForm').action = `/admin/education/${id}`;

                    document.getElementById('educationModal').style.display = 'flex';
                });
            });

// Închidere modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', () => modal.style.display = 'none');
            });

            window.onclick = function (event) {
                if (event.target == modal) modal.style.display = 'none';
            }
            console.log("scriptul a functionat nebunule");
        };
    </script>
</x-layouts.app>
