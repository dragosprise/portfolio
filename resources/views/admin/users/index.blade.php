<x-layouts.app :title="__('Users')">
    <section class="users" id="users">
        <div class="titlebar">
            <h1>Users </h1>@if(session('flash_message'))
                <div class="alert alert-success" style="padding: 15px; background-color: #d4edda; color: #155724; margin-bottom: 20px;">
                    {{ session('flash_message') }}
                </div>
            @endif
            <button class="secondary open-modal-create">New User</button>
            @include('admin.users.create')
        </div>
        <div class="table">

{{--            <div class="table-filter">--}}
{{--                <div>--}}
{{--                    <ul class="table-filter-list">--}}
{{--                        <li><p class="table-filter-link link-active">--}}
{{--                                <a href={{route("users.index")}} >All</a></p>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            <div class="table-search">--}}
{{--                <div>--}}
{{--                    <select class="search-select" name="" id="">--}}
{{--                        <option value="">Filter User</option>--}}
{{--                    </select>--}}
{{--                </div>--}}
{{--                <div class="relative">--}}
{{--                    <input class="search-input" type="text" name="search" placeholder="Search User...">--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="user_table-heading">
                <p>Photo</p>
                <p>Name</p>
                <p>Email</p>
                <p>Actions</p>
            </div>
            <!-- item 1 -->
            @foreach($users as $user)
            <div class="user_table-items">
                <p>
                    @if($user->image)
                        <img src="{{ asset('images/'.$user->image) }}" alt="" class="user_img-list" style="width: 50px; height: 50px; border-radius: 50%;">
                    @else
                        <img src="{{ asset('templates/assets/img/no-image.png') }}" alt="" class="user_img-list">
                    @endif
                </p>
                <p>{{$user->name}}</p>
                <p>{{$user->email}}</p>
                <div>
                    <button class="btn-icon success edit-user-btn"
                            data-id="{{ $user->id }}"
                            data-name="{{ $user->name }}"
                            data-email="{{ $user->email }}">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                    <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" style="display:inline">
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
            const modal = document.getElementById('userModal');
            const userForm = document.getElementById('userForm');

            // Deschidere pentru NEW USER
            const openBtn = document.querySelector('.open-modal-create');
            if (openBtn) {
                openBtn.addEventListener('click', function () {
                    userForm.reset();
                    document.getElementById('modalTitle').innerText = 'Create User';
                    document.getElementById('formMethod').value = 'POST';
                    userForm.action = "{{ route('admin.users.store') }}";
                    modal.style.display = 'flex';
                });
            }

            // Deschidere pentru EDIT USER
            document.querySelectorAll('.edit-user-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const id = this.getAttribute('data-id');
                    const name = this.getAttribute('data-name');
                    const email = this.getAttribute('data-email');

                    document.getElementById('inputName').value = name;
                    document.getElementById('inputEmail').value = email;
                    document.getElementById('inputImage').value = '';
                    // IMPORTANT: NU pune .value pe inputImage (va crăpa scriptul)
                    // Parola o lăsăm goală la editare
                    document.getElementById('inputPassword').value = '';

                    document.getElementById('modalTitle').innerText = 'Edit User';
                    document.getElementById('submitBtn').innerText = 'Update';
                    document.getElementById('formMethod').value = 'PATCH';
                    userForm.action = `/admin/users/${id}`;

                    modal.style.display = 'flex';
                });
            });

            // Închidere modal
            document.querySelectorAll('.close-modal').forEach(btn => {
                btn.addEventListener('click', () => modal.style.display = 'none');
            });
        }
    </script>
</x-layouts.app>
