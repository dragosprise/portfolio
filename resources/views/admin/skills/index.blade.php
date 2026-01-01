<x-layouts.app :title="__('Skills')">
    <section class="skills" id="skills" style="width: 100%; padding: 20px;">
        <div class="titlebar">
            <h1>Skills</h1>
            @if(session('flash_message'))
                <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('flash_message') }}
                </div>
            @endif
            <button class="btn secondary open-modal-create">
                Create skill
            </button>
            @include('admin.skills.form')
        </div>

        <div class="table" style="width: 100%; background: white; box-shadow: 0 0 5px rgba(0,0,0,0.05); border-radius: 4px;">

            <div class="table-filter">
                <div>
                    <ul class="table-filter-list">
                        <li>
                            <a href="{{ route('admin.skills.index') }}"
                               class="table-filter-link {{ !request()->has('search') && !request()->has('service_filter') ? 'link-active' : '' }}"
                               style="text-decoration: none; color: inherit; padding: 10px; display: inline-block;">
                                All
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <form method="GET" action="{{ route('admin.skills.index') }}" id="filterForm">
                <div class="table-search" style="display: flex; width: 100%; padding: 15px; gap: 10px;">
                    <div style="flex: 1;">
                        <select class="search-select" name="service_filter" onchange="this.form.submit()" style="width: 100%;">
                            <option value="">Filter Skills (All Services)</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}" {{ request('service_filter') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative" style="flex: 2;">
                        <input class="search-input" type="text" name="search" placeholder="Search Skill..." value="{{ request('search') }}" style="width: 100%;">
                    </div>
                </div>
            </form>

            <div class="skill_table-heading">
                <p>Name</p>
                <p>Picture</p>
                <p>Service</p>
                <p>Actions</p>
            </div>

            @foreach($skills as $skill)
                <div class="skill_table-items">
                    <p>{{ $skill->name }}</p>
                        <p>
                            @if($skill->image)
                                <img src="{{ asset('images/'.$skill->image) }}" alt="" class="user_img-list" style="width: 50px; height: 50px; border-radius: 50%;">
                            @else
                                <img src="{{ asset('templates/assets/img/no-image.png') }}" alt="" class="user_img-list">
                            @endif
                        </p>

                    <p>{{ $skill->service->name ?? 'N/A' }}</p>
                    <div style="display: flex; gap: 5px;">
                        <button class="btn-icon success edit-skill-btn"
                                data-id="{{ $skill->id }}"
                                data-name="{{ $skill->name }}"
                                data-image="{{ $skill->image }}"
                                data-service="{{ $skill->service_id }}">
                            <i class="fas fa-pencil-alt"></i>
                        </button>

                        <form method="POST" action="{{ route('admin.skills.destroy', $skill->id) }}" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-icon danger" onclick="return confirm('Sigur vrei să ștergi?')">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach

            <div style="padding: 20px;">
                {{ $skills->links('include.pagination') }}
            </div>
        </div>


    </section>

    <script>
        window.onload = function () {
            const modal = document.getElementById('skillModal');
            const skillForm = document.getElementById('skillForm');
            const modalTitle = document.getElementById('modalTitle');
            const formMethod = document.getElementById('formMethod');
            const submitBtn = document.getElementById('submitBtn');

            document.querySelector('.open-modal-create').addEventListener('click', function () {
                skillForm.reset();
                modalTitle.innerText = 'Create Skill';
                submitBtn.innerText = 'Save';
                formMethod.value = 'POST';
                skillForm.action = "{{ route('admin.skills.store') }}";
                modal.style.display = 'flex';
            });

            document.querySelectorAll('.edit-skill-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const serviceId = this.getAttribute('data-service');

                    document.getElementById('inputName').value = name;

                    document.getElementById('selectService').value = serviceId;

                    modalTitle.innerText = 'Edit Skill';
                    submitBtn.innerText = 'Update';
                    formMethod.value = 'PATCH';
                    skillForm.action = `/admin/skills/${id}`;

                    modal.style.display = 'flex';
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
