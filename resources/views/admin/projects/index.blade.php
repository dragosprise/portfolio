<x-layouts.app :title="__('Projects')">
    <section class="projects" id="projects">
        <div class="titlebar">
            <h1>Projects </h1>@if(session('flash_message'))
                <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('flash_message') }}
                </div>
            @endif
            <button class="btn secondary open-modal-create">New Project</button>
        </div>
        @include('admin.projects.create')
        <div class="table">

{{--            <div class="table-filter">--}}
{{--                <div>--}}
{{--                    <ul class="table-filter-list">--}}
{{--                        <li>--}}
{{--                            <p class="table-filter-link link-active">All</p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="table-search">--}}
{{--                <div>--}}
{{--                    <label for=""></label><select class="search-select" name="" id="">--}}
{{--                        <option value="">Filter Project</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="relative">--}}
{{--                    <label>--}}
{{--                        <input class="search-input" type="text" name="search" placeholder="Search Project...">--}}
{{--                    </label>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="project_table-heading">
                <p>Image</p>
                <p>Title</p>
                <p>Description</p>
                <p>Link</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            @foreach($projects as $project)
            <div class="project_table-items">
                <p>
                    @if($project->image)
                    <img src="{{asset('images/'.$project->image)}}" alt class="project_img-list" >
                    @else
                        <img src="{{asset('templates/assets/img/no-image.png')}}" alt class="project_img-list">
                    @endif
                </p>
                <p>{{$project->title}}</p>
                <p>{{$project->description}}</p>
                <p>{{$project->link}}</p>
                <div>

                    <button class="btn-icon success edit-project-btn"
                            data-id="{{ $project->id }}"
                            data-company="{{ $project->image }}"
                            data-title="{{ $project->title }}"
                            data-description="{{ $project->description }}"
                            data-link="{{ $project->link }}">

                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form method="POST" action="{{ route('admin.projects.destroy', $project->id) }}" style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-icon danger" onclick="return confirm('Sigur vrei să ștergi?')">

                            <i class="far fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
{{--            @include('include.pagination')--}}
{{--            <div class="table-paginate">--}}
{{--                <div class="pagination">--}}
{{--                    <a href="#" class="btn">&laquo;</a>--}}
{{--                    <a href="#" class="btn active">1</a>--}}
{{--                    <a href="#" class="btn">2</a>--}}
{{--                    <a href="#" class="btn">3</a>--}}
{{--                    <a href="#" class="btn">&raquo;</a>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>
    <script>
        window.onload = function () {
            const modal = document.getElementById('projectModal');
            const projectForm = document.getElementById('projectForm');
            const modalTitle = document.getElementById('modalTitle');
            const formMethod = document.getElementById('formMethod');
            const submitBtn = document.getElementById('submitBtn');


            document.querySelector('.open-modal-create').addEventListener('click', function () {
               projectForm.reset();
                modalTitle.innerText = 'Create Project';
                submitBtn.innerText = 'Add';
                formMethod.value = 'POST';
                projectForm.action = "{{ route('admin.projects.store') }}";
                modal.style.display = 'flex';
            });


            document.querySelectorAll('.edit-project-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const title = this.getAttribute('data-title');
                    const description = this.getAttribute('data-description');
                    const link = this.getAttribute('data-link');

                    document.getElementById('inputTitle').value = title;
                    document.getElementById('inputDescription').value = description;
                    document.getElementById('inputLink').value = link;

                    document.getElementById('modalTitle').innerText = 'Edit Project';
                    document.getElementById('submitBtn').innerText = 'Update';
                    document.getElementById('formMethod').value = 'PATCH';
                    document.getElementById('projectForm').action = `/admin/projects/${id}`;

                    document.getElementById('projectModal').style.display = 'flex';
                });
            });

            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', () => modal.style.display = 'none');
            });

            window.onclick = function (event) {
                if (event.target === modal) modal.style.display = 'none';
            }
            console.log("scriptul a functionat nebunule");
        };
    </script>
</x-layouts.app>
