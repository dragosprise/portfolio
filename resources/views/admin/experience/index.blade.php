<x-layouts.app :title="__('Experience')">
    <section class="educations" id="educations">
        <div class="titlebar">
            <h1>Experiences </h1>     @if(session('flash_message'))
                <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('flash_message') }}
                </div>
            @endif
            <button class="btn secondary open-modal-create">
                New Experience
            </button>
        </div>
        @include('admin.experience.create')
        <div class="table">
            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li><p class="table-filter-link link-active">
                                <a href={{route("admin.experience.index")}} >All</a></p>
                        </li>
                    </ul>
                </div>
            </div>
            <form method="GET" action="{{route('admin.experience.index')}}" id="filterForm">
                <div class="table-search">
                    <div>
                        <select class="search-select" name="service_filter" onchange="this.form.submit()" id="">
                            <option>Filter Experience</option>
                            @foreach($experiences as $experience)
                                <option value="{{ $experience->id }}" {{ request('service_filter') == $experience->id ? 'selected' : '' }}>
                                    {{ $experience->company }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative">
                        <input class="search-input"
                               type="text"
                               name="search"
                               placeholder="Search Experience..."
                               value="{{ request('search') }}">

                    </div>
                </div>
            </form>
            <div class="education_table-heading">
                <p>Company</p>
                <p>Period</p>
                <p>Title</p>
                <p>Actions</p>
            </div>

            @foreach($experiences as $experience)
                <div class="education_table-items">
                    <p>{{$experience->company}}</p>
                    <p>{{$experience->period}}</p>
                    <p>{{$experience->title}}</p>

                    <div>

                        <button class="btn-icon success edit-education-btn"
                                data-id="{{ $experience->id }}"
                                data-company="{{ $experience->company }}"
                                data-period="{{ $experience->period }}"
                                data-title="{{ $experience->title }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.experience.destroy', $experience->id) }}" style="display:inline">
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
            const modal = document.getElementById('experienceModal');
            const experienceForm = document.getElementById('experienceForm');
            const modalTitle = document.getElementById('modalTitle');
            const formMethod = document.getElementById('formMethod');
            const submitBtn = document.getElementById('submitBtn');

            document.querySelector('.open-modal-create').addEventListener('click', function () {
                experienceForm.reset();
                modalTitle.innerText = 'Create Experience';
                submitBtn.innerText = 'Add';
                formMethod.value = 'POST';
                experienceForm.action = "{{ route('admin.experience.store') }}";
                modal.style.display = 'flex';
            });

            document.querySelectorAll('.edit-education-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const comp = this.getAttribute('data-company');
                    const period = this.getAttribute('data-period');
                    const title = this.getAttribute('data-title');

                    document.getElementById('inputCompany').value = comp;
                    document.getElementById('inputPeriod').value = period;
                    document.getElementById('inputTitle').value = title;

                    document.getElementById('modalTitle').innerText = 'Edit Experience';
                    document.getElementById('submitBtn').innerText = 'Update';
                    document.getElementById('formMethod').value = 'PATCH';
                    document.getElementById('experienceForm').action = `/admin/work/${id}`;

                    document.getElementById('experienceModal').style.display = 'flex';
                });
            });


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
