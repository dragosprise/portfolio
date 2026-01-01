<x-layouts.app :title="__('About')">


            <div class="setting_content">
                <section class="about" id="about">
                    <form method="POST" action="{{route('about.update', $about->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        @include('admin.about.form',['formMode'=>'edit'])
                    </form>

                </section>
        </div>

</x-layouts.app>
